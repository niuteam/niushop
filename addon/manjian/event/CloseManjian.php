<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\manjian\event;

use addon\manjian\model\Manjian;

/**
 * 关闭活动
 */
class CloseManjian
{

    public function handle($params)
    {
        $manjian = new Manjian();
        $res     = $manjian->cronCloseManjian($params['relate_id']);
        return $res;
    }
}