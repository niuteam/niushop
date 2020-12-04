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

use liliuwei\think\Jump;
use addon\system\Wechat\common\model\WechatMessage as WechatMessageModel;

class WechatMessage
{
    use Jump;

    /**
     * 微信模板消息
     * @param array $param
     */
    public function handle($param = [])
    {
        $wechat_message = new WechatMessageModel();
        $res            = $wechat_message->sendMessage($param);
        return $res;
    }

}