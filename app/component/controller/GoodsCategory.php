<?php

namespace app\component\controller;

/**
 * 商品分类·组件
 */
class GoodsCategory extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("goods_category/design.html");
    }
}