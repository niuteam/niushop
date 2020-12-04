<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace app\model\system;

use app\model\BaseModel;
use think\facade\Db;
use extend\api\HttpClient;
use think\facade\Cache;
use app\model\web\Config;

class Upgrade extends BaseModel
{
    private $url;
    private $cert = '';

    public function __construct($code = '')
    {
        $this->cert = defined('NIUSHOP_AUTH_CODE') ? NIUSHOP_AUTH_CODE : '';
        $this->url = 'https://api.niushop.com';
    }

    /**
     * post 服务器请求
     */
    private function doPost($post_url, $post_data)
    {
        $post_data[ 'code' ] = $this->cert;
        $httpClient = new HttpClient();
        $res = $httpClient->post($this->url . $post_url, $post_data);
        return $res;
    }

    /**
     * 获取可升级的版本信息
     */
    public function getSystemUpgradeInfo()
    {
        $app_info = config('info');
        $addon_array = array_map('basename', glob('addon/*', GLOB_ONLYDIR));
        $plugin_info = [];
        foreach ($addon_array as $addon) {
            $addon_info_path = "addon/{$addon}/config/info.php";
            if (file_exists($addon_info_path)) {
                $info = include_once $addon_info_path;
                $plugin_info[] = [
                    'code' => $info[ 'name' ],
                    'version_no' => $info[ 'version_no' ],
                    'version_name' => $info[ 'version' ],
                ];
            }
        }

        $post_data = [
            'app_info' => [
                'code' => $app_info[ 'name' ],
                'version_no' => $app_info[ 'version_no' ],
                'version_name' => $app_info[ 'version' ],
            ],
            'plugin_info' => $plugin_info,
        ];

        $res = $this->doPost('/upgrade/upgrade/updateinfo', $post_data);
        $res = json_decode($res, true);

        //处理返回数据
        if (!empty($res) && $res[ 'code' ] == 0) {
            //整合系统和插件数据
            $app_data = $res[ 'data' ][ 'app_data' ];
            $client_data = $res[ 'data' ][ 'client_data' ];
            $plugin_data = $res[ 'data' ][ 'plugin_data' ];
            $install_data = $res[ 'data' ][ 'install_data' ];
            $data = [];
            if ($app_data[ 'code' ] == 0) {
                $app_data[ 'data' ][ 'action' ] = 'upgrade';
                $app_data[ 'data' ][ 'action_name' ] = '升级';
                $app_data[ 'data' ][ 'type' ] = 'system';
                $app_data[ 'data' ][ 'type_name' ] = '系统';
                $data[] = $app_data[ 'data' ];
            }
            foreach ($client_data as $key => $val) {
                if ($val[ 'code' ] == 0) {
                    $val[ 'data' ][ 'action' ] = 'download';
                    $val[ 'data' ][ 'action_name' ] = '下载';
                    $val[ 'data' ][ 'type' ] = 'client';
                    $val[ 'data' ][ 'type_name' ] = '客户端';
                    $data[] = $val[ 'data' ];
                }
            }
            foreach ($plugin_data as $key => $val) {
                if ($val[ 'code' ] == 0) {
                    $val[ 'data' ][ 'action' ] = 'upgrade';
                    $val[ 'data' ][ 'action_name' ] = '升级';
                    $val[ 'data' ][ 'type' ] = 'addon';
                    $val[ 'data' ][ 'type_name' ] = '插件';
                    $data[] = $val[ 'data' ];
                }
            }
            foreach ($install_data as $key => $val) {
                if ($val[ 'code' ] == 0) {
                    $val[ 'data' ][ 'action' ] = 'install';
                    $val[ 'data' ][ 'action_name' ] = '安装';
                    $val[ 'data' ][ 'type' ] = 'addon';
                    $val[ 'data' ][ 'type_name' ] = '插件';
                    $data[] = $val[ 'data' ];
                }
            }

            //处理更新说明的换行
            foreach ($data as $key => $val) {
                foreach ($val[ 'scripts' ] as $k => $v) {
                    $val[ 'scripts' ][ $k ][ 'description' ] = str_replace("\n", '<br/>', $v[ 'description' ]);
                }
                $data[ $key ] = $val;
            }
            $res[ 'data' ] = $data;
        }

        return $res;
    }

    /**
     * 在线下载文件
     * @param $param
     */
    public function download($param)
    {
        $data = array (
            "file_token" => $param[ "token" ]
        );
        $result = $this->doPost('/upgrade/upgrade/download', $data);//授权
        if (empty($result)) {
            return $this->error();
        }

        $result = json_decode($result, true);
        return $result;
    }

    /**
     * 获取授权信息
     * @return bool|mixed|string
     */
    public function authInfo()
    {
        $app_info = config('info');
        $data = array (
            "product_key" => $app_info[ 'name' ],
        );
        $re = $this->doPost('/upgrade/auth/info', $data);
        $re = json_decode($re, true);
        return $re;
    }

    /**
     * 获取所有插件
     * @return array|mixed
     */
    public function getAuthPlugin()
    {
        $result = $this->doPost('/upgrade/auth/plugin', []);//授权
        if (empty($result))
            return $this->error();


        $result = json_decode($result, true);

        return $result;
    }

    /**
     * 查询所有表
     */
    public function getDatabaseList()
    {
        $databaseList = Db::query("SHOW TABLE STATUS");
        return $databaseList;
    }

    /******************************* 升级日志相关 start *****************************/

    /**
     * 添加升级日志
     * @param $data
     * upgrade_time 升级时间
     * version_info 升级的版本信息
     * backup_root 备份文件和sql的根目录
     * download_root 下载文件和sql的根目录
     * @return array
     */
    public function addUpgradeLog($data)
    {
        $res = model('sys_upgrade_log')->add($data);
        if ($res == false) {
            return $this->error('', 'UNKNOW_ERROR');
        } else {
            return $this->success();
        }
    }

    /**
     * 修改日志
     * @return array
     */
    public function editUpgradeLog($data, $condition)
    {
        $res = model('sys_upgrade_log')->update($data, $condition);
        if ($res == false) {
            return $this->error('', 'UNKNOW_ERROR');
        } else {
            return $this->success();
        }
    }

    /**
     * 获取升级日志信息
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getUpgradeLogInfo($condition, $field = '*')
    {
        $info = model('sys_upgrade_log')->getInfo($condition, $field);
        if (!empty($info)) {
            $info[ 'version_info' ] = json_decode($info[ 'version_info' ], true);
        }
        return $info;
    }

    /**
     * 获取升级分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getUpgradeLogPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('sys_upgrade_log')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取升级日志列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getUpgradeLogList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('sys_upgrade_log')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 删除升级日志
     * @param $condition
     * @return array
     */
    public function deleteUpgradeLog($condition)
    {
        $log_list = model('sys_upgrade_log')->getList($condition, '*', 'upgrade_time asc');
        try {
            foreach ($log_list as $log) {
                $backup_root = $log[ 'backup_root' ];
                if (is_dir($backup_root)) {
                    unlink($backup_root);
                }
            }
            model('sys_upgrade_log')->delete($condition);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage());
        }
    }

    /******************************* 升级日志相关 end *****************************/

    public function getVersionLog($page, $page_size)
    {
        $app_info = config('info');
        $post_data = [
            'page_index' => $page,
            'page_size' => $page_size,
            'product_key' => $app_info[ 'name' ]
        ];
        $re = $this->doPost('/upgrade/upgrade/versionPage', $post_data);
        $re = json_decode($re, true);
        if (!empty($re[ 'data' ])) {

            //处理返回数据
            $return_data = [];
            foreach ($re[ 'data' ][ 'list' ] as $key => $val) {
                $val[ 'version_desc' ] = str_replace("\n", '<br/>', $val[ 'version_desc' ]);
                $day = date('Y-m-d', $val[ 'create_time' ]);
                $day_time = strtotime($day);
                $return_data[ $day_time ][] = $val;
            }

            $temp_arr = [];
            foreach ($return_data as $key => $value) {
                $temp_arr[] = [ 'list' => $value, 'time' => $key, 'format_time' => date('Y-m-d', $key) ];
            }

            $re[ 'data' ][ 'list' ] = $temp_arr;
        } else {
            $re[ 'data' ][ 'list' ] = [];
        }
        return $re;
    }

    /**
     * 获取所有插件
     * @return array|mixed
     */
    public function getPluginGoodsList()
    {
        $addon_list = Cache::get('website_addon_list');
        if (empty($addon_list)) {
            $app_info = config('info');
            $data = array (
                "product_key" => $app_info[ 'name' ],
            );
            $result = $this->doPost('/upgrade/auth/allplugin', $data);//授权
            if (empty($result))
                return $this->error();

            $result = json_decode($result, true);
            Cache::set('website_addon_list', $result[ 'data' ], 3 * 24 * 60 * 60);
            return $result[ 'data' ];
        } else {
            return $addon_list;
        }

    }

    /**
     * 下载uniapp
     * @param $version
     * @return array|mixed
     */
    public function downloadUniapp($version)
    {
        $data = array (
            "version" => $version
        );
        $result = $this->doPost('/upgrade/upgrade/downloaduniapp', $data);//授权

        if (empty($result))
            return $this->error();

        $result = json_decode($result, true);
        return $result;
    }

}
