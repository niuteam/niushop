<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */

namespace addon\niusms\shop\controller;

use addon\niusms\model\Config as ConfigModel;
use addon\niusms\model\Order as SmsOrderModel;
use addon\niusms\model\Sms as SmsModel;
use app\shop\controller\BaseShop;

/**
 * 牛云云短信 控制器
 */
class Sms extends BaseShop
{

    private $replace = [
        'NIU_SMS_CSS' => __ROOT__ . '/addon/niusms/shop/view/public/css',
        'NIU_SMS_JS' => __ROOT__ . '/addon/niusms/shop/view/public/js',
        'NIU_SMS_IMG' => __ROOT__ . '/addon/niusms/shop/view/public/img',
    ];

    public function index()
    {
        $buy = input("buy", 0);
        $return = input("return", 0);
        $sms_model = new SmsModel();
        $config_model = new ConfigModel();
        $sms_config = $config_model->getSmsConfig($this->site_id, $this->app_module);
        $sms_config = $sms_config[ 'data' ];
        if (!empty($sms_config[ 'value' ][ 'username' ])) {
            if ($return == 1) {
                return $this->returnUrl();
            } elseif ($buy == 1) {
                // 短信充值
                $sms_package_list = $sms_model->getSmsPackageList();
                $this->assign("sms_package_list", $sms_package_list[ 'data' ]);
                return $this->fetch("sms/buy");
            } else {
                // 个人主页
                $account_info = $sms_model->getChildAccountInfo([
                    'username' => input('username', $sms_config[ 'value' ][ 'username' ]),//子账户用户名
                ]);
                if (!empty($account_info[ 'data' ])) {
                    $this->assign("account_info", $account_info[ 'data' ]);
                    if (!isset($sms_config[ 'value' ][ 'signature' ])) {
                        $sms_config[ 'value' ][ 'signature' ] = '';
                    }
                    $this->assign("sms_config", $sms_config);
                    $signature_status = $sms_model->querySignature($this->site_id, $this->app_module);
                    $this->assign("signature_status", $signature_status);

                    return $this->fetch("sms/index");
                } else {
                    $this->redirect(addon_url("niusms://shop/sms/login"));
                }
            }
        } else {
            // 未注册
            $this->redirect(addon_url("niusms://shop/sms/login"));
        }
    }

    /**
     * 注册
     * @return array|mixed
     */
    public function register()
    {
        if (request()->isAjax()) {
            $sms_model = new SmsModel();
            $res = $sms_model->createChildAccount([
                'username' => input('username', ''),//子账户用户名
                'password' => input('password', ''),//子账户密码
                'company' => input('company', ''),//子账户公司名
                'mobiles' => input('mobiles', '')//子账户手机号
            ], $this->site_id, $this->app_module);
            return $res;
        } else {
            return $this->fetch("sms/register");
        }
    }

    /**
     * 登录
     * @return array|mixed
     */
    public function login()
    {
        if (request()->isAjax()) {
            $sms_model = new SmsModel();
            $res = $sms_model->loginAccount([
                'username' => input('username', ''),//子账户用户名
                'password' => input('password', ''),//子账户密码
            ], $this->site_id, $this->app_module);
            return $res;
        } else {
            return $this->fetch("sms/login");
        }
    }

    /**
     * 编辑短信签名
     * @return array|mixed
     */
    public function addChildSignature()
    {
        if (request()->isAjax()) {
            $sms_model = new SmsModel();
            $config_model = new ConfigModel();
            $sms_config = $config_model->getSmsConfig($this->site_id, $this->app_module);
            $sms_config = $sms_config[ 'data' ][ 'value' ];
            $res = $sms_model->addChildSignature([
                'username' => $sms_config[ 'username' ],
                'signature' => input('signature', ''),//短信签名
            ], $this->site_id, $this->app_module);
            return $res;
        }
    }

    /**
     * 订单计算
     * @return mixed
     */
    public function calculate()
    {
        if (request()->isAjax()) {
            $sms_model = new SmsOrderModel();
            $res = $sms_model->calculate([
                    'package_id' => input('package_id', 0),
                    'is_invoice' => input('is_invoice', 0),
                    'invoice_id' => input('invoice_id', 0)
                ]
            );
            return $res;
        }
    }

    /**
     * 创建短信订单
     * @return mixed
     */
    public function createSmsOrder()
    {
        if (request()->isAjax()) {
            $sms_order_model = new SmsOrderModel();
            $config_model = new ConfigModel();
            $sms_config = $config_model->getSmsConfig($this->site_id, $this->app_module);
            $sms_config = $sms_config[ 'data' ][ 'value' ];
            $res = $sms_order_model->createSmsOrder([
                    'username' => $sms_config[ 'username' ],
                    'package_id' => input('package_id', 0),
                    'is_invoice' => input('is_invoice', 0),
                    'consigner' => input('name', ''),
                    'mobile' => input('mobile', ''),
                    'address' => input('address', ''),
                    'zip_code' => input('zip_code', ''),
                    'invoice_title' => input('invoice_title', ''),
                    'invoice_id' => input('invoice_id', 0),
                    'invoice_number' => input('invoice_number', ''),
                    'invoice_content' => input('invoice_content', '')
                ]
            );

//            if ($res[ 'code' ] >= 0) {
            //添加关闭短信充值订单事件
//                $cron = new Cron();
//                $execute_time = ( time() + ( 60 * 15 ) );
//                $cron->addCron(1, 0, "关闭短信充值订单", "CloseSmsPayment", $execute_time, $res[ 'data' ][ 'out_trade_no' ]);
//                event('CloseSmsPayment', [ 'relate_id' => $res[ 'data' ][ 'out_trade_no' ] ], true);
//            }
            return $res;
        }
    }

    /**
     * 调用支付宝支付
     */
    public function payment()
    {
        $return_url = __ROOT__ . '/index.php/niusms/shop/sms/index?return=1';
        $sms_model = new SmsOrderModel();
        $res = $sms_model->payment([
                'out_trade_no' => input('out_trade_no', '159618756248971000'),//子账户用户名
                'return_url' => $return_url,
            ]
        );
        echo $res;
    }

    /**
     * 支付同步回调
     * @return mixed
     */
    public function returnUrl()
    {
        $out_trade_no = input("out_trade_no", "");
        $this->assign("out_trade_no", $out_trade_no);
        $sms_model = new SmsOrderModel();
        $order_info = $sms_model->getSmsOrderInfo([ 'out_trade_no' => $out_trade_no ]);
        $order_info = $order_info[ 'data' ];
        $this->assign("order_info", $order_info);
        return $this->fetch("sms/pay_result", [], $this->replace);
    }

    /**
     * 获取短信模板分页列表
     * @return array
     */
    public function getSmsTemplatePageList()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $sms_model = new SmsModel();
            $list = $sms_model->getSmsTemplatePageList($this->site_id, [], $page, $page_size);
            foreach ($list[ 'data' ][ 'list' ] as $k => $v) {
                $audit_status = $sms_model->getAuditStatus();
                $list[ 'data' ][ 'list' ][ $k ][ 'audit_status_name' ] = $audit_status [ $v[ 'audit_status' ] ];
            }
            return $list;
        }
    }

    /**
     * 开关短信
     * @return array
     */
    public function modifyConfigIsUse()
    {
        $config_model = new ConfigModel();
        $is_use = input("is_use", 0);
        $result = $config_model->modifyConfigIsUse($is_use, $this->site_id, $this->app_module);
        return $result;
    }

    /**
     * 获取短信充值订单列表
     * @return mixed
     */
    public function getSmsOrderList()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $config_model = new ConfigModel();
            $sms_config = $config_model->getSmsConfig($this->site_id, $this->app_module);
            $sms_config = $sms_config[ 'data' ][ 'value' ];
            $sms_model = new SmsOrderModel();
            $order_list = $sms_model->getSmsOrderList([ 'page' => $page, 'page_size' => $page_size, 'username' => $sms_config[ 'username' ] ]);
            return $order_list;
        }
    }

    /**
     * 签名管理
     */
    public function signList()
    {
        //短信配置
        $config_model = new ConfigModel();
        $sms_config = $config_model->getSmsConfig($this->site_id, $this->app_module);
        $sms_config = $sms_config[ 'data' ][ 'value' ];

        if(request()->isAjax()){

            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $signature = input('signature','');
            $status = input('status','');//审核状态 1 - 待审核，2 - 审核通过，3 - 审核不通过;

            $data = [
                'page' => $page,
                'page_size' => $page_size,
                'username' => $sms_config[ 'username' ],
                'signature' => $signature,
                'status' => $status
            ];
            $sms_model = new SmsModel();
            $list = $sms_model->getChildSignatureList($data);
            return $list;
        }else{

            $this->assign('sms_config',$sms_config);
            return $this->fetch('sms/sign_list');
        }
    }

    /**
     * 更换签名
     */
    public function changeSignature()
    {
        if(request()->isAjax()){

            $signature = input('signature','');

            //短信配置
            $config_model = new ConfigModel();
            $sms_config_result = $config_model->getSmsConfig($this->site_id, $this->app_module);
            $sms_config = $sms_config_result[ 'data' ][ 'value' ];

            $sms_config['signature'] = $signature;

            $res = $config_model->setSmsConfig($sms_config,$sms_config_result['data']['is_use'],$this->site_id,$this->app_module);
            return $res;
        }
    }

}