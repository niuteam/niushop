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
use app\model\system\User as UserModel;
use app\model\web\Config as ConfigModel;
use app\model\web\WebSite as WebsiteModel;
use think\captcha\facade\Captcha as ThinkCaptcha;
use think\facade\Cache;
use app\model\system\Site;

/**
 * 登录
 * Class Login
 * @package app\shop\controller
 */
class Login extends Controller
{

    protected $app_module = "shop";

    public function __construct()
    {
        parent::__construct();
        $this->assign("shop_module", SHOP_MODULE);
    }

    /**
     * 登录首页
     * @return mixed
     */
    public function login()
    {
        $site_id = request()->siteid();
        $config_model = new ConfigModel();
        $config_info = $config_model->getCaptchaConfig();
        $config = $config_info[ 'data' ][ 'value' ];
        $this->assign('shop_login', $config[ 'shop_login' ]);
        if (request()->isAjax()) {
            $username = input("username", '');
            $password = input("password", '');
            $user_model = new UserModel();
            if ($config[ "shop_login" ] == 1) {
                $captcha_result = $this->checkCaptcha();
                //验证码
                if ($captcha_result[ "code" ] != 0) {
                    return $captcha_result;
                }
            }
            $result = $user_model->login($username, $password, $this->app_module, $site_id);
            return $result;
        } else {
            $this->assign("menu_info", [ 'title' => "登录" ]);
            //平台配置信息
            $site_model = new Site();
            $shop_info = $site_model->getSiteInfo([ [ 'site_id', '=', $site_id ] ], 'site_name,logo,seo_keywords,seo_description, create_time');

            $this->assign("shop_info", $shop_info[ 'data' ]);
            $this->assign('domain', $_SERVER[ 'SERVER_NAME' ]);

            //加载版权信息
            $copyright = $config_model->getCopyright();
            $this->assign('copyright', $copyright[ 'data' ][ 'value' ]);

            // 验证码
            $captcha = $this->captcha();
            $captcha = $captcha[ 'data' ];
            $this->assign('site_id', $site_id);
            $this->assign("captcha", $captcha);
            return $this->fetch("login/login");
        }
    }

    /**
     * 退出操作
     */
    public function logout()
    {
        $site_id = request()->siteid();
        $user_model = new UserModel();
        $user_model->clearLogin($this->app_module, $site_id);
        $this->redirect(url("shop/login/login"));
    }

    /**
     * 验证码
     */
    public function captcha()
    {
        $captcha_data = ThinkCaptcha::create(null, true);
        $captcha_id = md5(uniqid(null, true));
        // 验证码10分钟有效
        Cache::set($captcha_id, $captcha_data[ 'code' ], 600);
        return success(0, '', [ 'id' => $captcha_id, 'img' => $captcha_data[ 'img' ] ]);
    }

    /**
     * 验证码验证
     */
    public function checkCaptcha()
    {
        $captcha = input('captcha', '');
        $captcha_id = input('captcha_id', '');

        if (empty($captcha)) return error(-1, '请输入验证码');

        $captcha_data = Cache::pull($captcha_id);
        if (empty($captcha_data)) return error('', '验证码已失效');

        if ($captcha != $captcha_data) return error(-1, '验证码错误');

        return success();
    }

    /**
     * 清理缓存
     */
    public function clearCache()
    {
        Cache::clear();
        return success('', '缓存更新成功', '');
    }

    /**
     * 修改密码
     * */
    public function modifyPassword()
    {
        if (request()->isAjax()) {
            $site_id = request()->siteid();
            $user_model = new UserModel();
            $uid = $user_model->uid($this->app_module, $site_id);

            $old_pass = input('old_pass', '');
            $new_pass = input('new_pass', '123456');

            $condition = [
                [ 'uid', '=', $uid ],
                [ 'password', '=', data_md5($old_pass) ],
                [ 'site_id', '=', $site_id ]
            ];

            $res = $user_model->modifyAdminUserPassword($condition, $new_pass);

            return $res;
        }
    }

}