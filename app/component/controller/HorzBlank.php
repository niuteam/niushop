<?php

namespace app\component\controller;

/**
 * 辅助空白·组件
 */
class HorzBlank extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("horz_blank/design.html");
    }
}