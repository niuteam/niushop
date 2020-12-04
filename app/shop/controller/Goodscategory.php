<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\model\goods\GoodsAttribute as GoodsAttributeModel;
use app\model\goods\GoodsCategory as GoodsCategoryModel;

/**
 * 商品分类管理 控制器
 */
class Goodscategory extends BaseShop
{
    /**
     * 商品分类列表
     */
    public function lists()
    {
        $goods_category_model = new GoodsCategoryModel();
        $condition[] = [ 'site_id', '=', $this->site_id ];
        $list = $goods_category_model->getCategoryTree($condition);
        $list = $list[ 'data' ];
        $this->assign("list", $list);
        return $this->fetch('goodscategory/lists');
    }

    /**
     * 商品分类添加
     */
    public function addCategory()
    {
        $goods_category_model = new GoodsCategoryModel();
        if (request()->isAjax()) {

            $category_name = input('category_name', '');// 分类名称
            $short_name = input('short_name', '');// 简称
            $pid = input('pid', 0);//默认添加的商品分类为顶级
            $level = input('level', 1);// 层级
            $is_show = input('is_show', 0);// 是否显示
//            $sort = input('sort', 0);// 排序
            $image = input('image', '');// 分类图片
            $image_adv = input('image_adv', '');// 分类广告图片
            $keywords = input('keywords', '');// 分类页面关键字
            $description = input('description', '');// 分类介绍
            $attr_class_id = input('attr_class_id', '');// 关联商品类型id
            $attr_class_name = input('attr_class_name', '');// 关联商品类型名称
            $commission_rate = input('commission_rate', '');// 佣金比率%
            $category_id_1 = input('category_id_1', 0);// 一级分类id
            $category_id_2 = input('category_id_2', 0);// 二级分类id
            $category_full_name = input('category_full_name', '');;// 组装名称

            $data = [
                'site_id' => $this->site_id,
                'category_name' => $category_name,
                'short_name' => $short_name,
                'pid' => $pid,
                'level' => $level,
                'is_show' => $is_show,
//                'sort' => $sort,
                'image' => $image,
                'image_adv' => $image_adv,
                'keywords' => $keywords,
                'description' => $description,
                'attr_class_id' => $attr_class_id,
                'attr_class_name' => $attr_class_name,
                'commission_rate' => $commission_rate,
                'category_id_1' => $category_id_1,
                'category_id_2' => $category_id_2,
                'category_full_name' => $category_full_name
            ];
            $res = $goods_category_model->addCategory($data);
            if (!empty($res[ 'data' ])) {

                //修改category_id_
                $update_data = [
                    'category_id' => $res[ 'data' ],
                    'category_id_' . $level => $res[ 'data' ],
                    'site_id' => $this->site_id
                ];
                $goods_category_model->editCategory($update_data);

            }
            return $res;
        } else {

            $goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([ [ 'site_id', '=', $this->site_id ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            return $this->fetch('goodscategory/add_category');
        }
    }

    /**
     * 商品分类编辑
     */
    public function editCategory()
    {
        $goods_category_model = new GoodsCategoryModel();
        if (request()->isAjax()) {
            $category_id = input('category_id', '');// 分类id
            $category_name = input('category_name', '');// 分类名称
            $short_name = input('short_name', '');// 简称
            $pid = input('pid', 0);//默认添加的商品分类为顶级
            $level = input('level', 1);// 层级
            $is_show = input('is_show', 0);// 是否显示
//            $sort = input('sort', 0);// 排序
            $image = input('image', '');// 分类图片
            $image_adv = input('image_adv', '');// 分类广告图片
            $keywords = input('keywords', '');// 分类页面关键字
            $description = input('description', '');// 分类介绍
            $attr_class_id = input('attr_class_id', '');// 关联商品类型id
            $attr_class_name = input('attr_class_name', '');// 关联商品类型名称
            $commission_rate = input('commission_rate', '');// 佣金比率%
            $category_id_1 = input('category_id_1', 0);// 一级分类id
            $category_id_2 = input('category_id_2', 0);// 二级分类id
            $category_id_3 = input('category_id_3', 0);// 三级分类id
            $category_full_name = input('category_full_name', '');;// 组装名称

            $data = [
                'site_id' => $this->site_id,
                'category_id' => $category_id,
                'category_name' => $category_name,
                'short_name' => $short_name,
                'pid' => $pid,
                'level' => $level,
                'is_show' => $is_show,
//                'sort' => $sort,
                'image' => $image,
                'image_adv' => $image_adv,
                'keywords' => $keywords,
                'description' => $description,
                'attr_class_id' => $attr_class_id,
                'attr_class_name' => $attr_class_name,
                'commission_rate' => $commission_rate,
                'category_id_1' => $category_id_1,
                'category_id_2' => $category_id_2,
                'category_id_3' => $category_id_3,
                'category_full_name' => $category_full_name
            ];
            $this->addLog("编辑商品分类:" . $category_name);
            $res = $goods_category_model->editCategory($data);

            return $res;

        } else {

            $category_id = input('category_id', '');// 分类id

            if (empty($category_id)) {
                $this->error("缺少参数category_id");
            }

            $goods_category_info = $goods_category_model->getCategoryInfo([ [ 'category_id', '=', $category_id ], [ 'site_id', '=', $this->site_id ] ]);
            $goods_category_info = $goods_category_info[ 'data' ];
            $this->assign("goods_category_info", $goods_category_info);

            //父级
            $goods_category_parent_info = $goods_category_model->getCategoryInfo([ [ 'category_id', '=', $goods_category_info[ 'pid' ] ], [ 'site_id', '=', $this->site_id ] ], 'category_name');
            $this->assign("goods_category_parent_info", $goods_category_parent_info[ 'data' ]);
            $goods_attribute_model = new GoodsAttributeModel();

            // 商品类型列表
            $attr_class_list = $goods_attribute_model->getAttrClassList([ [ 'site_id', '=', $this->site_id ] ], 'class_id,class_name');
            $this->assign("attr_class_list", $attr_class_list[ 'data' ]);

            return $this->fetch('goodscategory/edit_category');
        }
    }

    /**
     * 商品分类删除
     */
    public function deleteCategory()
    {
        if (request()->isAjax()) {
            $category_id = input('category_id', '');// 分类id
            $goods_category_model = new GoodsCategoryModel();
            $res = $goods_category_model->deleteCategory($category_id, $this->site_id);
            $this->addLog("删除商品分类id:" . $category_id);
            return $res;
        }
    }

    /**
     * 获取商品分类列表
     * @return \multitype
     */
    public function getCategoryList()
    {
        $pid = input('pid', 0);// 上级id
        $level = input('level', 0);// 层级
        $goods_category_model = new GoodsCategoryModel();
        if (!empty($level)) {
            $condition = [
                [ 'level', '=', $level ]
            ];
        } else {
            $condition = [
                [ 'pid', '=', $pid ]
            ];
        }
        $condition[] = [ 'site_id', '=', $this->site_id ];
        $list = $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,pid,level,category_id_1,category_id_2,category_id_3', 'sort asc,category_id desc');
        return $list;
    }

    /**
     * 获取商品分类信息
     * @return \multitype
     */
    public function getCategoryInfo()
    {
        $category_id = input('category_id', '');// 分类id
        $goods_category_model = new GoodsCategoryModel();
        $condition = [
            [ 'category_id', '=', $category_id ]
        ];
        $res = $goods_category_model->getCategoryInfo($condition, 'category_name');
        return $res;
    }


    /**
     * 获取商品分类
     * @return \multitype
     */
    public function getCategoryByParent()
    {
        $pid = input('pid', 0);// 上级id
        $level = input('level', 0);// 层级
        $goods_category_model = new GoodsCategoryModel();
        if (!empty($level)) {
            $condition[] = [ 'level', '=', $level ];
        }
        if (!empty($pid)) {
            $condition[] = [ 'pid', '=', $pid ];
        }
        $condition[] = [ 'site_id', '=', $this->site_id ];
        $list = $goods_category_list = $goods_category_model->getCategoryByParent($condition, 'category_id,category_name,pid,level,category_id_1,category_id_2,category_id_3');
        return $list;
    }

    /**
     * 修改商品分类排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $sort = input('sort', 0);
            $category_id = input('category_id', 0);
            $category_sort_array = input('category_sort_array', '');
            $goods_category_model = new GoodsCategoryModel();
            if (!empty($category_sort_array)) {
                $category_sort_array = json_decode($category_sort_array, true);
                foreach ($category_sort_array as $k => $v) {
                    $res = $goods_category_model->modifyGoodsCategorySort($v[ 'sort' ], $v[ 'category_id' ], $this->site_id);
                }
            } else {
                $res = $goods_category_model->modifyGoodsCategorySort($sort, $category_id, $this->site_id);
            }
            return $res;
        }
    }

    /**
     * 获取商品分类（tree结构）
     */
    public function getCategoryTree()
    {
        $goods_category_model = new GoodsCategoryModel();

        $field = 'category_id,category_name as title';
        $condition = [
            [ 'pid', '=', 0 ],
            [ 'level', '=', 1 ],
            [ 'site_id', '=', $this->site_id ]
        ];
        $list = $goods_category_list = $goods_category_model->getCategoryByParent($condition, $field);
        $list = $list[ 'data' ];
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $two_list = $goods_category_list = $goods_category_model->getCategoryByParent(
                    [
                        [ 'pid', '=', $v[ 'category_id' ] ],
                        [ 'level', '=', 2 ],
                        [ 'site_id', '=', $this->site_id ]
                    ],
                    $field
                );

                if (!empty($two_list[ 'data' ])) {
                    $two_list = $two_list[ 'data' ];
                    foreach ($two_list as $two_k => $two_v) {
                        $three_list = $goods_category_list = $goods_category_model->getCategoryByParent(
                            [
                                [ 'pid', '=', $two_v[ 'category_id' ] ],
                                [ 'level', '=', 3 ],
                                [ 'site_id', '=', $this->site_id ]
                            ],
                            $field
                        );
                        $two_list[ $two_k ][ 'children' ] = $three_list[ 'data' ];
                    }
                }

                $list[ $k ][ 'children' ] = $two_list;
            }

            return success(0, 'success', $list);
        } else {
            return success(0, 'success', $list);
        }
    }
}