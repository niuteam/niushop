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
namespace addon\wechat\shop\controller;

/**
 * 微信菜单控制器
 */
class Share extends BaseWechat
{
    /**
     * 微信自定义菜单配置
     */
    public function share()
    {
        if (request()->isAjax()) {

            return success();
        } else {

            return $this->fetch('share/share', [], $this->replace);
        }
    }

}