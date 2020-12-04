<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\coupon\event;

use addon\coupon\model\CouponType;

/**
 * 优惠券定时结束
 */
class CronCouponTypeEnd
{

    public function handle($params = [])
    {
        $coupon = new CouponType();
        $res    = $coupon->couponCronEnd($params['relate_id']);
        return $res;
    }
}