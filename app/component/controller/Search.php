<?php

namespace app\component\controller;

/**
 * 商品搜索·组件
 */
class Search extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("search/design.html");
    }
}