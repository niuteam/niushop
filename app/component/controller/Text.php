<?php

namespace app\component\controller;

/**
 * 文本·组件
 */
class Text extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("text/design.html");
    }
}