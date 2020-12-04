<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\memberprice\shop\controller;

use addon\memberprice\model\MemberPrice;
use app\model\goods\Goods as GoodsModel;
use app\model\member\MemberLevel;
use app\shop\controller\BaseShop;

/**
 * 会员价控制器
 */
class Goods extends BaseShop
{

    /**
     * 设置会员价
     */
    public function config()
    {
        $goods_id = input('goods_id');
        //商品信息
        $goods_model = new GoodsModel();
        $goods_info  = $goods_model->getGoodsDetail($goods_id);
        $this->assign('goods_info', $goods_info['data']);

        //会员等级
        $member_level_model = new MemberLevel();
        $condition          = [['site_id', '=', $this->site_id]];
        $order              = 'growth asc';
        $field              = '*';
        $level_list         = $member_level_model->getMemberLevelList($condition, $field, $order);
        $this->assign('level_list', $level_list['data']);

        if (request()->isAjax()) {

            $goods_sku_model = new MemberPrice();
            $data            = [
                'is_consume_discount' => input('is_consume_discount', 0),
                'discount_config'     => input('discount_config', 0),
                'discount_method'     => input('discount_method', ''),
            ];
            $member_price    = input('member_price', '');
            $goods_id        = input('goods_id');
            $condition[]     = ['goods_id', '=', $goods_id];
            $condition[]     = ['site_id', '=', $this->site_id];

            return $goods_sku_model->editGoodsMemberPrice($condition, $data, $member_price);
        }

        return $this->fetch("goods/config");
    }

}