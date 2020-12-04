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

class WechatMsg
{
    public function handle($param = [])
    {
        $wechat_config = new Wechat();
        $res           = $wechat_config->sendTemplateMsg(request()->siteid(), $param);
        return $res;
    }
}