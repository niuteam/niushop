<?php

namespace app\component\controller;

use app\model\goods\GoodsCategory;

/**
 * 商品列表·组件
 */
class GoodsList extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        $site_id = request()->siteid();
        $goods_category_model = new GoodsCategory();
        $condition = [
            ['pid', '=', 0],
            ['site_id', '=', $site_id]
        ];

        $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name    ');
        $goods_category_list = $goods_category_list['data'];
        $this->assign("goods_category_list", $goods_category_list);

        return $this->fetch("goods_list/design.html");
    }
}