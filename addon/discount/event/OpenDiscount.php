<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\discount\event;

use addon\discount\model\Discount;

/**
 * 启动活动
 */
class OpenDiscount
{

    public function handle($params)
    {
        $discount = new Discount();
        $res      = $discount->cronOpenDiscount($params['relate_id']);
        return $res;
    }
}