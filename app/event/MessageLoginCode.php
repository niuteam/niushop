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

use app\model\member\Login;


/**
 * 登录发送验证码
 */
class MessageLoginCode
{

    public function handle($param)
    {
        //发送订单消息
        if ($param["keywords"] == "LOGIN_CODE") {
            $login_model = new Login();
            $result      = $login_model->loginCode($param);
            return $result;
        }
    }
}