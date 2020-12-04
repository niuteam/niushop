<?php

namespace addon\discount\component\controller;

use app\component\controller\BaseDiyView;

/**
 * 限时折扣·组件
 *
 */
class Discount extends BaseDiyView
{

    /**
     * 设计界面
     */
    public function design()
    {
        return $this->fetch("discount/design.html");
    }
}