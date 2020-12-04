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

use app\model\express\ExpressTemplate as ExpressTemplateModel;
use app\model\goods\Goods as GoodsModel;
use app\model\goods\GoodsAttribute as GoodsAttributeModel;
use app\model\goods\GoodsBrowse;
use app\model\goods\GoodsCategory as GoodsCategoryModel;
use app\model\goods\GoodsCollect;
use app\model\goods\GoodsEvaluate as GoodsEvaluateModel;
use app\model\goods\GoodsLabel as GoodsLabelModel;
use app\model\goods\GoodsService as GoodsServiceModel;
use app\model\web\Config as ConfigModel;

/**
 * 实物商品
 * Class Goods
 * @package app\shop\controller
 */
class Goods extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 商品列表
     * @return mixed
     */
    public function lists()
    {
        $goods_model = new GoodsModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', "");
            $goods_state = input('goods_state', "");
            $start_sale = input('start_sale', 0);
            $end_sale = input('end_sale', 0);
            $start_price = input('start_price', 0);
            $end_price = input('end_price', 0);
            $goods_class = input('goods_class', "");
            $label_id = input('label_id', "");
            $order = input('order', 'sort');
            $sort = input('sort', 'asc');

            if ($order == 'sort') {
                $order_by = $order . ' ' . $sort . ',create_time desc';
            } else {
                $order_by = $order . ' ' . $sort;
            }
            $promotion_type = input('promotion_type', "");

            $condition = [ [ 'is_delete', '=', 0 ], [ 'site_id', '=', $this->site_id ] ];

            if (!empty($search_text)) {
                $condition[] = [ 'goods_name', 'like', '%' . $search_text . '%' ];
            }
            $category_id = input('category_id', "");
            if (!empty($category_id)) {
                $condition[] = [ 'category_id', 'like', '%,' . $category_id . ',%' ];
            }

            if ($goods_class !== "") {
                $condition[] = [ 'goods_class', '=', $goods_class ];
            }

            if (!empty($label_id)) {
                $condition[] = [ 'label_id', '=', $label_id ];
            }

            if (!empty($promotion_type)) {
                $condition[] = [ 'promotion_addon', 'like', "%{$promotion_type}%" ];
            }

            // 上架状态
            if ($goods_state !== '') {
                $condition[] = [ 'goods_state', '=', $goods_state ];
            }
            if (!empty($start_sale)) $condition[] = [ 'sale_num', '>=', $start_sale ];
            if (!empty($end_sale)) $condition[] = [ 'sale_num', '<=', $end_sale ];
            if (!empty($start_price)) $condition[] = [ 'price', '>=', $start_price ];
            if (!empty($end_price)) $condition[] = [ 'price', '<=', $end_price ];

            $res = $goods_model->getGoodsPageList($condition, $page_index, $page_size, $order_by);
            $goods_promotion_type = event('GoodsPromotionType');
            if (!empty($res[ 'data' ][ 'list' ])) {
                foreach ($res[ 'data' ][ 'list' ] as $k => $v) {
                    if (!empty($v[ 'promotion_addon' ])) {
                        $v[ 'promotion_addon' ] = json_decode($v[ 'promotion_addon' ], true);
                        foreach ($v[ 'promotion_addon' ] as $ck => $cv) {
                            foreach ($goods_promotion_type as $gk => $gv) {
                                if ($gv[ 'type' ] == $ck) {
                                    $res[ 'data' ][ 'list' ][ $k ][ 'promotion_addon_list' ][] = $gv;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            return $res;
        } else {

            //获取一级商品分类
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', 0 ],
                [ 'site_id', '=', $this->site_id ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_category_list = $goods_category_list[ 'data' ];
            $this->assign("goods_category_list", $goods_category_list);

            // 商品分组
            $goods_label_model = new GoodsLabelModel();
            $label_list = $goods_label_model->getLabelList([ [ 'site_id', '=', $this->site_id ] ], 'id,label_name', 'create_time desc');
            $label_list = $label_list[ 'data' ];
            $this->assign("label_list", $label_list);

            // 商品服务
            $goods_service_model = new GoodsServiceModel();
            $service_list = $goods_service_model->getServiceList([ [ 'site_id', '=', $this->site_id ] ], 'id,service_name');
            $service_list = $service_list[ 'data' ];
            $this->assign("service_list", $service_list);

            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];
            $this->assign("express_template_list", $express_template_list);

            //判断会员价插件
            $memberprice_is_exit = addon_is_exit('memberprice', $this->site_id);
            $this->assign('memberprice_is_exit', $memberprice_is_exit);
            // 营销活动
            $goods_promotion_type = event('GoodsPromotionType');
            $this->assign('promotion_type', $goods_promotion_type);
            return $this->fetch("goods/lists");
        }
    }

    /**
     * 修改商品排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $goods_model = new GoodsModel();
            $goods_id = input('goods_id', 0);
            $sort = input('sort', 0);
            return $goods_model->modifyGoodsSort($sort, $goods_id, $this->site_id);
        }
    }

    /**
     * 添加商品
     * @return mixed
     */
    public function addGoods()
    {
        if (request()->isAjax()) {
            $category_id = input("category_id", 0);// 分类id
            $category_json = json_encode($category_id);//分类字符串
            $category_id = ',' . implode(',', $category_id) . ',';

            $data = [
                'goods_name' => input("goods_name", ""),// 商品名称,
                'goods_attr_class' => input("goods_attr_class", ""),// 商品类型id,
                'goods_attr_name' => input("goods_attr_name", ""),// 商品类型名称,
                'site_id' => $this->site_id,
                'category_id' => $category_id,
                'category_json' => $category_json,
                'goods_image' => input("goods_image", ""),// 商品主图路径
                'goods_content' => input("goods_content", ""),// 商品详情
                'goods_state' => input("goods_state", ""),// 商品状态（1.正常0下架）
                'price' => input("price", 0),// 商品价格（取第一个sku）
                'market_price' => input("market_price", 0),// 市场价格（取第一个sku）
                'cost_price' => input("cost_price", 0),// 成本价（取第一个sku）
                'sku_no' => input("sku_no", ""),// 商品sku编码
                'weight' => input("weight", ""),// 重量
                'volume' => input("volume", ""),// 体积
                'goods_stock' => input("goods_stock", 0),// 商品库存（总和）
                'goods_stock_alarm' => input("goods_stock_alarm", 0),// 库存预警
                'is_free_shipping' => input("is_free_shipping", 1),// 是否免邮
                'shipping_template' => input("shipping_template", 0),// 指定运费模板
                'goods_spec_format' => input("goods_spec_format", ""),// 商品规格格式
                'goods_attr_format' => input("goods_attr_format", ""),// 商品属性格式
                'introduction' => input("introduction", ""),// 促销语
                'keywords' => input("keywords", ""),// 关键词
                'unit' => input("unit", ""),// 单位
                'sort' => input("sort", 0),// 排序,
                'video_url' => input("video_url", ""),// 视频
                'goods_sku_data' => input("goods_sku_data", ""),// SKU商品数据
                'goods_service_ids' => input("goods_service_ids", ''),// 商品服务id集合
                'label_id' => input("label_id", ''),// 商品分组id
                'virtual_sale' => input("virtual_sale", 0),// 虚拟销量
                'max_buy' => input("max_buy", 0),// 限购
                'min_buy' => input("min_buy", 0),// 起售
                'recommend_way' => input('recommend_way', 0), // 推荐方式，1：新品，2：精品，3；推荐
                'timer_on' => strtotime(input('timer_on', 0)),//定时上架
                'timer_off' => strtotime(input('timer_off', 0)),//定时下架
            ];

            $goods_model = new GoodsModel();
            $res = $goods_model->addGoods($data);
            return $res;
        } else {

            //获取一级商品分类
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', 0 ],
                [ 'site_id', '=', $this->site_id ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_category_list = $goods_category_list[ 'data' ];
            $this->assign("goods_category_list", $goods_category_list);

            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];
            $this->assign("express_template_list", $express_template_list);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', '=', $this->site_id ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            // 商品服务
            $goods_service_model = new GoodsServiceModel();
            $service_list = $goods_service_model->getServiceList([ [ 'site_id', '=', $this->site_id ] ], 'id,service_name');
            $service_list = $service_list[ 'data' ];
            $this->assign("service_list", $service_list);

            // 商品分组
            $goods_label_model = new GoodsLabelModel();
            $label_list = $goods_label_model->getLabelList([ [ 'site_id', '=', $this->site_id ] ], 'id,label_name', 'create_time desc');
            $label_list = $label_list[ 'data' ];
            $this->assign("label_list", $label_list);

            return $this->fetch("goods/add_goods");
        }
    }

    /**
     * 编辑商品
     * @return mixed
     */
    public function editGoods()
    {
        $goods_model = new GoodsModel();
        if (request()->isAjax()) {

            $category_id = input("category_id", 0);// 分类id
            $category_json = json_encode($category_id);//分类字符串
            $category_id = ',' . implode(',', $category_id) . ',';

            $data = [
                'goods_id' => input("goods_id", 0),// 商品id
                'goods_name' => input("goods_name", ""),// 商品名称,
                'goods_attr_class' => input("goods_attr_class", ""),// 商品类型id,
                'goods_attr_name' => input("goods_attr_name", ""),// 商品类型名称,
                'site_id' => $this->site_id,
                'category_id' => $category_id,
                'category_json' => $category_json,
                'goods_image' => input("goods_image", ""),// 商品主图路径
                'goods_content' => input("goods_content", ""),// 商品详情
                'goods_state' => input("goods_state", ""),// 商品状态（1.正常0下架）
                'price' => input("price", 0),// 商品价格（取第一个sku）
                'market_price' => input("market_price", 0),// 市场价格（取第一个sku）
                'cost_price' => input("cost_price", 0),// 成本价（取第一个sku）
                'sku_no' => input("sku_no", ""),// 商品sku编码
                'weight' => input("weight", ""),// 重量
                'volume' => input("volume", ""),// 体积
                'goods_stock' => input("goods_stock", 0),// 商品库存（总和）
                'goods_stock_alarm' => input("goods_stock_alarm", 0),// 库存预警
                'is_free_shipping' => input("is_free_shipping", 1),// 是否免邮
                'shipping_template' => input("shipping_template", 0),// 指定运费模板
                'goods_spec_format' => input("goods_spec_format", ""),// 商品规格格式
                'goods_attr_format' => input("goods_attr_format", ""),// 商品属性格式
                'introduction' => input("introduction", ""),// 促销语
                'keywords' => input("keywords", ""),// 关键词
                'unit' => input("unit", ""),// 单位
                'sort' => input("sort", 0),// 排序,
                'video_url' => input("video_url", ""),// 视频
                'goods_sku_data' => input("goods_sku_data", ""),// SKU商品数据
                'goods_service_ids' => input("goods_service_ids", ''),// 商品服务id集合
                'label_id' => input("label_id", ''),// 商品分组id
                'virtual_sale' => input("virtual_sale", 0),// 虚拟销量
                'max_buy' => input("max_buy", 0),// 限购
                'min_buy' => input("min_buy", 0),// 起售
                'recommend_way' => input('recommend_way', 0), // 推荐方式，1：新品，2：精品，3；推荐
                'timer_on' => strtotime(input('timer_on', 0)),//定时上架
                'timer_off' => strtotime(input('timer_off', 0)),//定时下架
                'spec_type_status' => input('spec_type_status', 0),
            ];

            $res = $goods_model->editGoods($data);
            return $res;
        } else {

            $goods_id = input("goods_id", 0);
            $goods_info = $goods_model->editGetGoodsInfo([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ]);
            $goods_info = $goods_info[ 'data' ];

            $goods_sku_list = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], "sku_id,sku_name,sku_no,sku_spec_format,price,market_price,cost_price,stock,weight,volume,sku_image,sku_images,goods_spec_format,spec_name,stock_alarm,is_default", '');
            $goods_sku_list = $goods_sku_list[ 'data' ];
            $goods_info[ 'sku_list' ] = $goods_sku_list;
            $this->assign("goods_info", $goods_info);

            //获取一级商品分类
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', 0 ],
                [ 'site_id', '=', $this->site_id ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            $goods_category_list = $goods_category_list[ 'data' ];
            $this->assign("goods_category_list", $goods_category_list);

            //获取运费模板
            $express_template_model = new ExpressTemplateModel();
            $express_template_list = $express_template_model->getExpressTemplateList([ [ 'site_id', "=", $this->site_id ] ], 'template_id,template_name', 'is_default desc');
            $express_template_list = $express_template_list[ 'data' ];
            $this->assign("express_template_list", $express_template_list);

            //获取商品类型
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_list = $goods_attr_model->getAttrClassList([ [ 'site_id', '=', $this->site_id ] ], 'class_id,class_name');
            $attr_class_list = $attr_class_list[ 'data' ];
            $this->assign("attr_class_list", $attr_class_list);

            // 商品服务
            $goods_service_model = new GoodsServiceModel();
            $service_list = $goods_service_model->getServiceList([ [ 'site_id', '=', $this->site_id ] ], 'id,service_name');
            $service_list = $service_list[ 'data' ];
            $this->assign("service_list", $service_list);

            // 商品分组
            $goods_label_model = new GoodsLabelModel();
            $label_list = $goods_label_model->getLabelList([ [ 'site_id', '=', $this->site_id ] ], 'id,label_name', 'create_time desc');
            $label_list = $label_list[ 'data' ];
            $this->assign("label_list", $label_list);

            return $this->fetch("goods/edit_goods");
        }
    }

    /**
     * 删除商品
     */
    public function deleteGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyIsDelete($goods_ids, 1, $this->site_id);
            return $res;
        }

    }

    /**
     * 商品回收站
     */
    public function recycle()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_keys = input('search_keys', "");
            $condition = [ [ 'is_delete', '=', 1 ], [ 'site_id', "=", $this->site_id ] ];
            if (!empty($search_keys)) {
                $condition[] = [ 'goods_name', 'like', '%' . $search_keys . '%' ];
            }
            $goods_model = new GoodsModel();
            $res = $goods_model->getGoodsPageList($condition, $page_index, $page_size);
            return $res;
        } else {
            return $this->fetch("goods/recycle");
        }
    }

    /**
     * 商品回收站商品删除
     */
    public function deleteRecycleGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->deleteRecycleGoods($goods_ids, $this->site_id);
            return $res;
        }
    }

    /**
     * 商品回收站商品恢复
     */
    public function recoveryRecycle()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyIsDelete($goods_ids, 0, $this->site_id);
            return $res;
        }

    }

    /**
     * 商品下架
     */
    public function offGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_state = input("goods_state", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyGoodsState($goods_ids, $goods_state, $this->site_id);
            return $res;
        }

    }

    /**
     * 商品上架
     */
    public function onGoods()
    {
        if (request()->isAjax()) {
            $goods_ids = input("goods_ids", 0);
            $goods_state = input("goods_state", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->modifyGoodsState($goods_ids, $goods_state, $this->site_id);
            return $res;
        }
    }

    /**
     * 编辑商品库存
     * @return array|\multitype
     */
    public function editGoodsStock()
    {
        if (request()->isAjax()) {
            $sku_list = input("sku_list", '');
            $model = new GoodsModel;
            $res = $model->editGoodsStock($sku_list);
            return $res;
        }
    }

    /**
     * 获取商品分类列表
     * @return \multitype
     */
    public function getCategoryList()
    {
        if (request()->isAjax()) {
            $category_id = input("category_id", 0);
            $goods_category_model = new GoodsCategoryModel();
            $condition = [
                [ 'pid', '=', $category_id ],
                [ 'site_id', '=', $this->site_id ]
            ];

            $goods_category_list = $goods_category_model->getCategoryList($condition, 'category_id,category_name,level,commission_rate');
            return $goods_category_list;
        }
    }

    /**
     * 获取商品属性列表
     * @return \multitype
     */
    public function getAttributeList()
    {

        if (request()->isAjax()) {
            $goods_attr_model = new GoodsAttributeModel();
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attribute_list = $goods_attr_model->getAttributeList([ [ 'attr_class_id', '=', $attr_class_id ], [ 'is_spec', '=', 0 ], [ 'site_id', '=', $this->site_id ] ], 'attr_id,attr_name,attr_class_id,attr_class_name,attr_type,attr_value_format', 'sort asc');
            if (!empty($attribute_list[ 'data' ])) {
                foreach ($attribute_list[ 'data' ] as $k => $v) {
                    if (!empty($v[ 'attr_value_format' ])) {
                        $attribute_list[ 'data' ][ $k ][ 'attr_value_format' ] = json_decode($v[ 'attr_value_format' ], true);
                    }
                }
            }

            return $attribute_list;
        }
    }

    /**
     * 获取SKU商品列表
     * @return \multitype
     */
    public function getGoodsSkuList()
    {
        if (request()->isAjax()) {
            $goods_id = input("goods_id", 0);
            $goods_model = new GoodsModel();
            $res = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $this->site_id ] ], 'sku_id,sku_name,price,market_price,cost_price,stock,weight,volume,sku_no,sale_num,sku_image,spec_name,goods_id,stock_alarm');
            return $res;
        }
    }

    /**
     * 商品选择组件
     * @return \multitype
     */
    public function goodsSelect()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $goods_name = input('goods_name', '');
            $goods_id = input('goods_id', 0);
            $is_virtual = input('is_virtual', '');// 是否虚拟类商品（0实物1.虚拟）
            $min_price = input('min_price', 0);
            $max_price = input('max_price', 0);
            $goods_class = input('goods_class', "");// 商品类型，实物、虚拟
            $category_id = input('category_id', "");// 商品分类id
            $promotion = input('promotion', '');//营销活动标识：pintuan、groupbuy、fenxiao、bargain
            $promotion_type = input('promotion_type', "");
            $label_id = input('label_id', "");

            if (!empty($promotion) && addon_is_exit($promotion)) {
                $pintuan_name = input('pintuan_name', '');//拼团活动
                $goods_list = event('GoodsListPromotion', [ 'page' => $page, 'page_size' => $page_size, 'site_id' => $this->site_id, 'promotion' => $promotion, 'pintuan_name' => $pintuan_name, 'goods_name' => $goods_name ], true);
            } else {
                $condition = [
                    [ 'is_delete', '=', 0 ],
                    [ 'goods_state', '=', 1 ],
                    [ 'site_id', '=', $this->site_id ]
                ];
                if (!empty($goods_name)) {
                    $condition[] = [ 'goods_name', 'like', '%' . $goods_name . '%' ];
                }
                if ($is_virtual !== "") {
                    $condition[] = [ 'is_virtual', '=', $is_virtual ];
                }
                if (!empty($goods_id)) {
                    $condition[] = [ 'goods_id', '=', $goods_id ];
                }
                if (!empty($category_id)) {
                    $condition[] = [ 'category_id', 'like', '%,' . $category_id . ',%' ];
                }

                if (!empty($promotion_type)) {
                    $condition[] = [ 'promotion_addon', 'like', "%{$promotion_type}%" ];
                }

                if (!empty($label_id)) {
                    $condition[] = [ 'label_id', '=', $label_id ];
                }

                if ($goods_class !== "") {
                    $condition[] = [ 'goods_class', '=', $goods_class ];
                }

                if ($min_price != "" && $max_price != "") {
                    $condition[] = [ 'price', 'between', [ $min_price, $max_price ] ];
                } elseif ($min_price != "") {
                    $condition[] = [ 'price', '<=', $min_price ];
                } elseif ($max_price != "") {
                    $condition[] = [ 'price', '>=', $max_price ];
                }

                $order = 'sort asc,create_time desc';
                $goods_model = new GoodsModel();
                $field = 'goods_id,goods_name,goods_class_name,goods_image,price,goods_stock,create_time,is_virtual';
                $goods_list = $goods_model->getGoodsPageList($condition, $page, $page_size, $order, $field);

                if (!empty($goods_list[ 'data' ][ 'list' ])) {
                    foreach ($goods_list[ 'data' ][ 'list' ] as $k => $v) {
                        $goods_sku_list = $goods_model->getGoodsSkuList([ [ 'goods_id', '=', $v[ 'goods_id' ] ], [ 'site_id', '=', $this->site_id ] ], 'sku_id,sku_name,price,stock,sku_image,goods_id,goods_class_name', 'price asc');
                        $goods_sku_list = $goods_sku_list[ 'data' ];
                        $goods_list[ 'data' ][ 'list' ][ $k ][ 'sku_list' ] = $goods_sku_list;
                    }

                }
            }
            return $goods_list;
        } else {

            //已经选择的商品sku数据
            $select_id = input('select_id', '');
            $mode = input('mode', 'spu');
            $max_num = input('max_num', 0);
            $min_num = input('min_num', 0);
            $is_virtual = input('is_virtual', '');
            $disabled = input('disabled', 0);
            $promotion = input('promotion', '');//营销活动标识：pintuan、groupbuy、seckill、fenxiao

            $this->assign('select_id', $select_id);
            $this->assign('mode', $mode);
            $this->assign('max_num', $max_num);
            $this->assign('min_num', $min_num);
            $this->assign('select_id', $select_id);
            $this->assign('is_virtual', $is_virtual);
            $this->assign('disabled', $disabled);
            $this->assign('promotion', $promotion);

            // 营销活动
            $goods_promotion_type = event('GoodsPromotionType');
            $this->assign('promotion_type', $goods_promotion_type);

            // 商品分组
            $goods_label_model = new GoodsLabelModel();
            $label_list = $goods_label_model->getLabelList([ [ 'site_id', '=', $this->site_id ] ], 'id,label_name', 'create_time desc');
            $label_list = $label_list[ 'data' ];
            $this->assign("label_list", $label_list);

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

                    $two_list = $two_list[ 'data' ];
                    if (!empty($two_list)) {

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
            }

            $this->assign("category_list", $list);
            return $this->fetch("goods/goods_select");
        }
    }

    /***********************************************************商品评价**************************************************/

    /**
     * 商品评价
     */
    public function evaluate()
    {
        $goods_evaluate = new GoodsEvaluateModel();

        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $explain_type = input('explain_type', ''); //1好评2中评3差评
            $is_show = input('is_show', ''); //1显示 0隐藏
            $search_text = input('search_text', ''); //搜索值
            $search_type = input('search_type', ''); //搜索类型
            $start_time = input('start_time', '');
            $end_time = input('end_time', '');
            $goods_id = input('goods_id', '');
            $condition = [
                [ "site_id", "=", $this->site_id ]
            ];
            //评分类型
            if ($explain_type != "") {
                $condition[] = [ "explain_type", "=", $explain_type ];
            }
            if ($is_show != "") {
                $condition[] = [ "is_show", "=", $is_show ];
            }
            if ($search_text != "") {
                $condition[] = [ $search_type, "like", '%' . $search_text . '%' ];
            }
            if ($goods_id != "") {
                $condition[] = [ 'goods_id', "=", $goods_id ];
            }
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "create_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "create_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'create_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }
            return $goods_evaluate->getEvaluatePageList($condition, $page_index, $page_size, "create_time desc");
        } else {
            $goods_id = input('goods_id', '');
            $this->assign('goods_id', $goods_id);
            return $this->fetch("goods/evaluate");
        }

    }

    /**
     * 商品评价删除
     */
    public function deleteEvaluate()
    {

        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            return $goods_evaluate->deleteEvaluate($evaluate_id);
        }
    }

    /**
     * 修改商品评价审核状态
     */
    public function modifyAuditEvaluate()
    {
        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_ids = input("evaluate_ids", '');
            $is_audit = input('is_audit', 0);
            $data = [
                'is_audit' => $is_audit
            ];
            $condition = [
                [ 'evaluate_id', 'in', $evaluate_ids ],
                [ 'is_audit', '=', 0 ],
                [ 'site_id', '=', $this->site_id ],
            ];
            $res = $goods_evaluate->modifyAuditEvaluate($data, $condition);
            return $res;
        }
    }

    /**
     * 商品推广
     * return
     */
    public function goodsUrl()
    {
        $goods_id = input('goods_id', '');
        $goods_model = new GoodsModel();
        $goods_sku_info = $goods_model->getGoodsSkuInfo([ [ 'goods_id', '=', $goods_id ] ], 'sku_id,goods_name,site_id');
        $goods_sku_info = $goods_sku_info[ 'data' ];
        $res = $goods_model->qrcode($goods_sku_info[ 'sku_id' ], $goods_sku_info[ 'goods_name' ], $goods_sku_info[ 'site_id' ]);
        return $res;
    }

    /**
     * 商品预览
     * return
     */
    public function goodsPreview()
    {
        $goods_id = input('goods_id', '');
        $goods_model = new GoodsModel();
        $goods_sku_info = $goods_model->getGoodsSkuInfo([ [ 'goods_id', '=', $goods_id ] ], 'sku_id,goods_name,site_id');
        $goods_sku_info = $goods_sku_info[ 'data' ];
        $res = $goods_model->qrcode($goods_sku_info[ 'sku_id' ], $goods_sku_info[ 'goods_name' ], $goods_sku_info[ 'site_id' ]);
        return $res;
    }

    /**
     * 商品评价回复
     */
    public function evaluateApply()
    {
        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            $explain = input("explain", 0);
            $is_first_explain = input("is_first_explain", 0);// 是否第一次回复
            $data = [
                'evaluate_id' => $evaluate_id
            ];
            if ($is_first_explain == 0) {
                $data[ 'explain_first' ] = $explain;
            } elseif ($is_first_explain == 1) {
                $data[ 'again_explain' ] = $explain;
            }

            return $goods_evaluate->evaluateApply($data);
        }
    }

    /**
     * 商品评价回复
     */
    public function deleteContent()
    {
        if (request()->isAjax()) {
            $goods_evaluate = new GoodsEvaluateModel();
            $evaluate_id = input("evaluate_id", 0);
            $is_first_explain = input("is_first", 0);// 0 第一次回复，1 追评回复
            $data = [];
            if ($is_first_explain == 0) {
                $data[ 'explain_first' ] = '';
            } elseif ($is_first_explain == 1) {
                $data[ 'again_explain' ] = '';
            }
            $condition = [
                [ 'evaluate_id', '=', $evaluate_id ],
                [ 'site_id', '=', $this->site_id ],
            ];

            return $goods_evaluate->editEvaluate($data, $condition);
        }
    }

    /**
     * 商品批量设置
     */
    public function batchSet()
    {
        if (request()->isAjax()) {
            $type = input("type", '');
            $goods_ids = input("goods_ids", '');
            $field = input("field", '');
            $data = !empty($field) ? json_decode($field, true) : [];
            $goods_model = new GoodsModel();

            $result = error(-1, '操作失败');
            try {
                if (!empty($goods_ids)) {
                    switch ( $type ) {
                        case 'group':
                            $result = $goods_model->modifyGoodsLabel($data[ 'group' ], $this->site_id, $goods_ids);
                            break;
                        case 'service':
                            $result = $goods_model->modifyGoodsService($data[ 'server_ids' ], $this->site_id, $goods_ids);
                            break;
                        case 'sale':
                            $result = $goods_model->modifyGoodsVirtualSale($data[ 'sale' ], $this->site_id, $goods_ids);
                            break;
                        case 'purchase_limit':
                            $result = $goods_model->modifyGoodsPurchaseLimit($data[ 'max_buy' ], $this->site_id, $goods_ids);
                            break;
                        case 'shipping':
                            $result = $goods_model->modifyGoodsShippingTemplate($data[ 'is_free_shipping' ], $data[ 'shipping_template' ], $this->site_id, $goods_ids);
                            break;
                        case 'category':
                            $result = $goods_model->modifyGoodsCategoryId($data[ 'category_id' ], $this->site_id, $goods_ids);
                            //$result = ',' . implode(',', $data[ 'category_id' ]) . ',';
                            break;
                        case 'shop_intor':
                            $result = $goods_model->modifyGoodsShopIntor($data[ 'recom_way' ], $this->site_id, $goods_ids);
                            break;
                    }
                }
            } catch (\Exception $e) {
                $result = error(-1, $e->getMessage());
            }
            return $result;
        }
    }

    /**
     * 热门搜索关键词
     * @return mixed
     */
    public function hotSearchWords()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $words = input("words", []);
            $data = [
                'words' => implode(',', $words)
            ];
            $res = $config_model->setHotSearchWords($data, $this->site_id, $this->app_module);
            return $res;
        } else {
            $hot_search_words = $config_model->getHotSearchWords($this->site_id, $this->app_module);
            $hot_search_words = $hot_search_words[ 'data' ][ 'value' ];

            $words_array = [];
            if (!empty($hot_search_words[ 'words' ])) {
                $words_array = explode(',', $hot_search_words[ 'words' ]);
            }
            $hot_search_words[ 'words_array' ] = $words_array;
            $this->assign("hot_search_words", $hot_search_words);
            return $this->fetch('goods/hot_search_words');
        }
    }


    /**
     * 默认搜索关键词
     * @return mixed
     */
    public function defaultSearchWords()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $data = [
                'words' => input("words", "")
            ];
            $res = $config_model->setDefaultSearchWords($data, $this->site_id, $this->app_module);
            return $res;
        } else {
            $default_search_words = $config_model->getDefaultSearchWords($this->site_id, $this->app_module);
            $default_search_words = $default_search_words[ 'data' ][ 'value' ];
            $this->assign("default_search_words", $default_search_words);
            return $this->fetch('goods/default_search_words');
        }
    }

    /**
     * 复制商品
     * @return array
     */
    public function copyGoods()
    {
        if (request()->isAjax()) {
            $goods_id = input('goods_id', '');
            $goods_model = new GoodsModel();
            $res = $goods_model->copyGoods($goods_id);
            return $res;
        }
    }

    /**
     * 会员商品收藏
     */
    public function memberGoodsCollect()
    {
        $goods_collect_model = new GoodsCollect();
        $member_id = input('member_id', 0);
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition = [];
            $condition[] = [ 'gc.site_id', '=', $this->site_id ];
            $condition[] = [ 'gc.member_id', '=', $member_id ];
            $order = 'gc.create_time desc';
            $field = 'gc.collect_id, gc.member_id, gc.goods_id, gc.sku_id,gc.sku_name, gc.sku_price, gc.sku_image,g.goods_name,g.is_free_shipping,sku.promotion_type,sku.member_price,sku.discount_price,g.sale_num,g.price,g.market_price,g.is_virtual,sku.*';
            return $goods_collect_model->getCollectPageList($condition, $page, $page_size, $order, $field);
        } else {
            $this->forthMenu([ 'member_id' => $member_id ]);
            $this->assign('member_id', $member_id);
            return $this->fetch('goods/member_goods_collect');
        }
    }

    /**
     * 会员浏览记录
     */
    public function memberGoodsBrowse()
    {
        $member_id = input('member_id', 0);
        $goods_browse_model = new GoodsBrowse();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search = input('search', '');
            $condition = [];
            $condition[] = [ 'gb.site_id', '=', $this->site_id ];
            $condition[] = [ 'gb.member_id', '=', $member_id ];
            if (!empty($search))
                $condition[] = [ 'gs.sku_name', 'like', '%' . $search . '%' ];

            $order = 'browse_time desc';
            $field = 'gb.*,gs.sku_name,gs.sku_image,gs.price,gs.goods_state,gs.stock,gs.click_num';
            $alias = 'gb';
            $join = [
                [ 'goods_sku gs', 'gs.sku_id = gb.sku_id', 'left' ]
            ];
            return $goods_browse_model->getBrowsePageList($condition, $page, $page_size, $order, $field, $alias, $join);
        } else {
            $this->forthMenu([ 'member_id' => $member_id ]);
            $this->assign('member_id', $member_id);
            return $this->fetch('goods/member_goods_browse');
        }
    }

    /**
     * 商品浏览记录
     */
    public function goodsBrowse()
    {
        $goods_id = input('goods_id', 0);
        $goods_browse_model = new GoodsBrowse();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search = input('search', '');
            $condition = [];
            $condition[] = [ 'gb.site_id', '=', $this->site_id ];
            if ($goods_id > 0) {
                $condition[] = [ 'gb.goods_id', '=', $goods_id ];
            }
            if (!empty($search))
                $condition[] = [ 'gs.sku_name', 'like', '%' . $search . '%' ];

            $order = 'browse_time desc';
            $field = 'gb.*,gs.sku_name,gs.sku_image,gs.price,gs.goods_state,gs.stock,gs.click_num,m.nickname,m.headimg';
            $alias = 'gb';
            $join = [
                [ 'goods_sku gs', 'gs.sku_id = gb.sku_id', 'left' ],
                [ 'member m', 'm.member_id = gb.member_id', 'left' ]
            ];
            return $goods_browse_model->getBrowsePageList($condition, $page, $page_size, $order, $field, $alias, $join);
        } else {
            $this->assign('goods_id', $goods_id);
            return $this->fetch('goods/goods_browse');
        }
    }


}