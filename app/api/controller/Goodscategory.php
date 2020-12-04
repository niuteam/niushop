<?php

namespace app\api\controller;

use app\model\goods\GoodsCategory as GoodsCategoryModel;

/**
 * 商品分类
 * Class Goodscategory
 * @package app\api\controller
 */
class Goodscategory extends BaseApi
{

    /**
     * 树状结构信息
     */
    public function tree()
    {
        $level = isset($this->params[ 'level' ]) ? $this->params[ 'level' ] : 3;// 分类等级 1 2 3
        $template = isset($this->params[ 'template' ]) ? $this->params[ 'template' ] : 2;// 模板 1：无图，2：有图，3：有商品
        $goods_category_model = new GoodsCategoryModel();
        $condition = [
            [ 'is_show', '=', 0 ],
            [ 'level', '<=', $level ],
            [ 'site_id', '=', $this->site_id ]
        ];

        $field = "category_id,category_name,short_name,pid,level,image,category_id_1,category_id_2,category_id_3,image_adv";
        $order = "sort asc,category_id desc";
        $list = $goods_category_model->getCategoryTree($condition, $field, $order);

        return $this->response($list);
    }

}