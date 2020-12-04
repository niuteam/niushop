<?php

namespace app\component\controller;

/**
 * 辅助线·组件
 *
 */
class HorzLine extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("horz_line/design.html");
    }
}