<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\bundling\event;

use addon\bundling\model\Bundling;
/**
 * 删除商品
 */
class DeleteGoods
{
    /**
     *  删除商品（需判断套餐是否存在该商品，存在活动关闭）
     */
    public function handle($param)
    {
        $model = new Bundling();
        $res = $model->cronDeleteGoods($param);
        return $res;
    }
}