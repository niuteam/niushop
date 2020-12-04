<?php

namespace app\component\controller;

/**
 * 文本导航·组件
 */
class TextNav extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("text_nav/design.html");
    }
}