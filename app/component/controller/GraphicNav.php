<?php

namespace app\component\controller;

/**
 * 图文导航·组件
 */
class GraphicNav extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("graphic_nav/design.html");
    }
}