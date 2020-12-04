<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\manjian\event;

use addon\manjian\model\Order;

/**
 * 订单完成
 */
class OrderComplete
{

    public function handle($params)
    {
        if (isset($params['order_id'])) {
            $order = new Order();
            $order->orderComplete($params['order_id']);
        }
    }
}