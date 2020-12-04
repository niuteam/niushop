<?php
/**
 * Index.php
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

use app\model\order\OrderCreate as OrderCreateModel;

/**
 * 订单创建
 * @author Administrator
 *
 */
class Ordercreate extends BaseApi
{
    /**
     * 创建订单
     */
    public function create()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        $data         = [
            'cart_ids'        => isset($this->params['cart_ids']) ? $this->params['cart_ids'] : '',
            'sku_id'          => isset($this->params['sku_id']) ? $this->params['sku_id'] : '',
            'num'             => isset($this->params['num']) ? $this->params['num'] : '',
            'site_id'         => $this->site_id,//站点id
            'member_id'       => $this->member_id,
            'is_balance'      => isset($this->params['is_balance']) ? $this->params['is_balance'] : 0,//是否使用余额
            'is_point'        => isset($this->params['is_point']) ? $this->params['is_point'] : 1,//是否使用积分
            'order_from'      => $this->params['app_type'],
            'order_from_name' => $this->params['app_type_name'],
            'pay_password'    => isset($this->params['pay_password']) ? $this->params['pay_password'] : '',//支付密码
            'buyer_message'   => isset($this->params["buyer_message"]) && !empty($this->params["buyer_message"]) ? $this->params["buyer_message"] : '',
            'delivery'        => isset($this->params["delivery"]) && !empty($this->params["delivery"]) ? json_decode($this->params["delivery"], true) : [],
            'coupon'          => isset($this->params["coupon"]) && !empty($this->params["coupon"]) ? json_decode($this->params["coupon"], true) : [],
            'member_address'  => isset($this->params["member_address"]) && !empty($this->params["member_address"]) ? json_decode($this->params["member_address"], true) : [],

            'latitude'  => $this->params["latitude"] ?? null,
            'longitude' => $this->params["longitude"] ?? null,

            'is_invoice'              => $this->params["is_invoice"] ?? 0,
            'invoice_type'            => $this->params["invoice_type"] ?? 0,
            'invoice_title'           => $this->params["invoice_title"] ?? '',
            'taxpayer_number'         => $this->params["taxpayer_number"] ?? '',
            'invoice_content'         => $this->params["invoice_content"] ?? '',
            'invoice_full_address'    => $this->params["invoice_full_address"] ?? '',
            'is_tax_invoice'          => $this->params["is_tax_invoice"] ?? 0,
            'invoice_email'           => $this->params["invoice_email"] ?? '',
            'invoice_title_type'      => $this->params["invoice_title_type"] ?? 0,
            'buyer_ask_delivery_time' => $this->params["buyer_ask_delivery_time"] ?? '',
        ];
        if (empty($data['cart_ids']) && empty($data['sku_id'])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        
        $res = $order_create->create($data);
        return $this->response($res);
    }

    /**
     * 计算信息
     */
    public function calculate()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        $data         = [
            'cart_ids'        => isset($this->params['cart_ids']) ? $this->params['cart_ids'] : '',
            'sku_id'          => isset($this->params['sku_id']) ? $this->params['sku_id'] : '',
            'num'             => isset($this->params['num']) ? $this->params['num'] : '',
            'site_id'         => $this->site_id,//站点id
            'member_id'       => $this->member_id,
            'is_balance'      => isset($this->params['is_balance']) ? $this->params['is_balance'] : 0,//是否使用余额
            'is_point'        => isset($this->params['is_point']) ? $this->params['is_point'] : 1,//是否使用积分
            'order_from'      => $this->params['app_type'],
            'order_from_name' => $this->params['app_type_name'],
            'delivery'        => isset($this->params["delivery"]) && !empty($this->params["delivery"]) ? json_decode($this->params["delivery"], true) : [],
            'coupon'          => isset($this->params["coupon"]) && !empty($this->params["coupon"]) ? json_decode($this->params["coupon"], true) : [],
            'member_address'  => isset($this->params["member_address"]) && !empty($this->params["member_address"]) ? json_decode($this->params["member_address"], true) : [],

            'latitude'  => $this->params["latitude"] ?? null,
            'longitude' => $this->params["longitude"] ?? null,

            'is_invoice'              => $this->params["is_invoice"] ?? 0,
            'invoice_type'            => $this->params["invoice_type"] ?? 0,
            'invoice_title'           => $this->params["invoice_title"] ?? '',
            'taxpayer_number'         => $this->params["taxpayer_number"] ?? '',
            'invoice_content'         => $this->params["invoice_content"] ?? '',
            'invoice_full_address'    => $this->params["invoice_full_address"] ?? '',
            'is_tax_invoice'          => $this->params["is_tax_invoice"] ?? 0,
            'invoice_email'           => $this->params["invoice_email"] ?? '',
            'invoice_title_type'      => $this->params["invoice_title_type"] ?? 0,
            'buyer_ask_delivery_time' => $this->params["buyer_ask_delivery_time"] ?? '',
        ];
        if (empty($data['cart_ids']) && empty($data['sku_id'])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        $res = $order_create->calculate($data);
        return $this->response($this->success($res));

    }

    /**
     * 待支付订单 数据初始化
     * @return string
     */
    public function payment()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $order_create = new OrderCreateModel();
        $data         = [
            'cart_ids'         => isset($this->params['cart_ids']) ? $this->params['cart_ids'] : '',
            'sku_id'           => isset($this->params['sku_id']) ? $this->params['sku_id'] : '',
            'site_id'          => $this->site_id,//站点id
            'num'              => isset($this->params['num']) ? $this->params['num'] : '',
            'member_id'        => $this->member_id,
            'is_balance'       => isset($this->params['is_balance']) ? $this->params['is_balance'] : 0,//是否使用余额
            'is_point'         => isset($this->params['is_point']) ? $this->params['is_point'] : 1,//是否使用积分
            'order_from'       => $this->params['app_type'],
            'order_from_name'  => $this->params['app_type_name'],
            'latitude'         => $this->params["latitude"] ?? null,
            'longitude'        => $this->params["longitude"] ?? null,
            'default_store_id' => $this->params["default_store_id"] ?? 0,
        ];
        if (empty($data['cart_ids']) && empty($data['sku_id'])) {
            return $this->response($this->error('', '缺少必填参数商品数据'));
        }
        $res = $order_create->orderPayment($data);
        return $this->response($this->success($res));
    }

}