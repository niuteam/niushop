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

namespace app\event;

use app\model\order\OrderCommon;

/**
 * 订单自动收货
 */
class CronOrderTakeDelivery
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {

        $order             = new OrderCommon();
        $order_info_result = $order->getOrderInfo([["order_id", "=", $data["relate_id"]]], "order_status");
        if (!empty($order_info_result) && $order_info_result["data"]["order_status"] != 10) {
            $result = $order->OrderCommonTakeDelivery($data["relate_id"]);//订单自动收货
            return $result;
        }
    }
}