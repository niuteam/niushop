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

namespace addon\wechatpay\model;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;

/**
 * 微信支付配置
 * 版本 1.0.4
 */
class Config extends BaseModel
{

    /**
     * 设置支付配置
     * array $data
     */
    public function setPayConfig($data, $site_id = 0, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->setConfig($data, '微信支付配置', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'WECHAT_PAY_CONFIG']]);
        return $res;
    }

    /**
     * 获取支付配置
     */
    public function getPayConfig($site_id = 0, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'WECHAT_PAY_CONFIG']]);
        return $res;
    }
}