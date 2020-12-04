<?php

namespace app\component\controller;

/**
 * 公告·组件
 */
class Notice extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("notice/design.html");
    }
}