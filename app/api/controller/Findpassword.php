<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 */

namespace app\api\controller;

use app\model\member\Member as MemberModel;
use app\model\member\Register as RegisterModel;
use app\model\message\Message;
use think\facade\Cache;

class Findpassword extends BaseApi
{

    /**
     * 手机号找回密码
     */
    public function mobile()
    {
        $register = new RegisterModel();
        $exist    = $register->mobileExist($this->params['mobile'], $this->site_id);
        if (!$exist) {
            return $this->response($this->error("", "手机号不存在"));
        } else {
            $key         = $this->params['key'];
            $verify_data = Cache::get($key);
            if ($verify_data["mobile"] == $this->params["mobile"] && $verify_data["code"] == $this->params["code"]) {
                $member_model = new MemberModel();
                $res          = $member_model->resetMemberPassword($this->params["password"], [["mobile", "=", $this->params['mobile']]]);
            } else {
                $res = $this->error("", "手机动态码不正确");
            }
            return $this->response($res);
        }

    }

    /**
     * 短信验证码
     */
    public function mobileCode()
    {
        // 校验验证码
        $captcha   = new Captcha();
        $check_res = $captcha->checkCaptcha();
        if ($check_res['code'] < 0) return $this->response($check_res);

        $mobile   = $this->params['mobile'];//注册手机号
        $register = new RegisterModel();
        $exist    = $register->mobileExist($mobile, $this->site_id);
        if (!$exist) {
            return $this->response($this->error("", "手机号不存在"));
        } else {
            $code          = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
            $message_model = new Message();
            $res           = $message_model->sendMessage(["mobile" => $mobile, "site_id" => $this->site_id, "code" => $code, "support_type" => ["sms"], "keywords" => "FIND_PASSWORD"]);
            if ($res["code"] >= 0) {
                //将验证码存入缓存
                $key = 'find_mobile_code_' . md5(uniqid(null, true));
                Cache::tag("find_mobile_code")->set($key, ['mobile' => $mobile, 'code' => $code], 600);
                return $this->response($this->success(["key" => $key]));
            } else {
                return $this->response($res);
            }
        }
    }
}