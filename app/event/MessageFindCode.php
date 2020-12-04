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
 * 找回密码发送验证码
 */
class MessageFindCode
{

    public function handle($param)
    {
        if ($param["keywords"] == "FIND_PASSWORD") {
            $member_model = new Member();
            $result       = $member_model->findCode($param);
            return $result;
        }
    }
}