<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\model\system\Addon;
use app\model\system\AddonQuick;
use app\model\system\Database;
use app\model\system\DiyTemplate;
use app\model\system\H5;
use app\model\system\Menu;
use app\model\web\Config as ConfigModel;
use extend\database\Database as dbdatabase;
use think\facade\Cache;
use app\model\system\Upgrade as UpgradeModel;


class System extends BaseShop
{
    /*********************************************************系统缓存与数据库管理***************************************************/
    /**
     * 缓存设置
     */
    public function cache()
    {
        if (request()->isAjax()) {
            $type = input("key", '');
            $msg = '缓存更新成功';
            switch ( $type ) {
                case 'all':
                    // 清除缓存
                case 'content':
                    Cache::clear();
                    if ($type == 'content') {
                        $msg = '数据缓存清除成功';
                        break;
                    }
                // 数据表缓存清除
                case 'data_table_cache':
                    if (is_dir('runtime/schema')) {
                        rmdirs("schema");
                    }
                    if ($type == 'data_table_cache') {
                        $msg = '数据表缓存清除成功';
                        break;
                    }
                // 模板缓存清除
                case 'template_cache':
                    if (is_dir('runtime/temp')) {
                        rmdirs("temp");
                    }
                    if ($type == 'template_cache') {
                        $msg = '模板缓存清除成功';
                        break;
                    }
            }
            return success(0, $msg, '');
        } else {
            $config_model = new ConfigModel();
            $cache_list = $config_model->getCacheList();

            $this->assign("cache_list", $cache_list);
            return $this->fetch('system/cache');
        }
    }

    /**
     * 插件管理
     */
    public function addon()
    {
        $addon = new Addon();
        if (request()->isAjax()) {
            $addon_name = input("addon_name");
            $tag = input("tag", "install");
            if ($tag == 'install') {
                $res = $addon->install($addon_name);
                return $res;
            } else {
                $res = $addon->uninstall($addon_name);
                return $res;
            }
        }
        $addon = $addon->getAddonAllList();

        $this->assign("addons", $addon[ 'data' ][ 'install' ]);
        $this->assign("uninstall", $addon[ 'data' ][ 'uninstall' ]);

        $this->forthMenu();
        return $this->fetch('system/addon');
    }

    /**
     * 数据库管理
     */
    public function database()
    {
        $database = new Database();
        $table = $database->getDatabaseList();
        $this->assign('list', $table);
        $this->forthMenu();
        return $this->fetch('system/database');
    }

    /**
     * 数据库还原页面展示
     */
    public function importlist()
    {
        $database = new Database();

        $path = $database->backup_path;
        if (!is_dir($path)) {
            $mode = intval('0777', 8);
            mkdir($path, $mode, true);
        }

        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($path, $flag);
        $list = array ();

        foreach ($glob as $name => $file) {

            if (preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)) {

                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[ 6 ];

                if (isset($list[ "{$date} {$time}" ])) {
                    $info = $list[ "{$date} {$time}" ];
                    $info[ 'part' ] = max($info[ 'part' ], $part);
                    $info[ 'size' ] = $info[ 'size' ] + $file->getSize();
                    $info[ 'size' ] = $database->format_bytes($info[ 'size' ]);
                } else {
                    $info[ 'part' ] = $part;
                    $info[ 'size' ] = $file->getSize();
                    $info[ 'size' ] = $database->format_bytes($info[ 'size' ]);
                }

                $info[ 'name' ] = date('Ymd-His', strtotime("{$date} {$time}"));;
                $extension = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                $info[ 'compress' ] = ( $extension === 'SQL' ) ? '-' : $extension;
                $info[ 'time' ] = strtotime("{$date} {$time}");

                $list[] = $info;
            }
        }

        if (!empty($list)) {
            $list = $database->my_array_multisort($list, "time");
        }
        $this->assign('list', $list);
        $this->forthMenu();
        return $this->fetch('system/importlist');

    }

    /**
     * 还原数据库
     */
    public function importData()
    {

        $time = request()->post('time', '');
        $part = request()->post('part', 0);
        $start = request()->post('start', 0);

        $database = new Database();
        if (is_numeric($time) && ( is_null($part) || empty($part) ) && ( is_null($start) || empty($start) )) { // 初始化
            // 获取备份文件信息
            $name = date('Ymd-His', $time) . '-*.sql*';
            $path = realpath($database->backup_path) . DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list = array ();
            foreach ($files as $name) {
                $basename = basename($name);
                $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[ $match[ 6 ] ] = array (
                    $match[ 6 ],
                    $name,
                    $gz
                );
            }
            ksort($list);
            // 检测文件正确性
            $last = end($list);
            if (count($list) === $last[ 0 ]) {
                session('backup_list', $list); // 缓存备份列表
                $return_data = [
                    'code' => 1,
                    'message' => '初始化完成',
                    'data' => [ 'part' => 1, 'start' => 0 ]
                ];
                return $return_data;
            } else {
                $return_data = [
                    'code' => -1,
                    'message' => '备份文件可能已经损坏，请检查！',
                ];
                return $return_data;
            }
        } elseif (is_numeric($part) && is_numeric($start)) {
            $list = session('backup_list');
            $db = new dbdatabase($list[ $part ], array (
                'path' => realpath($database->backup_path) . DIRECTORY_SEPARATOR,
                'compress' => $list[ $part ][ 2 ]
            ));

            $start = $db->import($start);
            if ($start === false) {
                $return_data = [
                    'code' => -1,
                    'message' => '还原数据出错！',
                ];
                return $return_data;
            } elseif ($start === 0) { // 下一卷
                if (isset($list[ ++$part ])) {
                    $data = array (
                        'part' => $part,
                        'start' => 0
                    );
                    $return_data = [
                        'code' => -1,
                        'message' => "正在还原...#{$part}",
                        'data' => $data
                    ];
                    return $return_data;
                } else {
                    session('backup_list', null);
                    $return_data = [
                        'code' => -1,
                        'message' => "还原完成！",
                    ];
                    return $return_data;
                }
            } else {
                $data = array (
                    'part' => $part,
                    'start' => $start[ 0 ]
                );
                if ($start[ 1 ]) {
                    $rate = floor(100 * ( $start[ 0 ] / $start[ 1 ] ));

                    $return_data = [
                        'code' => 1,
                        'message' => "正在还原...#{$part} ({$rate}%)",
                    ];
                    return $return_data;
                } else {
                    $data[ 'gz' ] = 1;
                    $return_data = [
                        'code' => 1,
                        'message' => "正在还原...#{$part}",
                        'data' => $data
                    ];
                    return $return_data;
                }
            }
        } else {
            $return_data = [
                'code' => -1,
                'message' => "参数有误",
            ];
            return $return_data;
        }
    }

    /**
     * 数据表修复
     */
    public function tablerepair()
    {
        if (request()->isAjax()) {
            $table_str = input('tables', '');
            $database = new Database();
            $res = $database->repair($table_str);
            return $res;
        }
    }


    /**
     * 数据表备份
     */
    public function backup()
    {
        $database = new Database();
        $tables = input('tables', []);
        $id = input('id', '');
        $start = input('start', '');

        if (!empty($tables) && is_array($tables)) { // 初始化
            // 读取备份配置
            $config = array (
                'path' => $database->backup_path . DIRECTORY_SEPARATOR,
                'part' => 20971520,
                'compress' => 1,
                'level' => 9
            );
            // 检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if (is_file($lock)) {
                return error(-1, '检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                $mode = intval('0777', 8);
                if (!file_exists($config[ 'path' ]) || !is_dir($config[ 'path' ]))
                    mkdir($config[ 'path' ], $mode, true); // 创建锁文件

                file_put_contents($lock, date('Ymd-His', time()));
            }
            // 自动创建备份文件夹
            // 检查备份目录是否可写
            is_writeable($config[ 'path' ]) || exit('backup_not_exist_success');
            session('backup_config', $config);
            // 生成备份文件信息
            $file = array (
                'name' => date('Ymd-His', time()),
                'part' => 1
            );

            session('backup_file', $file);

            // 缓存要备份的表
            session('backup_tables', $tables);

            $dbdatabase = new dbdatabase($file, $config);
            if (false !== $dbdatabase->create()) {

                $data = array ();
                $data[ 'status' ] = 1;
                $data[ 'message' ] = '初始化成功';
                $data[ 'tables' ] = $tables;
                $data[ 'tab' ] = array (
                    'id' => 0,
                    'start' => 0
                );
                return $data;
            } else {
                return error(-1, '初始化失败，备份文件创建失败！');
            }
        } elseif (is_numeric($id) && is_numeric($start)) { // 备份数据
            $tables = session('backup_tables');
            // 备份指定表
            $dbdatabase = new dbdatabase(session('backup_file'), session('backup_config'));
            $start = $dbdatabase->backup($tables[ $id ], $start);
            if (false === $start) { // 出错
                return error(-1, '备份出错！');
            } elseif (0 === $start) { // 下一表
                if (isset($tables[ ++$id ])) {
                    $tab = array (
                        'id' => $id,
                        'table' => $tables[ $id ],
                        'start' => 0
                    );
                    $data = array ();
                    $data[ 'rate' ] = 100;
                    $data[ 'status' ] = 1;
                    $data[ 'message' ] = '备份完成！';
                    $data[ 'tab' ] = $tab;
                    return $data;
                } else { // 备份完成，清空缓存
                    unlink($database->backup_path . DIRECTORY_SEPARATOR . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    return success(1);
                }
            } else {
                $tab = array (
                    'id' => $id,
                    'table' => $tables[ $id ],
                    'start' => $start[ 0 ]
                );
                $rate = floor(100 * ( $start[ 0 ] / $start[ 1 ] ));
                $data = array ();
                $data[ 'status' ] = 1;
                $data[ 'rate' ] = $rate;
                $data[ 'message' ] = "正在备份...({$rate}%)";
                $data[ 'tab' ] = $tab;
                return $data;
            }
        } else { // 出错
            return error(-1, '参数有误!');
        }
    }

    /**
     * 删除备份文件
     */
    public function deleteData()
    {
        $name_time = input('time', '');
        if ($name_time) {
            $database = new Database();
            $name = date('Ymd-His', $name_time) . '-*.sql*';
            $path = realpath($database->backup_path) . DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if (count(glob($path))) {
                return error(-1, "备份文件删除失败，请检查权限！");
            } else {
                return success(1, "备份文件删除成功！");
            }
        } else {
            return error(-1, "参数有误！");
        }
    }

    /**
     * 刷新菜单 测试
     */
    public function refresh()
    {
        try {

            $menu = new Menu();
            $res = $menu->refreshMenu('shop', '');

            $addon_model = new Addon();
            $addon_list = $addon_model->getAddonList([], 'name');
            $addon_list = $addon_list[ 'data' ];
            foreach ($addon_list as $k => $v) {
                var_dump($v[ 'name' ]);
                $addon_shop_menu_res = $menu->refreshMenu('shop', $v[ 'name' ]);
                var_dump($addon_shop_menu_res);
            }
            var_dump($res);
        } catch (\Exception $e) {
            var_dump("error：" . $e->getMessage());
        }
    }

    /**
     * 刷新自定义组件 测试
     */
    public function refreshDiy()
    {
        $arr = [ '', 'bargain', 'groupbuy', 'pintuan', 'seckill', 'coupon', 'fenxiao', 'live', 'notes', 'store' ];
        $addon = new Addon();
        foreach ($arr as $k => $v) {
            $res = $addon->refreshDiyView($v);
            var_dump($res);
        }
    }

    /**
     * 刷新自定义模板
     */
    public function refreshDiyTemplate()
    {
        $template = new DiyTemplate();
        $template->refresh();
    }

    /**
     * 刷新前端代码
     */
    public function refreshH5()
    {
        if (request()->isAjax()) {
            $h5 = new H5();
            $res = $h5->refresh();
            return $res;
        } else {
            $refresh_time = 0;
            if (file_exists('h5/refresh.log')) {
                $refresh_time = file_get_contents('h5/refresh.log');
            }
            $this->assign('refresh_time', $refresh_time);
            return $this->fetch('system/refresh_h5');
        }
    }
}