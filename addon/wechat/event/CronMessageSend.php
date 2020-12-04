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

use addon\system\Wechat\common\model\WechatMessage;

class CronMessageSend
{
    /**
     * 邮箱消息延时发送
     * @param array $param
     */
    public function handle($param = [])
    {
        $wechat_message = new WechatMessage();
        $res            = $wechat_message->cronMessageSend($param);
        return $res;
    }
}