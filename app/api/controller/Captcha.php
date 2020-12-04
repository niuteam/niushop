<?php

namespace app\api\controller;

use think\captcha\facade\Captcha as ThinkCaptcha;
use think\facade\Cache;

class Captcha extends BaseApi
{
    /**
     * 验证码
     */
    public function captcha()
    {
        if (isset($this->params['captcha_id']) && !empty($this->params['captcha_id'])) {
            Cache::delete($this->params['captcha_id']);
        }

        $captcha_data = ThinkCaptcha::create(null, true);
        $captcha_id   = md5(uniqid(null, true));
        // 验证码10分钟有效
        Cache::set($captcha_id, $captcha_data['code'], 600);
        return $this->response($this->success(['id' => $captcha_id, 'img' => $captcha_data['img']]));
    }

    /**
     * 检测验证码
     * @param boolean $snapchat 阅后即焚
     */
    public function checkCaptcha($snapchat = true): array
    {
        if (!isset($this->params['captcha_id']) || empty($this->params['captcha_id'])) {
            return $this->error('', 'REQUEST_CAPTCHA_ID');
        }

        if (!isset($this->params['captcha_code']) || empty($this->params['captcha_code'])) {
            return $this->error('', 'REQUEST_CAPTCHA_CODE');
        }

        if ($snapchat) $captcha_data = Cache::pull($this->params['captcha_id']);
        else $captcha_data = Cache::get($this->params['captcha_id']);
        if (empty($captcha_data)) return $this->error('', 'CAPTCHA_FAILURE');

        if ($this->params['captcha_code'] != $captcha_data) return $this->error('', 'CAPTCHA_ERROR');

        return $this->success();
    }
    
}