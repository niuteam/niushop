<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace app\api\controller;

use app\model\member\Login as LoginModel;
use app\model\message\Message;
use app\model\member\Register as RegisterModel;
use Exception;
use think\facade\Cache;
use app\model\member\Config as ConfigModel;
use app\model\web\Config;

class Login extends BaseApi
{
    /**
     * 登录方法
     */
    public function login()
    {
        $config      = new ConfigModel();
        $config_info = $config->getRegisterConfig($this->site_id, 'shop');
        if (strstr($config_info['data']['value']['login'], 'username') === false) return $this->response($this->error([], "用户名登录未开启!"));

        // 校验验证码
        $config_model = new Config();
        $info = $config_model->getCaptchaConfig();
        if($info['data']['value']['shop_reception_login'] == 1){
            $captcha   = new Captcha();
            $check_res = $captcha->checkCaptcha();
            if ($check_res['code'] < 0) return $this->response($check_res);
        }

        // 登录
        $login = new LoginModel();
        if (empty($this->params["password"]))
            return $this->response($this->error([], "密码不可为空!"));

        $res = $login->login($this->params);

        //生成access_token
        if ($res['code'] >= 0) {
            $token = $this->createToken($res['data']['member_id']);
            return $this->response($this->success(['token' => $token]));
        }
        return $this->response($res);
    }

    /**
     * 第三方登录
     */
    public function auth()
    {
        $login       = new LoginModel();
        $res         = $login->authLogin($this->params);
        //生成access_token
        if ($res['code'] >= 0) {
            $token = $this->createToken($res['data']['member_id']);
            return $this->response($this->success(['token' => $token]));
        }
        return $this->response($res);
    }

    /**
     * 检测openid是否存在
     */
    public function openidIsExits()
    {
        $login       = new LoginModel();
        $res         = $login->openidIsExits($this->params);
        return $this->response($res);
    }

    /**
     * 手机动态码登录
     */
    public function mobile()
    {
        $config      = new ConfigModel();
        $config_info = $config->getRegisterConfig($this->site_id, 'shop');
        if (strstr($config_info['data']['value']['login'], 'mobile') === false) return $this->response($this->error([], "动态码登录未开启!"));

        $key         = $this->params['key'];
        $verify_data = Cache::get($key);
        if ($verify_data["mobile"] == $this->params["mobile"] && $verify_data["code"] == $this->params["code"]) {

            $register = new RegisterModel();
            $exist    = $register->mobileExist($this->params["mobile"], $this->site_id);

            if ($exist) {
                $login = new LoginModel();
                $res   = $login->mobileLogin($this->params);
                if ($res['code'] >= 0) {
                    $token = $this->createToken($res['data']['member_id']);
                    $res   = $this->success(['token' => $token]);
                }
            } else {
                $res = $this->error("", "该手机号未注册");
            }
        } else {
            $res = $this->error("", "手机动态码不正确");
        }
        return $this->response($res);

    }

    /**
     * 手机号登录验证码
     * @throws Exception
     */
    public function mobileCode()
    {
        // 校验验证码
        $config_model = new Config();
        $info = $config_model->getCaptchaConfig();
        if($info['data']['value']['shop_reception_login'] == 1){
            $captcha   = new Captcha();
            $check_res = $captcha->checkCaptcha(false);
            if ($check_res['code'] < 0) return $this->response($check_res);
        }

        $mobile = $this->params['mobile'];

        if (empty($mobile)) return $this->response($this->error([], "手机号不可为空!"));

        $register = new RegisterModel();
        $exist    = $register->mobileExist($this->params["mobile"], $this->site_id);
        if (!$exist) return $this->response($this->error([], "该手机号未注册!"));

        $code          = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
        $message_model = new Message();
        $res           = $message_model->sendMessage(["mobile" => $mobile, "site_id" => $this->site_id, "support_type" => ['sms'], "code" => $code, "keywords" => "LOGIN_CODE"]);
        if ($res["code"] >= 0) {
            //将验证码存入缓存
            $key = 'login_mobile_code_' . md5(uniqid(null, true));
            Cache::tag("login_mobile_code")->set($key, ['mobile' => $mobile, 'code' => $code], 600);
            return $this->response($this->success(["key" => $key]));
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
        if ($decrypt_data['code'] < 0) return $this->response($decrypt_data);

        $this->params['mobile'] = $decrypt_data['data']['purePhoneNumber'];

        $register = new RegisterModel();
        $exist    = $register->mobileExist($this->params["mobile"], $this->site_id);

        if ($exist) {
            $login = new LoginModel();
            $res   = $login->mobileLogin($this->params);
            if ($res['code'] >= 0) {
                $token = $this->createToken($res['data']['member_id']);
                $res   = $this->success(['token' => $token]);
            }
        } else {
            $res = $register->mobileRegister($this->params);
            if ($res['code'] >= 0) {
                $token = $this->createToken($res['data']);
                $res   = $this->success(['token' => $token]);
            }
        }
        return $this->response($res);
    }

    /**
     * 验证token有效性
     */
    public function verifyToken(){
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        return $this->response($this->success());
    }
}