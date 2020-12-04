<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\goods\VirtualGoods;

/**
 * 虚拟商品核销
 */
class VirtualGoodsVerify
{

    public function handle($data)
    {
        if ($data['verify_type'] == 'virtualgoods') {
            $virtual_goods_model = new VirtualGoods();
            $res                 = $virtual_goods_model->verify($data["verify_code"]);
            return $res;
        }
        return '';
    }

}