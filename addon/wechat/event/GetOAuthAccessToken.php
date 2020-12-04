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

class GetOAuthAccessToken
{
    /**
     * 获取watch的AccessToken(包含openid)
     * @param array $param
     */
    public function getOAuthAccessToken($param = [])
    {
        $weatch_model = new Wechat();
        $res          = $weatch_model->getOAuthAccessToken(["site_id" => $param["site_id"]]);
        return $res;
    }
}