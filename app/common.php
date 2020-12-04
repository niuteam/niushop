<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

// 应用公共文件
// 除了 E_NOTICE，报告其他所有错误
//error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_NOTICE);

use extend\QRcode as QRcode;
use think\facade\Session;
use think\facade\Event;
use app\model\system\Addon;

/*****************************************************基础函数*********************************************************/
/**
 * 把返回的数据集转换成Tree
 *
 * @param array $list
 *            要转换的数据集
 * @param string $pid
 *            parent标记字段
 * @param string $level
 *            level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = [];
    if (!is_array($list)) :
        return false;

    endif;
    // 创建基于主键的数组引用
    $refer = [];
    foreach ($list as $key => $data) {
        $refer[ $data[ $pk ] ] = &$list[ $key ];
        $refer[ $data[ $pk ] ][ $child ] = [];
        $refer[ $data[ $pk ] ][ 'child_num' ] = 0;
    }
    foreach ($refer as $key => $data) {
        // 判断是否存在parent
        $parentId = $data[ $pid ];
        if ($root == $parentId) {
            $tree[ $key ] = &$refer[ $key ];
        } else if (isset($refer[ $parentId ])) {
            is_object($refer[ $parentId ]) && $refer[ $parentId ] = $refer[ $parentId ]->toArray();
            $parent = &$refer[ $parentId ];
            $parent[ $child ][ $key ] = &$refer[ $key ];
            $parent[ 'child_num' ]++;
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 *
 * @param array $tree
 *            原来的树
 * @param string $child
 *            孩子节点的键
 * @param string $order
 *            排序显示的键，一般是主键 升序排列
 * @param array $list
 *            过渡用的中间数组，
 * @return array 返回排过序的列表数组
 */
function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array ())
{
    if (is_array($tree)) {
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if (isset($reffer[ $child ])) {
                unset($reffer[ $child ]);
                tree_to_list($value[ $child ], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby = 'asc');
    }
    return $list;
}

/**
 * 对查询结果集进行排序
 *
 * @access public
 * @param array $list
 *            查询结果
 * @param string $field
 *            排序的字段名
 * @param array $sortby
 *            排序类型
 *            asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array ();
        foreach ($list as $i => $data)
            $refer[ $i ] = &$data[ $field ];
        switch ( $sortby ) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val)
            $resultSet[] = &$list[ $key ];
        return $resultSet;
    }
    return false;
}

/**
 * 对象转化为数组
 * @param object $obj
 */
function object_to_array($obj)
{
    if (is_object($obj)) {
        $obj = (array) $obj;
    }
    if (is_array($obj)) {
        foreach ($obj as $key => $value) {
            $obj[ $key ] = object_to_array($value);
        }
    }
    return $obj;
}

/**
 * 系统加密方法
 *
 * @param string $data
 *            要加密的字符串
 * @param string $key
 *            加密密钥
 * @param int $expire
 *            过期时间 单位 秒
 * @return string
 */
function encrypt($data, $key = '', $expire = 0)
{
    $key = md5(empty ($key) ? 'niucloud098)(*' : $key);

    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l)
            $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time() : 0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + ( ord(substr($char, $i, 1)) ) % 256);
    }
    return str_replace(array (
        '+',
        '/',
        '='
    ), array (
        '-',
        '_',
        ''
    ), base64_encode($str));
}

/**
 * 系统解密方法
 *
 * @param string $data
 *            要解密的字符串 （必须是encrypt方法加密的字符串）
 * @param string $key
 *            加密密钥
 * @return string
 */
function decrypt($data, $key = '')
{
    $key = md5(empty ($key) ? 'niucloud098)(*' : $key);
    $data = str_replace(array (
        '-',
        '_'
    ), array (
        '+',
        '/'
    ), $data);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data = substr($data, 10);

    if ($expire > 0 && $expire < time()) {
        return '';
    }
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l)
            $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr(( ord(substr($data, $i, 1)) + 256 ) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

/**
 * 数据签名认证
 */
function data_auth_sign($data)
{
    // 数据类型检测
    if (!is_array($data)) {
        $data = (array) $data;
    }
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = sha1($code); // 生成签名
    return $sign;
}

/**
 * 重写md5加密方式
 *
 * @param unknown $str
 * @return string
 */
function data_md5($str)
{
    return '' === $str ? '' : md5(md5($str) . 'NiuCloud');
}

/**
 * 时间戳转时间
 */
function time_to_date($time_stamp, $format = 'Y-m-d H:i:s')
{
    if ($time_stamp > 0) {
        $time = date($format, $time_stamp);
    } else {
        $time = "";
    }
    return $time;
}

/**
 * 时间转时间戳
 */
function date_to_time($date)
{
    $time_stamp = strtotime($date);
    return $time_stamp;
}

/**
 * 获取唯一随机字符串
 * 创建时间：2018年8月7日15:54:16
 */
function unique_random($len = 10)
{
    $str = 'qwertyuiopasdfghjklzxcvbnm';
    str_shuffle($str);
    $res = 'nc_' . substr(str_shuffle($str), 0, $len) . date('is');
    return $res;
}

/**
 * 生成随机数
 * @param int $length
 * @return string
 */
function random_keys($length)
{
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $pattern{mt_rand(0, 35)};    //生成php随机数
    }
    return $key;
}


/**
 * 发送HTTP请求方法，目前只支持CURL发送请求
 *
 * @param string $url
 *            请求URL
 * @param array $params
 *            请求参数
 * @param string $method
 *            请求方法GET/POST
 * @return array $data 响应数据
 */
function http($url, $timeout = 30, $header = array ())
{
    if (!function_exists('curl_init')) {
        throw new Exception('server not install curl');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    if (!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    $data = curl_exec($ch);
    list ($header, $data) = explode("\r\n\r\n", $data);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code == 301 || $http_code == 302) {
        $matches = array ();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = trim(array_pop($matches));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
    }

    if ($data == false) {
        curl_close($ch);
    }
    @curl_close($ch);
    return $data;
}

/**
 * 替换数组元素
 * @param array $array 数组
 * @param array $replace 替换元素['key' => 'value', 'key' => 'value']
 */
function replace_array_element($array, $replace)
{
    foreach ($replace as $k => $v) {
        if ($v == "unset" || $v == "") {
            unset($array[ $k ]);
        } else {
            $array[ $k ] = $v;
        }
    }

    return $array;
}


/**
 * 过滤特殊符号
 * 创建时间：2018年1月30日15:39:32
 * @param unknown $string
 * @return mixed
 */
function ihtmlspecialchars($string)
{
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[ $key ] = ihtmlspecialchars($val);
        }
    } else {
        $string = preg_replace('/&amp;((#(d{3,5}|x[a-fa-f0-9]{4})|[a-za-z][a-z0-9]{2,5});)/', '&\1',
            str_replace(array ( '&', '"', '<', '>' ), array ( '&amp;', '&quot;', '&lt;', '&gt;' ), $string));
    }
    return $string;
}

/********************************************* 插件,站点相关函数 ************************************************************************************
 *
 * /**
 * 插件显示内容里生成访问插件的url
 *
 * @param string $url
 *            url
 * @param array $param
 *            参数
 *            格式：addon_url('HelloWorld://sitehome/Game/index', [])
 */
function addon_url($url, $param = array ())
{
    if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
        return $url;
    }
    $parse_url = parse_url($url);
    $addon = isset($parse_url[ 'scheme' ]) ? $parse_url[ 'scheme' ] : '';
    $controller = isset($parse_url[ 'host' ]) ? $parse_url[ 'host' ] : '';
    $action = trim($parse_url[ 'path' ], '/');
    /* 解析URL带的参数 */
    if (isset($parse_url[ 'query' ])) {
        parse_str($parse_url[ 'query' ], $query);
        $param = array_merge($query, $param);
    }
    $url = $addon . '/' . $controller . '/' . $action;
    if (empty($addon)) {
        $url = $controller . '/' . $action;
        if (empty($controller)) {
            $url = $action;
        }
    }

    return url($url, $param);
}

/**
 * Url生成(重写url函数)
 * @param string $url 路由地址
 */
function url(string $url = '', $vars = [])
{

    if (!empty($vars)) {
        if (is_array($vars)) {
            $vars = http_build_query($vars);
        }
        $tag = REWRITE_MODULE ? '?' : '&';
        $var_url = $tag . $vars;
    } else {

        $var_url = '';
    }
    $url = $url . '.html';
    $url = str_replace("shop", SHOP_MODULE, $url);  //针对输入
    return ROOT_URL . '/' . $url . $var_url;

}

/**
 * 解析url的插件，模块，控制器，方法
 * @param unknown $url
 */
function url_action($url)
{
    if (empty($url)) {
        return [
            'addon' => '',
            'model' => 'index',
            'controller' => 'index',
            'action' => 'index'
        ];
    }
    if (!strstr($url, '://')) {
        $url_array = explode('/', $url);
        return [
            'addon' => '',
            'model' => $url_array[ 0 ],
            'controller' => $url_array[ 1 ],
            'action' => $url_array[ 2 ]
        ];
    } else {

        $url_addon_array = explode('://', $url);
        $addon = $url_addon_array[ 0 ];
        $url_array = explode('/', $url_addon_array[ 1 ]);
        return [
            'addon' => $addon,
            'model' => $url_array[ 0 ],
            'controller' => $url_array[ 1 ],
            'action' => $url_array[ 2 ]
        ];
    }

}

/**
 * 检测插件是否存在
 * @param string $name
 * @return number
 */
function addon_is_exit($name, $site_id = 0)
{
    $addon_model = new Addon();
    $addon_data = $addon_model->getAddonList([], 'name');
    $addons = array_column($addon_data[ 'data' ], 'name');
    if (in_array($name, $addons)) {
        return 1;
    } else {
        return 0;
    }

}

/***************************************************niucloud系统函数***************************************************/
/**
 * 处理事件
 *
 * @param string $event
 *            钩子名称
 * @param mixed $args
 *            传入参数
 * @param bool $once
 *            只获取一个有效返回值
 * @return void
 */
function event($event, $args = [], $once = false)
{
    $res = Event::trigger($event, $args);
    if (is_array($res)) {
        $res = array_filter($res);
        sort($res);
    }
    //只返回一个结果集
    if ($once) {
        return isset($res[ 0 ]) ? $res[ 0 ] : '';
    }
    return $res;

}

/**
 * 错误返回值函数
 * @param int $code
 * @param string $message
 * @param string $data
 * @return array
 */
function error($code = -1, $message = '', $data = '')
{
    return [
        'code' => $code,
        'message' => $message,
        'data' => $data
    ];
}

/**
 * 返回值函数
 * @param int $code
 * @param string $message
 * @param string $data
 * @return array
 */
function success($code = 0, $message = '', $data = '')
{
    return [
        'code' => $code,
        'message' => $message,
        'data' => $data
    ];
}

/**
 * 实例化Model
 *
 * @param string $name
 *            Model名称
 */
function model($table = '')
{
    return new \app\model\Model($table);
}

/**
 * 获取带有表前缀的表名
 * @param string $table
 */
function table($table = '')
{
    return config('database.connections.prefix') . $table;
}

/**
 * 获取图片的真实路径
 *
 * @param string $path 图片初始路径
 * @param string $type 类型 big、mid、small
 * @return string 图片的真实路径
 */
function img($path, $type = '')
{
    $start = strripos($path, '.');
    $type = $type ? '_' . strtoupper($type) : '';
    $first = explode("/", $path);

    $path = substr_replace($path, $type, $start, 0);
    // 处理商品助手的图片路径
    $path = str_replace('addons/NsGoodsAssist/', '', $path);
    $path = str_replace('shop/goods/', '', $path);
    if (stristr($path, "http://") === false && stristr($path, "https://") === false) {
        if (is_numeric($first[ 0 ])) {
            $true_path = __ROOT__ . '/upload/' . $path;
        } else {
            $true_path = __ROOT__ . '/' . $path;
        }
    } else {
        $true_path = $path;
    }
    return $true_path;
}

/**
 * 获取标准二维码格式
 *
 * @param string $url
 * @param string $path
 * @param string $ext
 */
function qrcode($url, $path, $qrcode_name)
{
    if (!is_dir($path)) {
        $mode = intval('0777', 8);
        mkdir($path, $mode, true);
        chmod($path, $mode);
    }
    $path = $path . '/' . $qrcode_name . '.png';
    if (file_exists($path)) {
        unlink($path);
    }
    QRcode::png($url, $path, '', 4, 1);
    return $path;
}

/**
 * 前端页面api请求(通过api接口实现)
 * @param string $method
 * @param array $params
 * @return mixed
 */
function api($method, $params = [])
{
    //本地访问
    $data = get_api_data($method, $params);
    return $data;
}

/**
 * 获取Api类
 *
 * @param string $method
 */
function get_api_data($method, $params)
{
    $method_array = explode('.', $method);
    if ($method_array[ 0 ] == 'System') {
        $class_name = 'app\\api\\controller\\' . $method_array[ 1 ];
        if (!class_exists($class_name)) {
            return error();
        }
        $api_model = new $class_name($params);
    } else {
        $class_name = "addon\\{$method_array[0]}\\api\\controller\\" . $method_array[ 1 ];

        if (!class_exists($class_name)) {
            return error();
        }
        $api_model = new $class_name($params);
    }
    $function = $method_array[ 2 ];
    $data = $api_model->$function($params);
    return $data;
}

/**
 * 根据年份计算生肖
 * @param unknown $year
 */
function get_zodiac($year)
{
    $animals = array (
        '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪'
    );
    $key = ( $year - 1900 ) % 12;
    return $animals[ $key ];
}

/**
 * 计算.星座
 * @param int $month 月份
 * @param int $day 日期
 * @return str
 */
function get_constellation($month, $day)
{
    $constellations = array (
        '水瓶座', '双鱼座', '白羊座', '金牛座', '双子座', '巨蟹座',
        '狮子座', '处女座', '天秤座', '天蝎座', '射手座', '摩羯座'
    );
    if ($day <= 22) {
        if (1 != $month) {
            $constellation = $constellations[ $month - 2 ];
        } else {
            $constellation = $constellations[ 11 ];
        }
    } else {
        $constellation = $constellations[ $month - 1 ];
    }
    return $constellation;
}

/**
 * 数组键名转化为数字
 * @param $data
 */
function arr_key_to_int($data, $clild_name)
{
    $temp_data = array_values($data);
    foreach ($temp_data as $k => $v) {
        if (!empty($v[ $clild_name ])) {
            $temp_data[ $k ][ $clild_name ] = arr_key_to_int($v[ $clild_name ], $clild_name);
        }
    }
    return $temp_data;
}

/**
 * 以天为单位 计算间隔内的日期数组
 * @param $start_time
 * @param $end_time
 * @return array
 */
function period_group($start_time, $end_time, $format = 'Ymd')
{
    $type_time = 3600 * 24;
    $data = [];
    for ($i = $start_time; $i <= $end_time; $i += $type_time) {
        $data[] = date($format, $i);
    }
    return $data;
}

/**
 * 数组删除另一个数组
 * @param $arr
 * @param $del_arr
 * @return mixed
 */
function arr_del_arr($arr, $del_arr)
{
    foreach ($arr as $k => $v) {
        if (in_array($v, $del_arr)) {
            unset($arr[ $k ]);
        }
    }
    sort($arr);
    return $arr;
}


/**
 * 检测登录(应用于h5网页检测登录)
 * @param unknown $url
 */
function check_auth($url = '')
{
    $access_token = Session::get("access_token_" . request()->siteid());
    if (empty($access_token)) {
        if (!empty($url)) {
            Session::set("redirect_login_url", $url);
        }
        //尚未登录(直接跳转)
        return error(url('wap/login/login'));
    }
    $member_info = cache("member_info_" . request()->siteid() . $access_token);
    if (empty($member_info)) {
        $member_info = api("System.Member.memberInfo", [ 'access_token' => $access_token ]);
        if ($member_info[ 'code' ] == 0) {
            $member_info = $member_info[ 'data' ];
            cache("member_info_" . request()->siteid() . $access_token, $member_info);
        }
    }
    $member_info[ 'access_token' ] = $access_token;
    return success($member_info);
}

/**
 * 分割sql语句
 * @param string $content sql内容
 * @param bool $string 如果为真，则只返回一条sql语句，默认以数组形式返回
 * @param array $replace 替换前缀，如：['my_' => 'me_']，表示将表前缀my_替换成me_
 * @return array|string 除去注释之后的sql语句数组或一条语句
 */
function parse_sql($content = '', $string = false, $replace = [])
{
    // 纯sql内容
    $pure_sql = [];
    // 被替换的前缀
    $from = '';
    // 要替换的前缀
    $to = '';
    // 替换表前缀
    if (!empty($replace)) {
        $to = current($replace);
        $from = current(array_flip($replace));
    }
    if ($content != '') {
        // 多行注释标记
        $comment = false;
        // 按行分割，兼容多个平台
        $content = str_replace([ "\r\n", "\r" ], "\n", $content);
        $content = explode("\n", trim($content));
        // 循环处理每一行
        foreach ($content as $key => $line) {
            // 跳过空行
            if ($line == '') {
                continue;
            }
            // 跳过以#或者--开头的单行注释
            if (preg_match("/^(#|--)/", $line)) {
                continue;
            }
            // 跳过以/**/包裹起来的单行注释
            if (preg_match("/^\/\*(.*?)\*\//", $line)) {
                continue;
            }
            // 多行注释开始
            if (substr($line, 0, 2) == '/*') {
                $comment = true;
                continue;
            }
            // 多行注释结束
            if (substr($line, -2) == '*/') {
                $comment = false;
                continue;
            }
            // 多行注释没有结束，继续跳过
            if ($comment) {
                continue;
            }
            // 替换表前缀
            if ($from != '') {
                $line = str_replace('`' . $from, '`' . $to, $line);
            }
            // sql语句
            $pure_sql[] = $line;
        }
        // 只返回一条语句
        if ($string) {
            return implode("", $pure_sql);
        }
        // 以数组形式返回sql语句
        $pure_sql = implode("\n", $pure_sql);
        $pure_sql = explode(";\n", $pure_sql);
    }
    return $pure_sql;
}

/**
 * 执行sql
 * @param unknown $sql_name
 */
function execute_sql($sql_name)
{
    $sql_string = file_get_contents($sql_name);
    $sql_string = str_replace("{{prefix}}", config("database.connections.mysql.prefix"), $sql_string);
    if ($sql_string) {
        $sql = explode(";\n", str_replace("\r", "\n", $sql_string));
        foreach ($sql as $value) {
            $value = trim($value);
            if (!empty($value)) {
                \think\facade\Db::execute($value);
            }
        }
    }
}

/**
 * 检测目录读写权限
 */
function check_dir_iswritable($dir)
{
    $testDir = $dir;
    sp_dir_create($testDir);
    if (sp_testwrite($testDir)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 检查测试文件是否可写入
 */
function sp_testwrite($d)
{
    $tfile = "_test.txt";
    $fp = @fopen($d . "/" . $tfile, "w");
    if (!$fp) {
        return false;
    }
    fclose($fp);
    $rs = @unlink($d . "/" . $tfile);
    if ($rs) {
        return true;
    }
    return false;
}

/**
 * 检查文件是否创建
 */
function sp_dir_create($path, $mode = 0777)
{
    if (is_dir($path))
        return true;
    $ftp_enable = 0;
    $path = sp_dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[ $i ] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}

/**
 * 判断目录是否为空
 * @param $dir
 * @return bool
 */
function dir_is_empty($dir)
{
    $handle = opendir($dir);
    while (false !== ( $entry = readdir($handle) )) {
        if ($entry != "." && $entry != "..") {
            return FALSE;
        }
    }
    return TRUE;
}

/**
 * 创建文件夹
 *
 * @param string $path 文件夹路径
 * @param int $mode 访问权限
 * @param bool $recursive 是否递归创建
 * @return bool
 */
function dir_mkdir($path = '', $mode = 0777, $recursive = true)
{
    clearstatcache();
    if (!is_dir($path)) {
        mkdir($path, $mode, $recursive);
        return chmod($path, $mode);
    }
    return true;
}

/**
 * 文件夹文件拷贝
 *
 * @param string $src 来源文件夹
 * @param string $dst 目的地文件夹
 * @return bool
 */
function dir_copy($src = '', $dst = '')
{
    if (empty($src) || empty($dst)) {
        return false;
    }
    $dir = opendir($src);
    dir_mkdir($dst);
    while (false !== ( $file = readdir($dir) )) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file)) {
                dir_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);

    return true;
}

/**查询存在目录
 * @param $dir
 */
function sp_exist_dir($dir)
{
    $is_exist = false;
    $is_write = false;
    while (!$is_exist) {
        $dir = dirname($dir);
        if (is_dir($dir) || $dir == ".") {
            $is_exist = true;
            if (is_writeable($dir)) {
                $is_write = true;
            }
        }
    }
    return $is_write;
}

/**
 * 拼接字符串
 * @param $string
 * @param $delimiter 分割字符
 * @param $value
 */
function string_split($string, $delimiter, $value)
{
    return empty($string) ? $value : $string . $delimiter . $value;
}

/**
 * $str为要进行截取的字符串，$length为截取长度（汉字算一个字，字母算半个字
 * @param $str
 * @param $length
 * @return string
 */
function str_sub($str, $length = 10)
{
    return mb_substr($str, 0, $length, 'UTF-8') . "...";
}

/**
 * 删除缓存文件使用
 * @param $dir
 */
function rmdirs($dir)
{
    $dir = 'runtime/' . $dir;
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (is_dir($fullpath)) {
                rmdirs($fullpath);
            } else {
                unlink($fullpath);
            }
        }
    }
    closedir($dh);
}

/**
 * 删除指定目录所有文件和目录
 * @param $path
 */
function deleteDir($path)
{
    if (is_dir($path)) {
        //扫描一个目录内的所有目录和文件并返回数组
        $dirs = scandir($path);
        foreach ($dirs as $dir) {
            //排除目录中的当前目录(.)和上一级目录(..)
            if ($dir != '.' && $dir != '..') {
                //如果是目录则递归子目录，继续操作
                $sonDir = $path . '/' . $dir;
                if (is_dir($sonDir)) {
                    //递归删除
                    deleteDir($sonDir);
                    //目录内的子目录和文件删除后删除空目录
                    @rmdir($sonDir);
                } else {
                    //如果是文件直接删除
                    @unlink($sonDir);
                }
            }
        }
    }
}

/**
 * 以天为单位 计算间隔内的日期数组
 * @param $srart_time
 * @param $end_time
 * @return array
 */
function periodGroup($srart_time, $end_time, $format = 'Ymd')
{
    $type_time = 3600 * 24;
    $data = [];
    for ($i = $srart_time; $i <= $end_time; $i += $type_time) {
        $data[] = date($format, $i);
    }
    return $data;
}


//解决个别中文乱码
function mbStrreplace($content, $to_encoding = "UTF-8", $from_encoding = "GBK")
{
    $content = mb_convert_encoding($content, $to_encoding, $from_encoding);
    $str = mb_convert_encoding("　", $to_encoding, $from_encoding);
    $content = mb_eregi_replace($str, " ", $content);
    $content = mb_convert_encoding($content, $from_encoding, $to_encoding);
    $content = trim($content);
    return $content;
}

/**
 * 将非UTF-8字符集的编码转为UTF-8
 *
 * @param mixed $mixed 源数据
 *
 * @return mixed utf-8格式数据
 */
function charset2utf8($mixed)
{
    if (is_array($mixed)) {
        foreach ($mixed as $k => $v) {
            if (is_array($v)) {
                $mixed[ $k ] = charsetToUTF8($v);
            } else {
                $encode = mb_detect_encoding($v, array ( 'ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5' ));
                if ($encode == 'EUC-CN') {
                    $mixed[ $k ] = iconv('GBK', 'UTF-8', $v);
                }
            }
        }
    } else {
        $encode = mb_detect_encoding($mixed, array ( 'ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5' ));
        if ($encode == 'EUC-CN') {
            $mixed = iconv('GBK', 'UTF-8', $mixed);
        }
    }
    return $mixed;
}

/**
 * 过滤bom
 * @param $filename
 */
function check_bom($filename)
{
    $contents = file_get_contents($filename);
    $charset[ 1 ] = substr($contents, 0, 1);
    $charset[ 2 ] = substr($contents, 1, 1);
    $charset[ 3 ] = substr($contents, 2, 1);
    if (ord($charset[ 1 ]) == 239 && ord($charset[ 2 ]) == 187 && ord($charset[ 3 ]) == 191) {
        $rest = substr($contents, 3);
        return $rest;
    } else {
        return $contents;
    }
}


/**
 * 判断 文件/目录 是否可写（取代系统自带的 is_writeable 函数）
 *
 * @param string $file 文件/目录
 * @return boolean
 */
function is_write($file)
{
    if (is_dir($file)) {
        $dir = $file;
        if ($fp = @fopen("$dir/test.txt", 'w')) {
            @fclose($fp);
            @unlink("$dir/test.txt");
            $writeable = true;
        } else {
            $writeable = false;
        }
    } else {
        if ($fp = @fopen($file, 'a+')) {
            @fclose($fp);
            $writeable = true;
        } else {
            $writeable = false;
        }
    }
    return $writeable;
}

/**
 * 是否是url链接
 * @param unknown $string
 * @return boolean
 */
function is_url($string)
{
    if (strstr($string, 'http://') === false && strstr($string, 'https://') === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * 计算两点之间的距离
 * @param double $lng1 经度1
 * @param double $lat1 纬度1
 * @param double $lng2 经度2
 * @param double $lat2 纬度2
 * @param int $unit m，km
 * @param int $decimal 位数
 * @return float 米
 */
function getDistance($lng1, $lat1, $lng2, $lat2, $unit = 1, $decimal = 0)
{
    $EARTH_RADIUS = 6370.996; // 地球半径系数
    $PI = 3.1415926535898;

    $radLat1 = $lat1 * $PI / 180.0;
    $radLat2 = $lat2 * $PI / 180.0;

    $radLng1 = $lng1 * $PI / 180.0;
    $radLng2 = $lng2 * $PI / 180.0;

    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;

    $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
    $distance = $distance * $EARTH_RADIUS * 1000;

    if ($unit === 2) {
        $distance /= 1000;
    }

    return round($distance, $decimal);
}

/**
 *
 * @param unknown $string
 * @return boolean
 */
function is_json($string)
{
    json_decode($string);
    return ( json_last_error() == JSON_ERROR_NONE );
}

/**
 * 获取站点h5域名
 * @param $site_id
 * @return string
 */
function getH5Domain()
{
    $config = new \app\model\web\Config();

    $info = $config->geth5DomainName();

    $h5_name = $info[ 'data' ][ 'value' ][ 'domain_name_h5' ];

    if ($h5_name) {
        return $h5_name;
    }

    return ROOT_URL . '/h5';
}

function get_http_type()
{
    $http_type = ( ( isset($_SERVER[ 'HTTPS' ]) && $_SERVER[ 'HTTPS' ] == 'on' ) || ( isset($_SERVER[ 'HTTP_X_FORWARDED_PROTO' ]) && $_SERVER[ 'HTTP_X_FORWARDED_PROTO' ] == 'https' ) ) ? 'https' : 'http';
    return $http_type;
}

/**
 * 获取文件地图
 * @param $path
 * @param array $arr
 * @return array
 */
function getFileMap($path, $arr = [])
{
    if (is_dir($path)) {
        $dir = scandir($path);
        foreach ($dir as $file_path) {
            if ($file_path != '.' && $file_path != '..') {
                $temp_path = $path . '/' . $file_path;
                if (is_dir($temp_path)) {
                    $arr[ $temp_path ] = $file_path;
                    $arr = getFileMap($temp_path, $arr);
                } else {
                    $arr[ $temp_path ] = $file_path;
                }
            }
        }
        return $arr;
    }
}


/**
 * 判断一个坐标是否在一个多边形内（由多个坐标围成的）
 * 基本思想是利用射线法，计算射线与多边形各边的交点，如果是偶数，则点在多边形外，否则
 * 在多边形内。还会考虑一些特殊情况，如点在多边形顶点上，点在多边形边上等特殊情况。
 * @param $point 指定点坐标  $point=['longitude'=>121.427417,'latitude'=>31.20357];
 * @param $pts 多边形坐标 顺时针方向  $arr=[['longitude'=>121.23036,'latitude'=>31.218609],['longitude'=>121.233666,'latitude'=>31.210579].............];
 */
function is_point_in_polygon($point, $pts)
{
    $N = count($pts);
    $boundOrVertex = true; //如果点位于多边形的顶点或边上，也算做点在多边形内，直接返回true
    $intersectCount = 0;//cross points count of x
    $precision = 2e-10; //浮点类型计算时候与0比较时候的容差
    $p1 = 0;//neighbour bound vertices
    $p2 = 0;
    $p = $point; //测试点

    $p1 = $pts[ 0 ];//left vertex
    for ($i = 1; $i <= $N; ++$i) {//check all rays
        // dump($p1);
        if ($p[ 'longitude' ] == $p1[ 'longitude' ] && $p[ 'latitude' ] == $p1[ 'latitude' ]) {
            return $boundOrVertex;//p is an vertex
        }

        $p2 = $pts[ $i % $N ];//right vertex
        if ($p[ 'latitude' ] < min($p1[ 'latitude' ], $p2[ 'latitude' ]) || $p[ 'latitude' ] > max($p1[ 'latitude' ], $p2[ 'latitude' ])) {//ray is outside of our interests
            $p1 = $p2;
            continue;//next ray left point
        }

        if ($p[ 'latitude' ] > min($p1[ 'latitude' ], $p2[ 'latitude' ]) && $p[ 'latitude' ] < max($p1[ 'latitude' ], $p2[ 'latitude' ])) {//ray is crossing over by the algorithm (common part of)
            if ($p[ 'longitude' ] <= max($p1[ 'longitude' ], $p2[ 'longitude' ])) {//x is before of ray
                if ($p1[ 'latitude' ] == $p2[ 'latitude' ] && $p[ 'longitude' ] >= min($p1[ 'longitude' ], $p2[ 'longitude' ])) {//overlies on a horizontal ray
                    return $boundOrVertex;
                }

                if ($p1[ 'longitude' ] == $p2[ 'longitude' ]) {//ray is vertical
                    if ($p1[ 'longitude' ] == $p[ 'longitude' ]) {//overlies on a vertical ray
                        return $boundOrVertex;
                    } else {//before ray
                        ++$intersectCount;
                    }
                } else {//cross point on the left side
                    $xinters = ( $p[ 'latitude' ] - $p1[ 'latitude' ] ) * ( $p2[ 'longitude' ] - $p1[ 'longitude' ] ) / ( $p2[ 'latitude' ] - $p1[ 'latitude' ] ) + $p1[ 'longitude' ];//cross point of lng
                    if (abs($p[ 'longitude' ] - $xinters) < $precision) {//overlies on a ray
                        return $boundOrVertex;
                    }

                    if ($p[ 'longitude' ] < $xinters) {//before ray
                        ++$intersectCount;
                    }
                }
            }
        } else {//special case when ray is crossing through the vertex
            if ($p[ 'latitude' ] == $p2[ 'latitude' ] && $p[ 'longitude' ] <= $p2[ 'longitude' ]) {//p crossing over p2
                $p3 = $pts[ ( $i + 1 ) % $N ]; //next vertex
                if ($p[ 'latitude' ] >= min($p1[ 'latitude' ], $p3[ 'latitude' ]) && $p[ 'latitude' ] <= max($p1[ 'latitude' ], $p3[ 'latitude' ])) { //p.latitude lies between p1.latitude & p3.latitude
                    ++$intersectCount;
                } else {
                    $intersectCount += 2;
                }
            }
        }
        $p1 = $p2;//next ray left point
    }

    if ($intersectCount % 2 == 0) {//偶数在多边形外
        return false;
    } else { //奇数在多边形内
        return true;
    }

}

/**
 * 过滤特殊字符
 * @param $strParam
 * @return null|string|string[]
 */
function replaceSpecialChar($strParam)
{
    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\s+/";
    return preg_replace($regex, "", $strParam);
}

function delFile($path)
{
    $res = false;
    if (file_exists($path)) {
        $res = unlink($path);
    }
    return $res;
}

/**
 * base64转二进制
 * @param $base64Str
 * @return array|boo
 */
function base64_to_blob($base64Str)
{
    if ($index = strpos($base64Str, 'base64,', 0)) {
        $blobStr = substr($base64Str, $index + 7);
        $typestr = substr($base64Str, 0, $index);
        preg_match("/^data:(.*);$/", $typestr, $arr);
        return [ 'blob' => base64_decode($blobStr), 'type' => $arr[ 1 ] ];
    }
    return false;
}

/**
 * 获取近七日的时间
 * @param $time
 * @return array|boo
 */

function getweeks($time = '', $format = 'Y-m-d')
{
    $time = $time != '' ? $time : time();
    //组合数据
    $date = [];
    for ($i = 1; $i <= 10; $i++) {
        $date[ $i ] = date($format, strtotime('+' . $i - 10 . ' days', $time));
    }
    return $date;
}

/**
 * 两个数字比
 * @param $first | $second
 * @return string
 */

function diff_rate($first, $second)
{
    if ($second != 0) {
        $result = sprintf('%.2f', ( ( $first - $second ) / $second ) * 100) . '%';
    } else if ($second == 0 & $first != 0) {
        $result = '100%';
    } else {
        $result = '0%';
    }
    return $result;
}

/**
 * 过滤bom
 * @param $filename
 */
function removeBom($contents)
{
    $charset[ 1 ] = substr($contents, 0, 1);
    $charset[ 2 ] = substr($contents, 1, 1);
    $charset[ 3 ] = substr($contents, 2, 1);
    if (ord($charset[ 1 ]) == 239 && ord($charset[ 2 ]) == 187 && ord($charset[ 3 ]) == 191) {
        $rest = substr($contents, 3);
        return $rest;
    } else {
        return $contents;
    }
}