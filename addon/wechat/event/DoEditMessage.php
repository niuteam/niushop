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

class DoEditMessage
{
    use Jump;

    /**
     * 编辑消息模板
     * @param array $param
     */
    public function handle($param = [])
    {
        if ($param["name"] == "Wechat") {
            $this->redirect(addon_url('Wechat://sitehome/message/edit', ['keyword' => $param['keyword']]));
        }
    }
}