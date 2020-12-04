<?php

namespace app\component\controller;

/**
 * 店铺搜索·组件
 */
class TopCategory extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
		return $this->fetch("top_category/design.html");
    }
}