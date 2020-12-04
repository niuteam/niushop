<?php

namespace app\component\controller;

/**
 * 商品分类·组件
 */
class FloatBtn extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("float_btn/design.html");
    }
}