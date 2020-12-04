<?php
/**
 * Pay.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace app\api\controller;

use app\model\order\Order as OrderModel;
use app\model\system\Pay as PayModel;

/**
 * 支付控制器
 */
class Pay extends BaseApi
{
    /**
     * 支付信息
     */
    public function info()
    {
        $out_trade_no = $this->params[ 'out_trade_no' ];
        $pay = new PayModel();
        $info = $pay->getPayInfo($out_trade_no);
        $order_model = new OrderModel();
        if (!empty($info[ 'data' ])) {
            $order_info = $order_model->getOrderInfo([ [ 'out_trade_no', '=', $out_trade_no ] ], 'order_id,order_type');
            $order_info = $order_info[ 'data' ];
            if (!empty($order_info)) {
                $info[ 'data' ][ 'order_id' ] = $order_info[ 'order_id' ];
                $info[ 'data' ][ 'order_type' ] = $order_info[ 'order_type' ];
            }
        }
        return $this->response($info);
    }

    /**
     * 支付调用
     */
    public function pay()
    {
        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);
        $pay_type = $this->params[ 'pay_type' ];
        $out_trade_no = $this->params[ 'out_trade_no' ];
        $app_type = $this->params[ 'app_type' ];
        $return_url = isset($this->params[ 'return_url' ]) && !empty($this->params[ 'return_url' ]) ? urldecode($this->params[ 'return_url' ]) : null;
        $pay = new PayModel();
        $info = $pay->pay($pay_type, $out_trade_no, $app_type, $this->member_id, $return_url);
        return $this->response($info);
    }

    /**
     * 支付方式
     */
    public function type()
    {
        $pay = new PayModel();
        $info = $pay->getPayType($this->params);
        $temp = empty($info) ? [] : $info;
        $type = [];
        foreach ($temp[ 'data' ] as $k => $v) {
            array_push($type, $v[ "pay_type" ]);
        }
        $type = implode(",", $type);
        return $this->response(success(0, '', [ 'pay_type' => $type ]));
    }

    /**
     * 获取订单支付状态
     */
    public function status()
    {
        $pay = new PayModel();
        $out_trade_no = $this->params[ 'out_trade_no' ];
        $res = $pay->getPayStatus($out_trade_no);
        return $this->response($res);
    }

}