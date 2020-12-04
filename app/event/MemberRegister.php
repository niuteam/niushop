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

use app\model\message\Message;

/**
 * 注册成功发送通知
 */
class MemberRegister
{

    public function handle($param)
    {
        // 发送通知
        $message_model = new Message();
        $message_model->sendMessage(["keywords" => "REGISTER_SUCCESS", "member_id" => $param["member_id"], 'site_id' => $param['site_id']]);
    }

}