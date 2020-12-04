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

use app\model\goods\Goods as GoodsModel;
use app\model\goods\GoodsCategory as GoodsCategoryModel;
use app\model\goods\GoodsService as GoodsServiceModel;


/**
 * 增加默认商品相关数据：商品1~3个、商品分类、商品服务
 */
class AddYanshiData
{

    public function handle($param)
    {
        if (!empty($param[ 'site_id' ])) {

            // 商品服务
            $goods_service_data = [
                [
                    'site_id' => $param[ 'site_id' ],
                    'service_name' => '7天无理由退货',
                    'desc' => '支持7天无理由退货(拆封后不支持)'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'service_name' => '闪电退款',
                    'desc' => '闪电退款为会员提供的快速退款服务'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'service_name' => '货到付款',
                    'desc' => '支持送货上门后再收款，支持现金、POS机刷卡等方式'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'service_name' => '运费险',
                    'desc' => '卖家为您购买的商品投保退货运费险（保单生效以确认订单页展示的运费险为准）'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'service_name' => '公益宝贝',
                    'desc' => '购买该商品，每笔成交都会有相应金额捐赠给公益。感谢您的支持，愿公益的快乐伴随您每一天'
                ]
            ];
            $model = new GoodsServiceModel();
            $model->addServiceList($goods_service_data);

            // 商品分类
            $goods_category_model = new GoodsCategoryModel();

            $category_data = [
                [
                    'site_id' => $param[ 'site_id' ],
                    'category_name' => '分类一',
                    'level' => 1,
                    'is_show' => 1,
                    'category_full_name' => '分类一'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'category_name' => '分类二',
                    'level' => 1,
                    'is_show' => 1,
                    'category_full_name' => '分类二'
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'category_name' => '分类三',
                    'level' => 1,
                    'is_show' => 1,
                    'category_full_name' => '分类三'
                ],
            ];
            $category_ids = [];
            foreach ($category_data as $ck => $cv) {
                $category_res = $goods_category_model->addCategory($cv);

                if (!empty($category_res[ 'data' ])) {

                    //修改category_id_
                    $update_data = [
                        'category_id' => $category_res[ 'data' ],
                        'category_id_1' => $category_res[ 'data' ],
                        'site_id' => $param[ 'site_id' ]
                    ];
                    $goods_category_model->editCategory($update_data);
                    $category_ids[] = $category_res[ 'data' ];
                }
            }

            // 商品
            $goods_data = [
                [
                    "goods_name" => '演示商品一',
                    "goods_attr_class" => "",
                    "goods_attr_name" => "",
                    "site_id" => $param[ 'site_id' ],
                    "category_id" => "," . $category_ids[ 0 ] . ",",
                    "category_json" => '[" ' . $category_ids[ 0 ] . '"]',
                    "goods_image" => "upload/default/diy_view/crack_figure.png",
                    "goods_content" => "<p>演示商品一</p>",
                    "goods_state" => "1",
                    "price" => "0.01",
                    "market_price" => "",
                    "cost_price" => "",
                    "sku_no" => "",
                    "weight" => "",
                    "volume" => "",
                    "goods_stock" => "100",
                    "goods_stock_alarm" => "",
                    "is_free_shipping" => "1",
                    "shipping_template" => "",
                    "goods_spec_format" => "",
                    "goods_attr_format" => "",
                    "introduction" => "",
                    "keywords" => "",
                    "unit" => "",
                    "sort" => "",
                    "video_url" => "",
                    "goods_sku_data" => json_encode([ [
                        "sku_id" => 0,
                        'sku_name' => '演示商品一',
                        "spec_name" => "",
                        "sku_no" => "",
                        "sku_spec_format" => "",
                        "price" => "0.01",
                        "market_price" => "",
                        "cost_price" => "",
                        "stock" => "100",
                        "weight" => "",
                        "volume" => "",
                        "sku_image" => "upload/default/diy_view/crack_figure.png",
                        "sku_images" => "upload/default/diy_view/crack_figure.png",
                        "virtual_sale" => 0,
                        "max_buy" => 0,
                        "min_buy" => 0,
                        "stock_alarm" => 0
                    ] ]),
                    "goods_service_ids" => "",
                    "label_id" => "",
                    "virtual_sale" => 0,
                    "max_buy" => 0,
                    "min_buy" => 0,
                    "recommend_way" => 0,
                    "timer_on" => 0,
                    "timer_off" => 0
                ],
                [
                    "goods_name" => '演示商品二',
                    "goods_attr_class" => "",
                    "goods_attr_name" => "",
                    "site_id" => $param[ 'site_id' ],
                    "category_id" => "," . $category_ids[ 1 ] . ",",
                    "category_json" => '[" ' . $category_ids[ 1 ] . '"]',
                    "goods_image" => "upload/default/diy_view/crack_figure.png",
                    "goods_content" => "<p>演示商品二</p>",
                    "goods_state" => "1",
                    "price" => "0.01",
                    "market_price" => "",
                    "cost_price" => "",
                    "sku_no" => "",
                    "weight" => "",
                    "volume" => "",
                    "goods_stock" => "100",
                    "goods_stock_alarm" => "",
                    "is_free_shipping" => "1",
                    "shipping_template" => "",
                    "goods_spec_format" => "",
                    "goods_attr_format" => "",
                    "introduction" => "",
                    "keywords" => "",
                    "unit" => "",
                    "sort" => "",
                    "video_url" => "",
                    "goods_sku_data" => json_encode([ [
                        "sku_id" => 0,
                        'sku_name' => '演示商品二',
                        "spec_name" => "",
                        "sku_no" => "",
                        "sku_spec_format" => "",
                        "price" => "0.01",
                        "market_price" => "",
                        "cost_price" => "",
                        "stock" => "100",
                        "weight" => "",
                        "volume" => "",
                        "sku_image" => "upload/default/diy_view/crack_figure.png",
                        "sku_images" => "upload/default/diy_view/crack_figure.png",
                        "virtual_sale" => 0,
                        "max_buy" => 0,
                        "min_buy" => 0,
                        "stock_alarm" => 0
                    ] ]),
                    "goods_service_ids" => "",
                    "label_id" => "",
                    "virtual_sale" => 0,
                    "max_buy" => 0,
                    "min_buy" => 0,
                    "recommend_way" => 0,
                    "timer_on" => 0,
                    "timer_off" => 0
                ],
                [
                    "goods_name" => '演示商品三',
                    "goods_attr_class" => "",
                    "goods_attr_name" => "",
                    "site_id" => $param[ 'site_id' ],
                    "category_id" => "," . $category_ids[ 2 ] . ",",
                    "category_json" => '[" ' . $category_ids[ 2 ] . '"]',
                    "goods_image" => "upload/default/diy_view/crack_figure.png",
                    "goods_content" => "<p>演示商品三</p>",
                    "goods_state" => "1",
                    "price" => "0.01",
                    "market_price" => "",
                    "cost_price" => "",
                    "sku_no" => "",
                    "weight" => "",
                    "volume" => "",
                    "goods_stock" => "100",
                    "goods_stock_alarm" => "",
                    "is_free_shipping" => "1",
                    "shipping_template" => "",
                    "goods_spec_format" => "",
                    "goods_attr_format" => "",
                    "introduction" => "",
                    "keywords" => "",
                    "unit" => "",
                    "sort" => "",
                    "video_url" => "",
                    "goods_sku_data" => json_encode([ [
                        "sku_id" => 0,
                        'sku_name' => '演示商品三',
                        "spec_name" => "",
                        "sku_no" => "",
                        "sku_spec_format" => "",
                        "price" => "0.01",
                        "market_price" => "",
                        "cost_price" => "",
                        "stock" => "100",
                        "weight" => "",
                        "volume" => "",
                        "sku_image" => "upload/default/diy_view/crack_figure.png",
                        "sku_images" => "upload/default/diy_view/crack_figure.png",
                        "virtual_sale" => 0,
                        "max_buy" => 0,
                        "min_buy" => 0,
                        "stock_alarm" => 0
                    ] ]),
                    "goods_service_ids" => "",
                    "label_id" => "",
                    "virtual_sale" => 0,
                    "max_buy" => 0,
                    "min_buy" => 0,
                    "recommend_way" => 0,
                    "timer_on" => 0,
                    "timer_off" => 0
                ],
                [
                    'goods_name' => '演示商品四',
                    "goods_attr_class" => "",
                    "goods_attr_name" => "",
                    "site_id" => $param[ 'site_id' ],
                    "category_id" => "," . $category_ids[ 2 ] . ",",
                    "category_json" => '[" ' . $category_ids[ 2 ] . '"]',
                    "goods_image" => "upload/default/diy_view/crack_figure.png",
                    "goods_content" => "<p>​演示商品四</p>",
                    "goods_state" => "1",
                    "price" => "0.01",
                    "market_price" => "",
                    "cost_price" => "",
                    "sku_no" => "",
                    "weight" => "",
                    "volume" => "",
                    "goods_stock" => "100",
                    "goods_stock_alarm" => "",
                    "is_free_shipping" => "1",
                    "shipping_template" => "",
                    "goods_spec_format" => "",
                    "goods_attr_format" => "",
                    "introduction" => "",
                    "keywords" => "",
                    "unit" => "",
                    "sort" => "",
                    "video_url" => "",
                    "goods_sku_data" => json_encode([ [
                        "sku_id" => 0,
                        'sku_name' => '演示商品四',
                        "spec_name" => "",
                        "sku_no" => "",
                        "sku_spec_format" => "",
                        "price" => "0.01",
                        "market_price" => "",
                        "cost_price" => "",
                        "stock" => "100",
                        "weight" => "",
                        "volume" => "",
                        "sku_image" => "upload/default/diy_view/crack_figure.png",
                        "sku_images" => "upload/default/diy_view/crack_figure.png",
                        "virtual_sale" => 0,
                        "max_buy" => 0,
                        "min_buy" => 0,
                        "stock_alarm" => 0
                    ] ]),
                    "goods_service_ids" => "",
                    "label_id" => "",
                    "virtual_sale" => 0,
                    "max_buy" => 0,
                    "min_buy" => 0,
                    "recommend_way" => 0,
                    "timer_on" => 0,
                    "timer_off" => 0
                ]
            ];

            $goods_model = new GoodsModel();
            foreach ($goods_data as $gk => $gv) {
                $res = $goods_model->addGoods($gv);
            }

            return $res;

        }

    }

}