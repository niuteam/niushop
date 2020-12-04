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

namespace addon\wechatpay\shop\controller;

use addon\wechatpay\model\Config as ConfigModel;
use app\model\upload\Upload;
use app\shop\controller\BaseShop;
use think\facade\Config;

/**
 * 支付 控制器
 */
class Pay extends BaseShop
{
    public function config()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $appid           = input("appid", "");//公众账号ID
            $mch_id          = input("mch_id", "");//商户号
            $app_secrect     = input("app_secrect", "");//应用密钥
            $pay_signkey     = input("pay_signkey", "");//支付签名串API密钥
            $apiclient_cert  = input("apiclient_cert", "");//支付证书cert
            $apiclient_key   = input("apiclient_key", "");//支付证书key
            $app_type        = input("app_type", "");//支持端口 如web app
            $pay_status      = input("pay_status", 0);//支付启用状态
            $refund_status   = input("refund_status", 0);//退款启用状态
            $transfer_status = input("transfer_status", 0);//转账启用状态
            $data            = array(
                "appid"           => $appid,
                "mch_id"          => $mch_id,
                "app_secrect"     => $app_secrect,
                "pay_signkey"     => $pay_signkey,
                "apiclient_cert"  => $apiclient_cert,
                "apiclient_key"   => $apiclient_key,
                "refund_status"   => $refund_status,
                "pay_status"      => $pay_status,
                "transfer_status" => $transfer_status,
                "app_type"        => $app_type
            );
            $result          = $config_model->setPayConfig($data, $this->site_id, $this->app_module);
            return $result;
        } else {
            $info_result = $config_model->getPayConfig($this->site_id, $this->app_module);
            $info        = $info_result["data"];
            if (!empty($info['value'])) {
                $app_type_arr = [];
                if (!empty($info['value']['app_type'])) {
                    $app_type_arr = explode(',', $info['value']['app_type']);
                }
                $info['value']['app_type_arr'] = $app_type_arr;
            }
            $this->assign("info", $info);
            $this->assign("app_type", Config::get("app_type"));
            return $this->fetch("pay/config");
        }
    }


    /**
     * 上传微信支付证书
     */
    public function uploadWechatCert()
    {
        $upload_model = new Upload();
        $site_id      = request()->siteid();
        $name         = input("name", "");
        $extend_type  = ['pem'];
        $param        = array(
            "name"        => "file",
            "extend_type" => $extend_type
        );

        $site_id = $site_id > 0 ? $site_id : 0;
        $result  = $upload_model->setPath("common/wechat/cert/" . $site_id . "/")->file($param);
        return $result;
    }
}