<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 系统配置类
 */
class Config extends BaseModel
{

    /**
     * 配置系统配置项
     * @param array $value
     * @param string $config_desc
     * @param int $is_use
     * @param array $condition
     */
    public function setConfig($value, $config_desc, $is_use, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $app_module = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $config_key = isset($check_condition['config_key']) ? $check_condition['config_key'] : '';
        if (empty($config_key)) {
            return $this->error('', 'REQUEST_CONFIG_KEY');
        }
        $data                = $check_condition;
        $data['value']       = json_encode($value);
        $data['config_desc'] = $config_desc;
        $data['is_use']      = $is_use;
        $json_condition      = json_encode($condition);
        $config_model        = model('config');
        $info                = $config_model->getInfo($condition, 'id');
        Cache::tag("config")->clear();
        Cache::tag("config")->set("CONFIG_" . $json_condition, "");
        if (empty($info)) {
            $data['create_time'] = time();
            $res                 = $config_model->add($data);
        } else {
            $data['modify_time'] = time();
            $res                 = $config_model->update($data, $condition);
        }
        return $this->success($res);
    }

    /**
     * 获取系统配置信息
     * @param array $condition
     */
    public function getConfig($condition)
    {
        $json_condition = json_encode($condition);
        $cache          = Cache::get("CONFIG_" . $json_condition, "");
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $app_module = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $config_key = isset($check_condition['config_key']) ? $check_condition['config_key'] : '';
        if (empty($config_key)) {
            return $this->error('', 'REQUEST_CONFIG_KEY');
        }

        $info = model('config')->getInfo($condition, 'site_id, app_module, config_key, value, config_desc, is_use, create_time, modify_time');
        if (!empty($info)) {
            $info['value'] = json_decode($info['value'], true);
        } else {
            $info = [
                'site_id'     => $site_id,
                'app_module'  => $app_module,
                'config_key'  => $config_key,
                'value'       => [],
                'config_desc' => '',
                'is_use'      => 0,
                'create_time' => 0,
                'modify_time' => 0
            ];
        }
        Cache::tag("config")->set("CONFIG_" . $json_condition, $info);
        return $this->success($info);
    }

    /**
     * 修改配置项的使用状态
     * @param int $is_use
     * @param array $condition
     */
    public function modifyConfigIsUse($is_use, $condition)
    {
        $json_condition = json_encode($condition);
        $config_info    = $this->getConfig($condition);
        if ($config_info['code'] < 0) {
            return $config_info;
        }
        if (!empty($config_info['data']['value'])) {
            //配置过
            $res = model('config')->update(['is_use' => $is_use], $condition);

            Cache::tag("config")->set("CONFIG_" . $json_condition, "");

            return $this->success($res);
        } else {
            return $this->error('', 'CONFIG_NOT_EXIST');
        }
    }

    /**
     * 获取系统信息
     */
    public function getSystemConfig()
    {
        $system_config['os']                       = php_uname(); // 服务器操作系统
        $system_config['server_software']          = $_SERVER['SERVER_SOFTWARE']; // 服务器环境
        $system_config['upload_max_filesize']      = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow'; // 文件上传限制
        $system_config['gd_version']               = gd_info()['GD Version']; // GD（图形处理）版本
        $system_config['max_execution_time']       = ini_get("max_execution_time") . "秒"; // 最大执行时间
        $system_config['port']                     = $_SERVER['SERVER_PORT']; // 端口
        $system_config['dns']                      = $_SERVER['HTTP_HOST']; // 服务器域名
        $system_config['php_version']              = PHP_VERSION; // php版本
        $system_config['sockets']                  = extension_loaded('sockets'); //是否支付sockets
        $system_config['openssl']                  = extension_loaded('openssl'); //是否支付openssl
        $system_config['curl']                     = function_exists('curl_init'); // 是否支持curl功能
        $system_config['upload_dir_jurisdiction']  = check_dir_iswritable(realpath('./upload') . DIRECTORY_SEPARATOR); // upload目录读写权限
        $system_config['runtime_dir_jurisdiction'] = check_dir_iswritable(realpath('./runtime') . DIRECTORY_SEPARATOR); // runtime目录读写权限
        $system_config['fileinfo']                 = extension_loaded('fileinfo'); //是否支付fileinfo

        return $this->success($system_config);
    }

    /**
     * 删除配置
     * @param $condition
     */
    public function deleteConfig($condition)
    {
        $res = model('config')->delete($condition);
        $this->success($res);
    }
}