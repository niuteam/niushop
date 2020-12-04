<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\system\Wechat\event;

use addon\system\Wechat\common\model\Wechat;
use liliuwei\think\Jump;

/**
 * 应用安装
 */
class OAuthLogin
{
    use Jump;

    /**
     * 授权登录
     * @param array $params
     */
    public function handle($params = [])
    {
        if ($params['name'] == 'Wechat') {
            $wechat_model  = new Wechat();
            $wechat_config = $wechat_model->getWechatConfigInfo($params['site_id']);

            if (empty($wechat_config['data']['value'])) {
                $this->error('站点未配置微信公众号');
            } else {
                $value = $wechat_config['data']['value'];
                if (empty($value['appid']) || empty($value['appsecret'])) {
                    $this->error('请配置您公众号的AppID和AppSecret');
                } else {
                    $redirect_url         = addon_url('Wechat://common/login/callback', ['site_id' => $params['site_id']]);
                    $get_request_code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $value['appid'] . '&redirect_uri=' . $redirect_url . '&response_type=code&scope=snsapi_userinfo&state=niucloud#wechat_redirect';
                    $this->redirect($get_request_code_url);
                }
            }
        }
    }
}