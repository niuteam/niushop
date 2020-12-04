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

use app\model\member\Login as LoginModel;
use app\model\message\Message;
use app\model\member\Register as RegisterModel;
use app\model\web\Config as WebConfig;
use think\facade\Cache;

/**
 * 第三方自动注册绑定手机
 * Class Tripartite
 * @package app\api\controller
 */
class Tripartite extends BaseApi
{
    /**
     * 绑定手机号
     */
    public function mobile()
    {
        $key = $this->params[ 'key' ];
        $verify_data = Cache::get($key);
        if ($verify_data[ "mobile" ] == $this->params[ "mobile" ] && $verify_data[ "code" ] == $this->params[ "code" ]) {
            $register = new RegisterModel();
            $exist = $register->mobileExist($this->params[ "mobile" ], $this->site_id);

            if ($exist) {
                $login = new LoginModel();
                $res = $login->mobileLogin($this->params);
                if ($res[ 'code' ] >= 0) {
                    $token = $this->createToken($res[ 'data' ][ 'member_id' ]);
                    $res = $this->success([ 'token' => $token ]);
                }
            } else {
                $res = $register->mobileRegister($this->params);
                if ($res[ 'code' ] >= 0) {
                    $token = $this->createToken($res[ 'data' ]);
                    $res = $this->success([ 'token' => $token, 'is_register' => 1 ]);
                }
            }
        } else {
            $res = $this->error("", "手机动态码不正确");
        }
        return $this->response($res);
    }

    /**
     * 绑定手机验证码
     * @throws Exception
     */
    public function mobileCode()
    {
        // 校验验证码
        $config_model = new WebConfig();
        $info = $config_model->getCaptchaConfig();
        if ($info[ 'data' ][ 'value' ][ 'shop_reception_login' ] == 1) {
            $captcha = new Captcha();
            $check_res = $captcha->checkCaptcha(false);
            if ($check_res[ 'code' ] < 0) return $this->response($check_res);
        }
        $mobile = $this->params[ 'mobile' ];

        if (empty($mobile)) return $this->response($this->error([], "手机号不可为空!"));

        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
        $message_model = new Message();
        $res = $message_model->sendMessage([ "mobile" => $mobile, "site_id" => $this->site_id, "support_type" => [ 'sms' ], "code" => $code, "keywords" => "MEMBER_BIND" ]);
        if ($res[ "code" ] >= 0) {
            //将验证码存入缓存
            $key = 'bind_mobile_code_' . md5(uniqid(null, true));
            Cache::tag("bind_mobile_code_")->set($key, [ 'mobile' => $mobile, 'code' => $code ], 600);
            return $this->response($this->success([ "key" => $key ]));
        } else {
            return $this->response($res);
        }
    }

    /**
     * 手机号授权登录
     */
    public function mobileAuth()
    {
        $decrypt_data = event('DecryptData', $this->params, true);
        if ($decrypt_data[ 'code' ] < 0) return $this->response($decrypt_data);

        $this->params[ 'mobile' ] = $decrypt_data[ 'data' ][ 'purePhoneNumber' ];

        $register = new RegisterModel();
        $exist = $register->mobileExist($this->params[ "mobile" ], $this->site_id);

        if ($exist) {
            $login = new LoginModel();
            $res = $login->mobileLogin($this->params);
            if ($res[ 'code' ] >= 0) {
                $token = $this->createToken($res[ 'data' ][ 'member_id' ]);
                $res = $this->success([ 'token' => $token ]);
            }
        } else {
            $res = $register->mobileRegister($this->params);
            if ($res[ 'code' ] >= 0) {
                $token = $this->createToken($res[ 'data' ]);
                $res = $this->success([ 'token' => $token, 'is_register' => 1 ]);
            }
        }
        return $this->response($res);
    }
}