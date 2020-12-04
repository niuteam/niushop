<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */

namespace addon\niusms\event;

use addon\niusms\model\Order;

/**
 * 关闭短信充值订单
 */
class CloseSmsPayment
{
    public function handle($param)
    {
        $order = new Order();
        $res = $order->cronCloseSmsPayment($param[ 'relate_id' ]);
        return $res;
    }
}