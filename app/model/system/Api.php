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

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;

/**
 * 接口api配置
 */
class Api extends BaseModel
{


    /***************************************************************接口api 开始********************************************************/
    /**
     * 获取api配置
     */
    public function getApiConfig($site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'API_CONFIG']]);
        return $res;
    }

    /**
     * 设置api配置
     * @param $data
     * @return \multitype
     */
    public function setApiConfig($data, $is_use, $site_id = 1, $app_module = 'shop')
    {
        $old_config = $this->getApiConfig($site_id, $app_module);
        $old_config = $old_config['data'];

        $config = new ConfigModel();
        $res    = $config->setConfig($data, 'api配置', $is_use, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'API_CONFIG']]);

        if ($old_config['is_use'] != $is_use || json_encode($old_config['value']) != json_encode($data)) {
            $cron = new Cron();
            $cron->addCron(1, 0, 'api配置更新', 'ApiConfigChange', (time() + 10), 0);
        }
        return $res;
    }
    /***************************************************************接口api 结束********************************************************/

}