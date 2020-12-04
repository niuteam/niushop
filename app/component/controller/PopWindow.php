<?php

namespace app\component\controller;

/**
 * 弹窗广告·组件
 */
class PopWindow extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("pop_window/design.html");
    }
}