<?php

namespace app\component\controller;

/**
 * 富文本·组件
 *
 */
class RichText extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        $this->assign("unique_random", unique_random());
        return $this->fetch("rich_text/design.html");
    }
}