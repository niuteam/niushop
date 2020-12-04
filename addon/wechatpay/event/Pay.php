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

use addon\wechatpay\model\Pay as PayModel;

/**
 * 生成支付
 */
class Pay
{
    /**
     * 支付
     */
    public function handle($params)
    {
        if ($params["pay_type"] == "wechatpay") {

            $app_type = $params['app_type'];
            $is_weapp = 0;
            switch ($app_type) {
                case 'h5' :
                    $trade_type = "MWEB";
                    break;
                case 'wechat' :
                    $trade_type = "JSAPI";
                    break;
                case 'weapp' :
                    $is_weapp   = 1;
                    $trade_type = "JSAPI";
                    break;
                case 'app' :
                    $trade_type = "APP";
                    break;
                case 'pc' :
                    $trade_type = "NATIVE";
                    break;
            }
            $params["trade_type"] = $trade_type;
            $pay_model            = new PayModel($is_weapp, $params['site_id']);
            $result               = $pay_model->pay($params);
            return $result;
        }
    }
}