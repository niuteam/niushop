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

use app\model\member\Member;


/**
 * 绑定发送验证码
 */
class MessageBindCode
{

    public function handle($param)
    {
        //发送订单消息
        if ($param["keywords"] == "MEMBER_BIND") {
            $member_model = new Member();
            $result       = $member_model->bindCode($param);
            return $result;
        }
    }
}