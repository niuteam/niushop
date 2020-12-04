<?php

namespace addon\coupon\component\controller;

use app\component\controller\BaseDiyView;

/**
 * 优惠券·组件
 */
class Coupon extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("coupon/design.html");
    }
}
