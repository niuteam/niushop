<?php

namespace app\component\controller;

/**
 * 顶部标题·组件
 */
class Title extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("title/design.html");
    }
}