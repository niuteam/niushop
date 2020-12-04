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

use addon\fenxiao\model\FenxiaoWithdraw;

/**
 *  分销提现成功发送消息
 */
class MessageFenxiaoWithdrawalSuccess
{
    /**
     * @param $param
     */
    public function handle($param)
    {
        //发送订单消息
        if ($param["keywords"] == "FENXIAO_WITHDRAWAL_SUCCESS") {
            //发送订单消息
            $model = new FenxiaoWithdraw();
            return $model->messageFenxiaoWithdrawalSuccess($param);
        }
    }

}