<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\Controller;
use app\model\order\OrderCommon as OrderCommonModel;

/**
 * 打印
 * Class Printer
 * @package app\shop\controller
 */
class Printer extends Controller
{

    /**
     * 批量打印发货单
     * @return mixed
     */
    public function batchPrintOrder()
    {
        $order_id            = input('order_id', 0);
        $order_common_model  = new OrderCommonModel();
        $order_detail_result = $order_common_model->getUnRefundOrderDetail($order_id);
        $order_detail        = $order_detail_result["data"];
        $this->assign("order_detail", $order_detail);
        return $this->fetch('order/batch_print_order');
    }


}