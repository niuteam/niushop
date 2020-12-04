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
namespace addon\wechatpay\event;

use addon\wechatpay\model\Config;

/**
 * 支付方式  (前后台调用)
 */
class PayType
{
    /**
     * 支付方式及配置
     */
    public function handle($params)
    {
        $app_type = isset($params['app_type']) ? $params['app_type'] : '';
        if (!empty($app_type)) {
            $config_model   = new Config();
            $app_type_array = ['h5', 'wechat', 'weapp'];
            if (!in_array($app_type, $app_type_array)) {
                return '';
            }
            $config_result = $config_model->getPayConfig($params['site_id']);
            $config        = $config_result["data"]["value"] ?? [];
            $pay_status    = $config["pay_status"] ?? 0;
            if ($pay_status == 0) {
                return '';
            }
        }
        $info = array(
            "pay_type"      => "wechatpay",
            "pay_type_name" => "微信支付",
            "edit_url"      => "wechatpay://shop/pay/config",
            "shop_url"      => "wechatpay://shop/pay/config",
            "logo"          => "addon/wechatpay/icon.png",
            "desc"          => "微信支付，用户通过扫描二维码、微信内打开商品页面购买等多种方式调起微信支付模块完成支付。"
        );
        return $info;

    }
}