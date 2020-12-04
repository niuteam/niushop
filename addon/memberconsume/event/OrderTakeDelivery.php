<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\memberconsume\event;

use addon\memberconsume\model\Consume as ConsumeModel;

/**
 * 订单收货事件
 */
class OrderTakeDelivery
{

    public function handle($data)
    {
        $consume_model = new ConsumeModel();
        $res           = $consume_model->memberConsume(['order_id' => $data['order_id'], 'status' => 'receive']);
        return $res;
    }
}