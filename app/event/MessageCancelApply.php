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

use addon\membercancel\model\MemberCancel;

/**
 *  会员注销申请通知
 */
class MessageCancelApply
{
    /**
     * @param $param
     */
    public function handle($param)
    {
        if ($param["keywords"] == "USER_CANCEL_APPLY") {
            $model = new MemberCancel();
            return $model->memberCancelApply($param);
        }
    }

}