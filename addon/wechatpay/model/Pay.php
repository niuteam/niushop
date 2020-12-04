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

use app\model\member\Member;
use EasyWeChat\Factory;
use app\model\system\Pay as PayCommon;
use app\model\BaseModel;
use addon\weapp\model\Config as WeappConfig;
use addon\wechat\model\Config as WechatConfig;
use app\model\system\Pay as PayModel;

/**
 * 微信支付配置
 * 版本 1.0.4
 */
class Pay extends BaseModel
{
    private $app;//微信模型
    private $is_weapp = 0;
    private $config = [];

    public function __construct($is_weapp = 0, $site_id)
    {
        $this->is_weapp = $is_weapp;
        //微信支付配置
        $config_model = new Config();
        $config_result = $config_model->getPayConfig($site_id);
        $config = $config_result["data"];
        if (!empty($config)) {
            $config_info = $config["value"];
        }
        $app_id = "";
        if($is_weapp == 0){
            $wechat_config_model = new WechatConfig();
            $wechat_config_result = $wechat_config_model->getWechatConfig($site_id);
            $wechat_config = $wechat_config_result["data"];
            if(empty($wechat_config['value']))
            {
                $weapp_config_model = new WeappConfig();
                $weapp_config_result = $weapp_config_model->getWeappConfig($site_id);
                $weapp_config = $weapp_config_result["data"];
                $app_id = $weapp_config["value"]["appid"];
            }else{
                $app_id = $wechat_config["value"]["appid"];
            }

        }else{
            $weapp_config_model = new WeappConfig();
            $weapp_config_result = $weapp_config_model->getWeappConfig($site_id);
            $weapp_config = $weapp_config_result["data"];
            $app_id = $weapp_config["value"]["appid"];
        }

        $this->config = [
            'app_id' => $app_id,        //应用id
            'mch_id' => $config_info["mch_id"] ?? '',       //商户号
            'key' => $config_info["pay_signkey"] ?? '',          // API 密钥
            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
            'cert_path' => realpath($config_info["apiclient_cert"]) ?? '', // apiclient_cert.pem XXX: 绝对路径！！！！
            'key_path' => realpath($config_info["apiclient_key"]) ?? '',   // apiclient_key.pem XXX: 绝对路径！！！！
            'notify_url' => '',// 你也可以在下单时单独设置来想覆盖它
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
            /**
             * 日志配置
             *
             * level: 日志级别, 可选为：debug/info/notice/warning/error/critical/alert/emergency
             * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
             * file：日志文件位置(绝对路径!!!)，要求可写权限
             */
            'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file' => 'runtime/log/wechat/easywechat.logs',
            ],
            'sandbox' => false, // 设置为 false 或注释则关闭沙箱模式
        ];
//        $this->app = Factory::officialAccount($config);
//        $response = $this->app->server->serve();
        // 将响应输出
//        $response->send();exit; // Laravel 里请使用：return $response;
    }

    /**
     * 生成支付
     * @param $param
     */
    public function pay($param)
    {

        ///绑定商户数据
        $pay_model = new PayModel();
        $pay_model->bindMchPay($param["out_trade_no"], ["app_id" => $this->config["app_id"]]);

        $this->app = Factory::payment($this->config);
        $openid = "";
        //获取用户的open_id
        $member_model = new Member();
        switch ($param["trade_type"]) {
            case 'JSAPI' :
                if ($this->is_weapp == 1) {
                    $member_info_result = $member_model->getMemberInfo([["member_id", "=", $param["member_id"]]], "weapp_openid");
                    $member_info = $member_info_result["data"];
                    $openid = $member_info["weapp_openid"];
                } else {
                    $member_info_result = $member_model->getMemberInfo([["member_id", "=", $param["member_id"]]], "wx_openid");
                    $member_info = $member_info_result["data"];
                    $openid = $member_info["wx_openid"];
                }
                break;
            case 'NATIVE' :
                break;
            case 'MWEB' :
                break;
            case 'APP' :
                break;
        }
        $data = array(
            'body' => str_sub($param["pay_body"], 15),
            'out_trade_no' => $param["out_trade_no"],
            'total_fee' => $param["pay_money"] * 100,
//            'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            'notify_url' => $param["notify_url"], // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => $param["trade_type"], // 请对应换成你的支付方式对应的值类型
            'openid' => $openid,
        );
        $result = $this->app->order->unify($data);
        //调用支付失败
        if ($result["return_code"] == 'FAIL') {
            return $this->error([], $result["return_msg"]);
        }
        if ($result["result_code"] == 'FAIL') {
            return $this->error([], $result["err_code_des"]);
        }

        switch ($param["trade_type"]) {
            case 'JSAPI' ://微信支付 或小程序支付
                if ($this->is_weapp == 0) {
                    $jssdk = $this->app->jssdk;
                    $config = $jssdk->sdkConfig($result['prepay_id'], false);
                    $return = array(
                        "type" => "jsapi",
                        "data" => $config
                    );
                } else {
                    $jssdk = $this->app->jssdk;
                    $config = $jssdk->bridgeConfig($result['prepay_id'], false);
                    $return = array(
                        "type" => "jsapi",
                        "data" => $config
                    );
                }
                break;
            case 'APPLET' ://微信支付 或小程序支付
                $jssdk = $this->app->jssdk;
                $config = $jssdk->bridgeConfig($result['prepay_id'], false);
                $return = array(
                    "type" => "jsapi",
                    "data" => $config
                );
                break;
            case 'NATIVE' :
                $code_url = $result['code_url'];
                $return = array(
                    "type" => "qrcode",
                    "qrcode" => $code_url
                );
                break;
            case 'MWEB' ://H5支付
                $mweb_url = $result['mweb_url'];
                $return = array(
                    "type" => "url",
                    "url" => $mweb_url
                );
                break;
            case 'APP' :
                $jssdk = $this->app->jssdk;
                $config = $jssdk->appConfig($result['prepay_id']);
                $return = array(
                    "type" => "app",
                    "data" => $config
                );
                break;
        }
        return $this->success($return);
    }

    /**
     * 支付异步通知
     * @param $param
     * @return mixed
     */
    public function payNotify()
    {
        $this->app = Factory::payment($this->config);
        $response = $this->app->handlePaidNotify(function ($message, $fail) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单

            $pay_common = new PayCommon();
//            if (!empty($pay_info)) {
//                // 如果订单不存在 或者 订单已经支付过了
//                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
//            }
            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                if ($message['result_code'] === 'SUCCESS') {// 用户是否支付成功
                    //定义支付失败
                    $pay_common->onlinePay($message['out_trade_no'], "wechatpay", $message["transaction_id"], "wechatpay");
                } elseif ($message['result_code'] === 'FAIL') {// 用户支付失败
                    //定义支付失败(更新订单支付失败)

                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
            return true; // 返回处理完成
        });
//        $response->send();
//         return $response;
    }

    /**
     * 关闭支付
     * @param $param
     */
    public function close($param)
    {

        $pay_info = $param;
        $this->config["app_id"] = $pay_info["mch_info"];//替换为商户自己的appid
        $this->app = Factory::payment($this->config);
        $result = $this->app->order->close($param["out_trade_no"]);
        //调用支付失败
        if ($result["return_code"] == 'FAIL') {
            return $this->error([], $result["return_msg"]);
        }
        if ($result["result_code"] == 'FAIL') {
            return $this->error([], $result["err_code_des"]);
        }

        return $this->success();
    }

    /**
     * 微信原路退款
     * @param $param
     */
    public function refund($param)
    {
        $pay_info = $param["pay_info"];
        $this->config["app_id"] = $pay_info["mch_info"];//替换为商户自己的appid
        $this->app = Factory::payment($this->config);
        $refund_no = $param["refund_no"];
        $total_fee = $pay_info["pay_money"] * 100;
        $refund_fee = $param["refund_fee"] * 100;
        $desc_data = array();

//        $desc_data["refund_desc"] = $param["refund_reason"];// 商家退款原因 暂时不考虑
        if (!empty($pay_info["trade_no"])) {
            //根据微信订单号退款
            // 参数分别为：微信订单号、商户退款单号、订单金额、退款金额、其他参数
            $result = $this->app->refund->byTransactionId($pay_info["trade_no"], $refund_no, $total_fee, $refund_fee, $desc_data);
        } else {
            $result = $this->app->refund->byOutTradeNumber($pay_info["out_trade_no"], $refund_no, $total_fee, $refund_fee, $desc_data);
        }
        //调用支付失败
        if ($result["return_code"] == 'FAIL') {
            return $this->error([], $result["return_msg"]);
        }
        if ($result["result_code"] == 'FAIL') {
            return $this->error([], $result["err_code_des"]);
        }

        return $this->success();

    }

    /**
     * 微信转账到零钱
     * @param array $param
     */
    public function transfer(array $param)
    {
        try {
            $config_model = new Config();
            $config_result = $config_model->getPayConfig($param['site_id']);
            if ($config_result['code'] < 0) return $config_result;
            $config = $config_result['data']['value'];
            if (empty($config)) return $this->error([], '平台未配置微信支付');
            if (!$config['transfer_status']) return $this->error([], '平台未启用微信转账');

            $this->app = Factory::payment($this->config);
            $data = [
                'partner_trade_no' => $param['out_trade_no'], // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
                'openid' => $param['account_number'],
                'check_name' => 'FORCE_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
                're_user_name' => $param['real_name'], // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
                'amount' => $param['amount'] * 100, // 转账金额
                'desc' => $param['desc']
            ];
            $res = $this->app->transfer->toBalance($data);
            if ($res['return_code'] == 'SUCCESS') {
                if ($res['result_code'] == 'SUCCESS') {
                    return $this->success([
                        'out_trade_no' => $res['partner_trade_no'], // 商户交易号
                        'payment_no' => $res['payment_no'], // 微信付款单号
                        'payment_time' => $res['payment_time'] // 付款成功时间
                    ]);
                } else {
                    return $this->error([], $res['err_code_des']);
                }
            } else {
                return $this->error([], $res['return_msg']);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }
}