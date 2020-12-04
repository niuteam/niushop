<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\order\OrderCommon;
use app\model\order\StoreOrder;

/**
 * 门店订单提货
 */
class PickupOrderVerify
{

    public function handle($data)
    {
        if ($data['verify_type'] == 'pickup') {
            $store_order = new StoreOrder();
            $result      = $store_order->verify($data['verify_code']);
            return $result;
        }
        return '';
    }

}