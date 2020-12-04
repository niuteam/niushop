<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\goods;

use addon\discount\model\Discount;
use app\model\BaseModel;
use app\model\order\Order;
use app\model\order\OrderRefund;
use app\model\system\Config as ConfigModel;
use app\model\system\Cron;
use app\model\system\Stat;

/**
 * 商品
 */
class Goods extends BaseModel
{

    private $goods_class = array ( 'id' => 1, 'name' => '实物商品' );

    private $goods_state = array (
        1 => '销售中',
        0 => '仓库中'
    );

    public function getGoodsState()
    {
        return $this->goods_state;
    }

    /**
     * 商品添加
     * @param $data
     */
    public function addGoods($data)
    {
        model('goods')->startTrans();
        try {

            if (!empty($data[ 'goods_attr_format' ])) {

                $goods_attr_format = json_decode($data[ 'goods_attr_format' ], true);
                $keys = array_column($goods_attr_format, 'sort');
                if (!empty($keys)) {
                    array_multisort($keys, SORT_ASC, SORT_NUMERIC, $goods_attr_format);
                    $data[ 'goods_attr_format' ] = json_encode($goods_attr_format);
                }
            }

            $goods_image = $data[ 'goods_image' ];
            $first_image = explode(",", $goods_image)[ 0 ];

            //SKU商品数据
            if (!empty($data[ 'goods_sku_data' ])) {
                $data[ 'goods_sku_data' ] = json_decode($data[ 'goods_sku_data' ], true);
//                if (empty($goods_image)) {
//                    $goods_image = $data[ 'goods_sku_data' ][ 0 ][ 'sku_image' ];
//                }
            }

            $goods_data = array (
                'goods_image' => $goods_image,
                'goods_stock' => $data[ 'goods_stock' ],
                'price' => $data[ 'goods_sku_data' ][ 0 ][ 'price' ],
                'market_price' => $data[ 'goods_sku_data' ][ 0 ][ 'market_price' ],
                'cost_price' => $data[ 'goods_sku_data' ][ 0 ][ 'cost_price' ],
                'goods_spec_format' => $data[ 'goods_spec_format' ],
                'category_id' => $data[ 'category_id' ],
                'category_json' => $data[ 'category_json' ],
                'label_id' => $data[ 'label_id' ],
                'timer_on' => $data[ 'timer_on' ],
                'timer_off' => $data[ 'timer_off' ],
            );

            $common_data = array (
                'goods_name' => $data[ 'goods_name' ],
                'goods_class' => $this->goods_class[ 'id' ],
                'goods_class_name' => $this->goods_class[ 'name' ],
                'goods_attr_class' => $data[ 'goods_attr_class' ],
                'goods_attr_name' => $data[ 'goods_attr_name' ],
                'site_id' => $data[ 'site_id' ],
                'goods_content' => $data[ 'goods_content' ],
                'goods_state' => $data[ 'goods_state' ],
                'goods_stock_alarm' => $data[ 'goods_stock_alarm' ],
                'is_free_shipping' => $data[ 'is_free_shipping' ],
                'shipping_template' => $data[ 'shipping_template' ],
                'goods_attr_format' => $data[ 'goods_attr_format' ],
                'introduction' => $data[ 'introduction' ],
                'keywords' => $data[ 'keywords' ],
                'unit' => $data[ 'unit' ],
                'video_url' => $data[ 'video_url' ],
                'sort' => $data[ 'sort' ],
                'goods_service_ids' => $data[ 'goods_service_ids' ],
                'create_time' => time(),
                'virtual_sale' => $data[ 'virtual_sale' ],
                'max_buy' => $data[ 'max_buy' ],
                'min_buy' => $data[ 'min_buy' ],
                'recommend_way' => $data[ 'recommend_way' ]
            );

            $goods_id = model('goods')->add(array_merge($goods_data, $common_data));

            $sku_arr = array ();
            //添加sku商品
            foreach ($data[ 'goods_sku_data' ] as $item) {

                $sku_data = array (
                    'sku_name' => $data[ 'goods_name' ] . ' ' . $item[ 'spec_name' ],
                    'spec_name' => $item[ 'spec_name' ],
                    'sku_no' => $item[ 'sku_no' ],
                    'sku_spec_format' => !empty($item[ 'sku_spec_format' ]) ? json_encode($item[ 'sku_spec_format' ]) : "",
                    'price' => $item[ 'price' ],
                    'market_price' => $item[ 'market_price' ],
                    'cost_price' => $item[ 'cost_price' ],
                    'discount_price' => $item[ 'price' ],//sku折扣价（默认等于单价）
                    'stock' => $item[ 'stock' ],
                    'stock_alarm' => $item[ 'stock_alarm' ],
                    'weight' => $item[ 'weight' ],
                    'volume' => $item[ 'volume' ],
                    'sku_image' => !empty($item[ 'sku_image' ]) ? $item[ 'sku_image' ] : $first_image,
                    'sku_images' => $item[ 'sku_images' ],
                    'goods_id' => $goods_id,
                    'is_default' => $item[ 'is_default' ] ?? 0,
                );

                $sku_arr[] = array_merge($sku_data, $common_data);
            }

            model('goods_sku')->addList($sku_arr);

            // 赋值第一个商品sku_id
            $first_info = model('goods_sku')->getFirstData([ 'goods_id' => $goods_id ], 'sku_id', 'is_default desc,sku_id asc');
            model('goods')->update([ 'sku_id' => $first_info[ 'sku_id' ] ], [ [ 'goods_id', '=', $goods_id ] ]);

            if (!empty($data[ 'goods_spec_format' ])) {
                // 刷新SKU商品规格项/规格值JSON字符串
                $this->dealGoodsSkuSpecFormat($goods_id, $data[ 'goods_spec_format' ]);
            }

            $cron = new Cron();
            //定时上下架
            if ($goods_data[ 'timer_on' ] > 0) {
                $cron->addCron(1, 0, "商品定时上架", "CronGoodsTimerOn", $goods_data[ 'timer_on' ], $goods_id);
            }
            if ($goods_data[ 'timer_off' ] > 0) {
                $cron->addCron(1, 0, "商品定时下架", "CronGoodsTimerOff", $goods_data[ 'timer_off' ], $goods_id);
            }

            //添加店铺添加统计
            $stat = new Stat();
            $stat->addShopStat([ 'add_goods_count' => 1, 'site_id' => $data[ 'site_id' ] ]);
            model('goods')->commit();

            return $this->success($goods_id);
        } catch (\Exception $e) {
            model('goods')->rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * 商品编辑
     * @param $data
     */
    public function editGoods($data)
    {

        model('goods')->startTrans();

        try {

            if (!empty($data[ 'goods_attr_format' ])) {

                $goods_attr_format = json_decode($data[ 'goods_attr_format' ], true);
                $keys = array_column($goods_attr_format, 'sort');
                if (!empty($keys)) {
                    array_multisort($keys, SORT_ASC, SORT_NUMERIC, $goods_attr_format);
                    $data[ 'goods_attr_format' ] = json_encode($goods_attr_format);
                }
            }
            $goods_id = $data[ 'goods_id' ];
            $goods_image = $data[ 'goods_image' ];
            $first_image = explode(",", $goods_image)[ 0 ];

            //SKU商品数据
            if (!empty($data[ 'goods_sku_data' ])) {
                $data[ 'goods_sku_data' ] = json_decode($data[ 'goods_sku_data' ], true);
//                if (empty($goods_image)) {
//                    $goods_image = $data[ 'goods_sku_data' ][ 0 ][ 'sku_image' ];
//                }
            }

            $goods_data = array (
                'goods_image' => $goods_image,
                'goods_stock' => $data[ 'goods_stock' ],
                'price' => $data[ 'goods_sku_data' ][ 0 ][ 'price' ],
                'market_price' => $data[ 'goods_sku_data' ][ 0 ][ 'market_price' ],
                'cost_price' => $data[ 'goods_sku_data' ][ 0 ][ 'cost_price' ],
                'goods_spec_format' => $data[ 'goods_spec_format' ],
                'category_id' => $data[ 'category_id' ],
                'category_json' => $data[ 'category_json' ],
                'label_id' => $data[ 'label_id' ],
                'timer_on' => $data[ 'timer_on' ],
                'timer_off' => $data[ 'timer_off' ],
            );

            $common_data = array (
                'goods_name' => $data[ 'goods_name' ],
                'goods_class' => $this->goods_class[ 'id' ],
                'goods_class_name' => $this->goods_class[ 'name' ],
                'goods_attr_class' => $data[ 'goods_attr_class' ],
                'goods_attr_name' => $data[ 'goods_attr_name' ],
                'site_id' => $data[ 'site_id' ],
                'goods_content' => $data[ 'goods_content' ],
                'goods_state' => $data[ 'goods_state' ],
                'goods_stock_alarm' => $data[ 'goods_stock_alarm' ],
                'is_free_shipping' => $data[ 'is_free_shipping' ],
                'shipping_template' => $data[ 'shipping_template' ],
                'goods_attr_format' => $data[ 'goods_attr_format' ],
                'introduction' => $data[ 'introduction' ],
                'keywords' => $data[ 'keywords' ],
                'unit' => $data[ 'unit' ],
                'video_url' => $data[ 'video_url' ],
                'sort' => $data[ 'sort' ],
                'goods_service_ids' => $data[ 'goods_service_ids' ],
                'modify_time' => time(),
                'virtual_sale' => $data[ 'virtual_sale' ],
                'max_buy' => $data[ 'max_buy' ],
                'min_buy' => $data[ 'min_buy' ],
                'recommend_way' => $data[ 'recommend_way' ]
            );

            model('goods')->update(array_merge($goods_data, $common_data), [ [ 'goods_id', '=', $goods_id ], [ 'goods_class', '=', $this->goods_class[ 'id' ] ] ]);

            // 如果只编辑价格库存就是修改，如果添加规格项/值就需要重新生成
            if (!empty($data[ 'goods_sku_data' ][ 0 ][ 'sku_id' ])) {
                if ($data[ 'spec_type_status' ] == 1) {
                    model('goods_sku')->delete([ [ 'goods_id', '=', $goods_id ] ]);

                    $sku_arr = array ();
                    //添加sku商品
                    foreach ($data[ 'goods_sku_data' ] as $item) {

                        $sku_data = array (
                            'sku_name' => $data[ 'goods_name' ] . ' ' . $item[ 'spec_name' ],
                            'spec_name' => $item[ 'spec_name' ],
                            'sku_no' => $item[ 'sku_no' ],
                            'sku_spec_format' => !empty($item[ 'sku_spec_format' ]) ? json_encode($item[ 'sku_spec_format' ]) : "",
                            'price' => $item[ 'price' ],
                            'market_price' => $item[ 'market_price' ],
                            'cost_price' => $item[ 'cost_price' ],
                            'discount_price' => $item[ 'price' ],//sku折扣价（默认等于单价）
                            'stock' => $item[ 'stock' ],
                            'stock_alarm' => $item[ 'stock_alarm' ],
                            'weight' => $item[ 'weight' ],
                            'volume' => $item[ 'volume' ],
                            'sku_image' => !empty($item[ 'sku_image' ]) ? $item[ 'sku_image' ] : $first_image,
                            'sku_images' => $item[ 'sku_images' ],
                            'goods_id' => $goods_id,
                            'is_default' => $item[ 'is_default' ] ?? 0,
                        );
                        $sku_arr[] = array_merge($sku_data, $common_data);
                    }
                    model('goods_sku')->addList($sku_arr);
                } else {
                    $discount_model = new Discount();
                    foreach ($data[ 'goods_sku_data' ] as $item) {
                        $discount_info = [];
                        if (!empty($item[ 'sku_id' ])) {
                            $discount_info_result = $discount_model->getDiscountGoodsInfo([ [ 'pdg.sku_id', '=', $item[ 'sku_id' ] ], [ 'pd.status', '=', 1 ] ], 'id');
                            $discount_info = $discount_info_result[ 'data' ];
                        }

                        $sku_data = array (
                            'sku_name' => $data[ 'goods_name' ] . ' ' . $item[ 'spec_name' ],
                            'spec_name' => $item[ 'spec_name' ],
                            'sku_no' => $item[ 'sku_no' ],
                            'sku_spec_format' => !empty($item[ 'sku_spec_format' ]) ? json_encode($item[ 'sku_spec_format' ]) : "",
                            'price' => $item[ 'price' ],
                            'market_price' => $item[ 'market_price' ],
                            'cost_price' => $item[ 'cost_price' ],
                            'stock' => $item[ 'stock' ],
                            'stock_alarm' => $item[ 'stock_alarm' ],
                            'weight' => $item[ 'weight' ],
                            'volume' => $item[ 'volume' ],
                            'sku_image' => !empty($item[ 'sku_image' ]) ? $item[ 'sku_image' ] : $first_image,
                            'sku_images' => $item[ 'sku_images' ],
                            'goods_id' => $goods_id,
                            'is_default' => $item[ 'is_default' ] ?? 0,
                        );
                        if (empty($discount_info)) {
                            $sku_data[ 'discount_price' ] = $item[ 'price' ];
                        }
                        if (!empty($item[ 'sku_id' ])) {
                            model('goods_sku')->update(array_merge($sku_data, $common_data), [ [ 'sku_id', '=', $item[ 'sku_id' ] ], [ 'goods_class', '=', $this->goods_class[ 'id' ] ] ]);
                        } else {
                            model('goods_sku')->add(array_merge($sku_data, $common_data));
                        }
                    }
                }

            } else {

                model('goods_sku')->delete([ [ 'goods_id', '=', $goods_id ] ]);

                $sku_arr = array ();
                //添加sku商品
                foreach ($data[ 'goods_sku_data' ] as $item) {

                    $sku_data = array (
                        'sku_name' => $data[ 'goods_name' ] . ' ' . $item[ 'spec_name' ],
                        'spec_name' => $item[ 'spec_name' ],
                        'sku_no' => $item[ 'sku_no' ],
                        'sku_spec_format' => !empty($item[ 'sku_spec_format' ]) ? json_encode($item[ 'sku_spec_format' ]) : "",
                        'price' => $item[ 'price' ],
                        'market_price' => $item[ 'market_price' ],
                        'cost_price' => $item[ 'cost_price' ],
                        'discount_price' => $item[ 'price' ],//sku折扣价（默认等于单价）
                        'stock' => $item[ 'stock' ],
                        'stock_alarm' => $item[ 'stock_alarm' ],
                        'weight' => $item[ 'weight' ],
                        'volume' => $item[ 'volume' ],
                        'sku_image' => !empty($item[ 'sku_image' ]) ? $item[ 'sku_image' ] : $first_image,
                        'sku_images' => $item[ 'sku_images' ],
                        'goods_id' => $goods_id,
                        'is_default' => $item[ 'is_default' ] ?? 0,
                    );

                    $sku_arr[] = array_merge($sku_data, $common_data);
                }

                model('goods_sku')->addList($sku_arr);
            }

            // 赋值第一个商品sku_id
            $first_info = model('goods_sku')->getFirstData([ 'goods_id' => $goods_id ], 'sku_id', 'is_default desc,sku_id asc');
            model('goods')->update([ 'sku_id' => $first_info[ 'sku_id' ] ], [ [ 'goods_id', '=', $goods_id ] ]);

            if (!empty($data[ 'goods_spec_format' ])) {
                //刷新SKU商品规格项/规格值JSON字符串
                $this->dealGoodsSkuSpecFormat($goods_id, $data[ 'goods_spec_format' ]);
            }

            $cron = new Cron();
            $cron->deleteCron([ [ 'event', '=', 'CronGoodsTimerOn' ], [ 'relate_id', '=', $goods_id ] ]);
            $cron->deleteCron([ [ 'event', '=', 'CronGoodsTimerOff' ], [ 'relate_id', '=', $goods_id ] ]);
            //定时上下架
            if ($goods_data[ 'timer_on' ] > 0) {
                $cron->addCron(1, 0, "商品定时上架", "CronGoodsTimerOn", $goods_data[ 'timer_on' ], $goods_id);
            }
            if ($goods_data[ 'timer_off' ] > 0) {
                $cron->addCron(1, 0, "商品定时下架", "CronGoodsTimerOff", $goods_data[ 'timer_off' ], $goods_id);
            }

            model('goods')->commit();
            return $this->success($goods_id);
        } catch (\Exception $e) {
            model('goods')->rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * 商品复制
     * @param $goods_id
     * @return array
     */
    public function copyGoods($goods_id)
    {
        $goods_info = model("goods")->getInfo([ [ 'goods_id', '=', $goods_id ] ]);
        if (empty($goods_info)) {
            return $this->error('', '商品不存在，无法复制！');
        }

        model('goods')->startTrans();

        try {
            unset($goods_info[ 'goods_id' ]);
            $goods_info[ 'goods_name' ] .= '_副本';
            $goods_info[ 'goods_state' ] = 0;
            $goods_info[ 'goods_stock' ] = 0;
            $goods_info[ 'create_time' ] = time();
            $goods_info[ 'modify_time' ] = 0;
            $goods_info[ 'sale_num' ] = 0;
            $goods_info[ 'evaluate' ] = 0;
            $goods_info[ 'evaluate_shaitu' ] = 0;
            $goods_info[ 'evaluate_shipin' ] = 0;
            $goods_info[ 'evaluate_zhuiping' ] = 0;
            $goods_info[ 'evaluate_haoping' ] = 0;
            $goods_info[ 'evaluate_zhongping' ] = 0;
            $goods_info[ 'evaluate_chaping' ] = 0;
            $goods_info[ 'is_fenxiao' ] = 0;
            $goods_info[ 'fenxiao_type' ] = 1;
            $goods_info[ 'supplier_id' ] = 0;
            $goods_info[ 'is_consume_discount' ] = 0;
            $goods_info[ 'discount_config' ] = 0;
            $goods_info[ 'discount_method' ] = '';
            $goods_info[ 'sku_id' ] = 0;
            $goods_info[ 'promotion_addon' ] = '';
            $goods_info[ 'virtual_sale' ] = 0;

            $new_goods_id = model("goods")->add($goods_info);

            $goods_sku_list = model("goods_sku")->getList([ [ 'goods_id', '=', $goods_id ] ], '*', 'sku_id asc');

            $sku_data = array ();

            foreach ($goods_sku_list as $k => $v) {
                unset($v[ 'sku_id' ]);
                $v[ 'goods_id' ] = $new_goods_id;
                $v[ 'sku_name' ] .= '_副本';
                $v[ 'promotion_type' ] = 0;
                $v[ 'start_time' ] = 0;
                $v[ 'end_time' ] = 0;
                $v[ 'stock' ] = 0;
                $v[ 'click_num' ] = 0;
                $v[ 'sale_num' ] = 0;
                $v[ 'collect_num' ] = 0;
                $v[ 'goods_name' ] .= '_副本';
                $v[ 'goods_state' ] = 0;
                $v[ 'create_time' ] = time();
                $v[ 'modify_time' ] = 0;
                $v[ 'evaluate' ] = 0;
                $v[ 'evaluate_shaitu' ] = 0;
                $v[ 'evaluate_shipin' ] = 0;
                $v[ 'evaluate_zhuiping' ] = 0;
                $v[ 'evaluate_haoping' ] = 0;
                $v[ 'evaluate_zhongping' ] = 0;
                $v[ 'evaluate_chaping' ] = 0;
                $v[ 'supplier_id' ] = 0;
                $v[ 'is_consume_discount' ] = 0;
                $v[ 'discount_config' ] = 0;
                $v[ 'discount_method' ] = '';
                $v[ 'member_price' ] = 0;
                $v[ 'fenxiao_price' ] = 0;
                $v[ 'virtual_sale' ] = 0;
                $sku_data[] = $v;
            }

            model('goods_sku')->addList($sku_data);

            // 赋值第一个商品sku_id
            $first_info = model('goods_sku')->getFirstData([ 'goods_id' => $new_goods_id ], 'sku_id', 'sku_id asc');
            model('goods')->update([ 'sku_id' => $first_info[ 'sku_id' ] ], [ [ 'goods_id', '=', $new_goods_id ] ]);

            if (!empty($goods_info[ 'goods_spec_format' ])) {
                // 刷新SKU商品规格项/规格值JSON字符串
                $this->dealGoodsSkuSpecFormat($new_goods_id, $goods_info[ 'goods_spec_format' ]);
            }

            model('goods')->commit();

        } catch (\Exception $e) {
            model('goods')->rollback();
            return $this->error($e->getMessage());
        }
        return $this->success($new_goods_id);
    }

    /**
     * 修改商品状态
     * @param $goods_ids
     * @param $goods_state
     * @param $site_id
     * @return array
     */
    public function modifyGoodsState($goods_ids, $goods_state, $site_id)
    {
        model('goods')->update([ 'goods_state' => $goods_state ], [ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);
        model('goods_sku')->update([ 'goods_state' => $goods_state ], [ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);
        return $this->success(1);
    }

    /**
     * 事件修改商品状态
     * @param $goods_ids
     * @param $goods_state
     * @param $site_id
     * @return array
     */
    public function cronModifyGoodsState($condition, $goods_state)
    {
        model('goods')->update([ 'goods_state' => $goods_state ], $condition);
        model('goods_sku')->update([ 'goods_state' => $goods_state ], $condition);
        return $this->success(1);
    }

    /**
     * 修改排序
     * @param $sort
     * @param $goods_id
     * @param $site_id
     * @return array
     */
    public function modifyGoodsSort($sort, $goods_id, $site_id)
    {
        model('goods')->update([ 'sort' => $sort ], [ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $site_id ] ]);
        model('goods_sku')->update([ 'sort' => $sort ], [ [ 'goods_id', '=', $goods_id ], [ 'site_id', '=', $site_id ] ]);
        return $this->success(1);
    }

    /**
     * 修改删除状态
     * @param $goods_ids
     * @param $is_delete
     * @param $site_id
     */
    public function modifyIsDelete($goods_ids, $is_delete, $site_id)
    {
        model('goods')->update([ 'is_delete' => $is_delete ], [ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);
        model('goods_sku')->update([ 'is_delete' => $is_delete ], [ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);

        //删除商品
        if ($is_delete == 1) {
            event('DeleteGoods', [ 'goods_id' => $goods_ids, 'site_id' => $site_id ]);
        }
        return $this->success(1);
    }

    /**
     * 修改商品点击量
     * @param $sku_id
     * @param $site_id
     */
    public function modifyClick($sku_id, $site_id)
    {
        model("goods_sku")->setInc([ [ 'sku_id', '=', $sku_id ], [ 'site_id', '=', $site_id ] ], 'click_num', 1);
        return $this->success(1);
    }

    /**
     * 删除回收站商品
     * @param $goods_ids
     * @param $site_id
     */
    public function deleteRecycleGoods($goods_ids, $site_id)
    {
        model('goods')->delete([ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);
        model('goods_sku')->delete([ [ 'goods_id', 'in', $goods_ids ], [ 'site_id', '=', $site_id ] ]);
        return $this->success(1);
    }

    /**
     * 获取商品信息
     * @param array $condition
     * @param string $field
     */
    public function getGoodsInfo($condition, $field = '*')
    {
        $info = model('goods')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取商品信息
     * @param array $condition
     * @param string $field
     */
    public function editGetGoodsInfo($condition, $field = '*')
    {
        $info = model('goods')->getInfo($condition, $field);
        $category_json = json_decode($info[ 'category_json' ]);
        $goods_category = [];
        foreach ($category_json as $k => $v) {
            if (!empty($v)) {
                $category_list = model('goods_category')->getList([ [ 'category_id', 'in', $v ] ], 'category_name', 'level asc');
                $category_name = array_column($category_list, 'category_name');
                $category_name = implode('/', $category_name);
                $goods_category[ $k ] = [
                    'id' => $v,
                    'category_name' => $category_name
                ];
            }
        }
        $info[ 'goods_category' ] = $goods_category;
        return $this->success($info);
    }

    /**
     * 获取商品详情
     * @param $goods_id
     * @return array
     */
    public function getGoodsDetail($goods_id)
    {
        $info = model('goods')->getInfo([ [ 'goods_id', '=', $goods_id ] ], "*");
        $field = 'sku_id, sku_name, sku_no, sku_spec_format, price, market_price, cost_price, discount_price, stock,
                  weight, volume,  sku_image, sku_images, sort,member_price,fenxiao_price';
        $sku_data = model('goods_sku')->getList([ [ 'goods_id', '=', $goods_id ] ], $field);

        if (!empty($sku_data)) {
            foreach ($sku_data as $k => $v) {
                $sku_data[ $k ][ 'member_price' ] = $v[ 'member_price' ] == '' ? '' : json_decode($v[ 'member_price' ], true);
            }
        }
        $info[ 'sku_data' ] = $sku_data;
        return $this->success($info);
    }

    /**
     * 商品sku 基础信息
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getGoodsSkuInfo($condition, $field = "sku_id,sku_name,sku_spec_format,price,market_price,discount_price,promotion_type,start_time,end_time,stock,click_num,sale_num,collect_num,sku_image,sku_images,goods_id,site_id,goods_content,goods_state,is_virtual,is_free_shipping,goods_spec_format,goods_attr_format,introduction,unit,video_url")
    {
        $info = model('goods_sku')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 商品SKU 详情
     * @param $sku_id
     * @param $site_id
     * @param string $field
     * @return array
     */
    public function getGoodsSkuDetail($sku_id, $site_id, $field = '')
    {
        if (empty($field)) {
            $field = 'gs.goods_id,gs.sku_id,gs.goods_name,gs.sku_name,gs.sku_spec_format,gs.price,gs.market_price,gs.discount_price,gs.promotion_type,gs.start_time,gs.end_time,gs.stock,gs.click_num,(g.sale_num + g.virtual_sale) as sale_num,gs.collect_num,gs.sku_image,gs.sku_images,gs.goods_id,gs.site_id,gs.goods_content,gs.goods_state,gs.is_free_shipping,gs.goods_spec_format,gs.goods_attr_format,gs.introduction,gs.unit,gs.video_url,gs.evaluate,gs.is_virtual,gs.goods_service_ids,gs.max_buy,gs.min_buy,g.goods_image';
        }
        $join = [
            [ 'goods g', 'g.goods_id = gs.goods_id', 'inner' ],
        ];
        $info = model('goods_sku')->getInfo([ [ 'gs.sku_id', '=', $sku_id ], [ 'gs.site_id', '=', $site_id ], [ 'gs.is_delete', '=', 0 ] ], $field, 'gs', $join);
        return $this->success($info);
    }

    /**
     * 获取商品列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getGoodsList($condition = [], $field = 'goods_id,goods_class,goods_class_name,goods_attr_name,goods_name,site_id,sort,goods_image,goods_content,goods_state,price,market_price,cost_price,goods_stock,goods_stock_alarm,is_virtual,is_free_shipping,shipping_template,goods_spec_format,goods_attr_format,create_time', $order = 'create_time desc', $limit = null)
    {
        $list = model('goods')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取商品分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getGoodsPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = 'goods_id,goods_name,site_id,site_name,goods_image,goods_state,price,goods_stock,goods_stock_alarm,create_time,sale_num,is_virtual,goods_class,is_fenxiao,fenxiao_type,promotion_addon,sku_id,is_consume_discount,discount_config,discount_method,sort')
    {
        $list = model('goods')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 编辑商品库存价格等信息
     * @param $goods_sku_array
     * @return array
     */
    public function editGoodsStock($goods_sku_array)
    {
        $goods_sku_model = new GoodsStock();
        model('goods')->startTrans();
        try {
            foreach ($goods_sku_array as $k => $v) {
                $sku_info = model("goods_sku")->getInfo([ [ 'sku_id', '=', $v[ 'sku_id' ] ] ], "goods_id,stock");

                if ($k == 0) {//修改商品中的价格等信息
                    $goods_data = [
                        'price' => $v[ 'price' ],
                        'market_price' => $v[ 'market_price' ],
                        'cost_price' => $v[ 'cost_price' ]
                    ];
                    model('goods')->update($goods_data, [ [ 'goods_id', '=', $sku_info[ 'goods_id' ] ] ]);
                }
                if ($v[ 'stock' ] > $sku_info[ 'stock' ]) {

                    $sku_stock_data = [
                        'sku_id' => $v[ 'sku_id' ],
                        'num' => $v[ 'stock' ] - $sku_info[ 'stock' ]
                    ];
                    $goods_sku_model->incStock($sku_stock_data);
                }
                if ($v[ 'stock' ] < $sku_info[ 'stock' ]) {
                    $sku_stock_data = [
                        'sku_id' => $v[ 'sku_id' ],
                        'num' => $sku_info[ 'stock' ] - $v[ 'stock' ]
                    ];
                    $goods_sku_model->decStock($sku_stock_data);
                }
                unset($v[ 'stock' ]);
                model('goods_sku')->update($v, [ [ 'sku_id', '=', $v[ 'sku_id' ] ] ]);
            }
            model('goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('goods')->rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * 获取商品sku列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getGoodsSkuList($condition = [], $field = 'sku_id,sku_name,price,stock,sale_num,sku_image,goods_id,goods_name,site_id,spec_name', $order = 'price asc', $limit = null)
    {
        $list = model('goods_sku')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取商品sku分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getGoodsSkuPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*', $alias = '', $join = '')
    {
        $list = model('goods_sku')->pageList($condition, $field, $order, $page, $page_size, $alias, $join);
        return $this->success($list);
    }

    /**
     * 刷新SKU商品规格项/规格值JSON字符串
     * @param int $goods_id 商品id
     * @param string $goods_spec_format 商品完整规格项/规格值json
     */
    public function dealGoodsSkuSpecFormat($goods_id, $goods_spec_format)
    {
        if (empty($goods_spec_format)) return;

        $goods_spec_format = json_decode($goods_spec_format, true);

        //根据goods_id查询sku商品列表，查询：sku_id、sku_spec_format 列
        $sku_list = model('goods_sku')->getList([ [ 'goods_id', '=', $goods_id ], [ 'sku_spec_format', '<>', '' ] ], 'sku_id,sku_spec_format', 'sku_id asc');
        if (!empty($sku_list)) {

//			$temp = 0;//测试性能，勿删

            //循环SKU商品列表
            foreach ($sku_list as $k => $v) {
//				$temp++;

                $sku_format = $goods_spec_format;//最终要存储的值
                $current_format = json_decode($v[ 'sku_spec_format' ], true);//当前SKU商品规格值json

                $selected_data = [];//已选规格/规格值json

                //1、找出已选规格/规格值json

                //循环完整商品规格json
                foreach ($sku_format as $sku_k => $sku_v) {
//					$temp++;

                    //循环当前SKU商品规格json
                    foreach ($current_format as $current_k => $current_v) {
//						$temp++;

                        //匹配规格项
                        if ($current_v[ 'spec_id' ] == $sku_v[ 'spec_id' ]) {

                            //循环规格值
                            foreach ($sku_v[ 'value' ] as $sku_value_k => $sku_value_v) {
//								$temp++;

                                //匹配规格值id
                                if ($current_v[ 'spec_value_id' ] == $sku_value_v[ 'spec_value_id' ]) {
                                    $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'selected' ] = true;
                                    $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'sku_id' ] = $v[ 'sku_id' ];
                                    $selected_data[] = $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ];
                                    break;
                                }
                            }

                        }

                    }
                }

                //2、找出未选中的规格/规格值json
                foreach ($sku_format as $sku_k => $sku_v) {
//					$temp++;

                    foreach ($sku_v[ 'value' ] as $sku_value_k => $sku_value_v) {
//						$temp++;

                        if (!isset($sku_value_v[ 'selected' ])) {

                            $refer_data = [];//参考已选中的规格/规格值json
                            $refer_data[] = $sku_value_v;

//							根据已选中的规格值进行参考
                            foreach ($selected_data as $selected_k => $selected_v) {
//								$temp++;
//								排除自身，然后进行参考
                                if ($selected_v[ 'spec_id' ] != $sku_value_v[ 'spec_id' ]) {
                                    $refer_data[] = $selected_v;
                                }
                            }

                            foreach ($sku_list as $again_k => $again_v) {
//								$temp++;

                                //排除当前SKU商品
                                if ($again_v[ 'sku_id' ] != $v[ 'sku_id' ]) {

                                    $current_format_again = json_decode($again_v[ 'sku_spec_format' ], true);
                                    $count = count($current_format_again);//规格总数量
                                    $curr_count = 0;//当前匹配规格数量

                                    //循环当前SKU商品规格json
                                    foreach ($current_format_again as $current_again_k => $current_again_v) {
//										$temp++;

                                        foreach ($refer_data as $fan_k => $fan_v) {
//											$temp++;

                                            if ($current_again_v[ 'spec_value_id' ] == $fan_v[ 'spec_value_id' ]) {
                                                $curr_count++;
                                            }
                                        }

                                    }

//									匹配数量跟规格总数一致表示匹配成功
                                    if ($curr_count == $count) {
                                        $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'selected' ] = false;
                                        $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'sku_id' ] = $again_v[ 'sku_id' ];
                                        break;
                                    }
                                }

                            }

                            //没有匹配到规格值，则禁用
                            if (!isset($sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'selected' ])) {
                                $sku_format[ $sku_k ][ 'value' ][ $sku_value_k ][ 'disabled' ] = false;
                            }

                        }
                    }
                }

//				var_dump($sku_format);
//				var_dump("=========");
                //修改ns_goods_sku表表中的goods_spec_format字段，将$sku_format值传入
                model('goods_sku')->update([ 'goods_spec_format' => json_encode($sku_format) ], [ [ 'sku_id', '=', $v[ 'sku_id' ] ] ]);

            }

//			var_dump("性能：" . $temp);

        }

    }

    /**
     * 商品推广二维码
     * @param $sku_id
     * @param $goods_name
     * @param $site_id
     * @param string $type
     * @return array
     */
    public function qrcode($sku_id, $goods_name, $site_id, $type = "create")
    {
        $data = [
            'site_id' => $site_id,
            'app_type' => "all", // all为全部
            'type' => $type, // 类型 create创建 get获取
            'data' => [
                "sku_id" => $sku_id
            ],
            'page' => '/pages/goods/detail/detail',
            'qrcode_path' => 'upload/qrcode/goods',
            'qrcode_name' => "goods_qrcode_" . $sku_id
        ];

        event('Qrcode', $data, true);
        $app_type_list = config('app_type');
        $path = [];
        foreach ($app_type_list as $k => $v) {
            switch ( $k ) {
                case 'h5':
                    $wap_domain = getH5Domain();
                    $path[ $k ][ 'status' ] = 1;
                    $path[ $k ][ 'url' ] = $wap_domain . $data[ 'page' ] . '?sku_id=' . $sku_id;
                    $path[ $k ][ 'img' ] = "upload/qrcode/goods/goods_qrcode_" . $sku_id . "_" . $k . ".png";
                    break;
                case 'weapp' :
                    $config = new ConfigModel();
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WEAPP_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信小程序';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }

                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信小程序';
                    }
                    break;

                case 'wechat' :
                    $config = new ConfigModel();
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WECHAT_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信公众号';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }
                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信公众号';
                    }
                    break;
            }

        }

        $return = [
            'path' => $path,
            'goods_name' => $goods_name,
        ];

        return $this->success($return);
    }

    /**
     * 增加商品销量
     * @param $sku_id
     * @param $num
     */
    public function incGoodsSaleNum($sku_id, $num)
    {
        $condition = array (
            [ "sku_id", "=", $sku_id ]
        );
        //增加sku销量
        $res = model("goods_sku")->setInc($condition, "sale_num", $num);
        if ($res !== false) {
            $sku_info = model("goods_sku")->getInfo($condition, "goods_id");
            $res = model("goods")->setInc([ [ "goods_id", "=", $sku_info[ "goods_id" ] ] ], "sale_num", $num);
            return $this->success($res);
        }

        return $this->error($res);
    }

    /**
     * 减少商品销量
     * @param $sku_id
     * @param $num
     */
    public function decGoodsSaleNum($sku_id, $num)
    {
        $condition = array (
            [ "sku_id", "=", $sku_id ]
        );
        //增加sku销量
        $res = model("goods_sku")->setDec($condition, "sale_num", $num);
        if ($res !== false) {
            $sku_info = model("goods_sku")->getInfo($condition, "goods_id");
            $res = model("goods")->setDec([ [ "goods_id", "=", $sku_info[ "goods_id" ] ] ], "sale_num", $num);
            return $this->success($res);
        }
        return $this->error($res);
    }

    /**
     * 修改商品分组
     * @param $label_id
     * @param $site_id
     * @param $goods_ids
     */
    public function modifyGoodsLabel($label_id, $site_id, $goods_ids)
    {
        $result = model('goods')->update([ 'label_id' => $label_id ], [
            [ 'site_id', '=', $site_id ],
            [ 'goods_id', 'in', $goods_ids ]
        ]);
        return $this->success($result);
    }

    /**
     * 修改商品分类Id
     * @param $category_id
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsCategoryId($category_id, $site_id, $goods_ids)
    {
        $category_json = json_encode($category_id);//分类字符串;
        $category_id = ',' . implode(',', $category_id) . ',';
        model('goods')->update([ 'category_id' => $category_id, 'category_json' => $category_json ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        return $this->success();
    }

    /**
     * 修改商品推荐方式
     * @param $recom_way
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsShopIntor($recom_way, $site_id, $goods_ids)
    {

        model('goods')->update([ 'recommend_way' => $recom_way ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        model('goods_sku')->update([ 'recommend_way' => $recom_way ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        return $this->success();
    }

    /**
     * 修改商品服务
     * @param $service_ids
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsService($service_ids, $site_id, $goods_ids)
    {
        model('goods')->update([ 'goods_service_ids' => $service_ids ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        model('goods_sku')->update([ 'goods_service_ids' => $service_ids ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        return $this->success();
    }

    /**
     * 修改商品虚拟销量
     * @param $sale
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsVirtualSale($sale, $site_id, $goods_ids)
    {
        model('goods')->update([ 'virtual_sale' => $sale ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        model('goods_sku')->update([ 'virtual_sale' => $sale ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        return $this->success();
    }

    /**
     * 修改商品限购
     * @param $max_buy
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsPurchaseLimit($max_buy, $site_id, $goods_ids)
    {
        model('goods')->update([ 'max_buy' => $max_buy ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        model('goods_sku')->update([ 'max_buy' => $max_buy ], [ [ 'site_id', '=', $site_id ], [ 'goods_id', 'in', $goods_ids ] ]);
        return $this->success();
    }

    /**
     * 设置商品是否包邮
     * @param $is_free_shipping
     * @param $shipping_template
     * @param $site_id
     * @param $goods_ids
     * @return array
     */
    public function modifyGoodsShippingTemplate($is_free_shipping, $shipping_template, $site_id, $goods_ids)
    {
        model('goods')->update([ 'is_free_shipping' => $is_free_shipping, 'shipping_template' => $shipping_template ], [
            [ 'site_id', '=', $site_id ],
            [ 'goods_id', 'in', $goods_ids ],
            [ 'goods_class', '=', 1 ]
        ]);
        model('goods_sku')->update([ 'is_free_shipping' => $is_free_shipping, 'shipping_template' => $shipping_template ], [
            [ 'site_id', '=', $site_id ],
            [ 'goods_id', 'in', $goods_ids ],
            [ 'goods_class', '=', 1 ]
        ]);
        return $this->success();
    }

    /**
     * 获取商品总数
     * @param array $condition
     * @return array
     */
    public function getGoodsTotalCount($condition = [])
    {
        $res = model('goods')->getCount($condition);
        return $this->success($res);
    }

    /**
     * 获取商品会员价
     * @param $sku_id
     * @param $member_id
     * @return array
     */
    public function getGoodsPrice($sku_id, $member_id)
    {
        $res = [
            'discount_price' => 0, // 折扣价（默认等于单价）
            'member_price' => 0, // 会员价
            'price' => 0 // 最低价格
        ];
        $goods_sku_info = model("goods_sku")->getInfo([ [ 'sku_id', '=', $sku_id ] ], 'is_consume_discount,discount_config,discount_method,price,member_price,discount_price');

        if (empty($goods_sku_info)) return $this->success($res);

        $res[ 'discount_price' ] = $goods_sku_info[ 'discount_price' ];
        $res[ 'price' ] = $goods_sku_info[ 'discount_price' ];

        if (!addon_is_exit("memberprice")) return $this->success($res);

        if ($goods_sku_info[ 'is_consume_discount' ]) {
            $alias = 'm';
            $join = [
                [ 'member_level ml', 'ml.level_id = m.member_level', 'inner' ],
            ];
            $member_info = model("member")->getInfo([ [ 'member_id', '=', $member_id ] ], 'm.member_level,ml.consume_discount', $alias, $join);
            if (!empty($member_info)) {
                if ($goods_sku_info[ 'discount_config' ] == 1) {
                    // 自定义优惠
                    $goods_sku_info[ 'member_price' ] = json_decode($goods_sku_info[ 'member_price' ], true);
                    $value = isset($goods_sku_info[ 'member_price' ][ $goods_sku_info[ 'discount_method' ] ][ $member_info[ 'member_level' ] ]) ? $goods_sku_info[ 'member_price' ][ $goods_sku_info[ 'discount_method' ] ][ $member_info[ 'member_level' ] ] : 0;
                    switch ( $goods_sku_info[ 'discount_method' ] ) {
                        case "discount":
                            // 打折
                            if ($value == 0) {
                                $res[ 'member_price' ] = $goods_sku_info[ 'price' ];
                            } else
                                $res[ 'member_price' ] = number_format($goods_sku_info[ 'price' ] * $value / 10, 2, '.', '');
                            break;
                        case "manjian":
                            if ($value == 0) {
                                $res[ 'member_price' ] = $goods_sku_info[ 'price' ];
                            } else
                                // 满减
                                $res[ 'member_price' ] = number_format($goods_sku_info[ 'price' ] - $value, 2, '.', '');
                            break;
                        case "fixed_price":
                            if ($value == 0) {
                                $res[ 'member_price' ] = $goods_sku_info[ 'price' ];
                            } else
                                // 指定价格
                                $res[ 'member_price' ] = number_format($value, 2, '.', '');
                            break;
                    }
                } else {
                    // 默认按会员享受折扣计算
                    $res[ 'member_price' ] = number_format($goods_sku_info[ 'price' ] * $member_info[ 'consume_discount' ] / 100, 2, '.', '');
                }
                if ($res[ 'member_price' ] < $res[ 'price' ]) {
                    $res[ 'price' ] = $res[ 'member_price' ];
                }
            }

        }
        return $this->success($res);
    }

    /**
     * 修改当前商品参与的营销活动标识，逗号分隔（限时折扣、团购、拼团、秒杀、专题活动）
     * @param $goods_id
     * @param array $promotion 营销活动标识，【promotion:value】
     * @param bool $is_delete 是否删除
     * @return array
     */
    public function modifyPromotionAddon($goods_id, $promotion = [], $is_delete = false)
    {
        $goods_info = model("goods")->getInfo([ [ 'goods_id', '=', $goods_id ] ], 'promotion_addon');
        $promotion_addon = [];
        if (!empty($goods_info[ 'promotion_addon' ])) {
            $promotion_addon = json_decode($goods_info[ 'promotion_addon' ], true);
        }
        $promotion_addon = array_merge($promotion_addon, $promotion);
        if ($is_delete) {
            foreach ($promotion as $k => $v) {
                unset($promotion_addon[ $k ]);
            }
        }
        if (!empty($promotion_addon)) {
            $promotion_addon = json_encode($promotion_addon);
        } else {
            $promotion_addon = '';
        }
        $res = model("goods")->update([ 'promotion_addon' => $promotion_addon ], [ [ 'goods_id', '=', $goods_id ] ]);
        return $this->success($res);
    }

    /**
     * 获取会员已购该商品数
     * @param $goods_id
     * @param $member_id
     * @return float
     */
    public function getGoodsPurchasedNum($goods_id, $member_id)
    {
        $join = [
            [ 'order o', 'o.order_id = og.order_id', 'left' ]
        ];
        $num = model("order_goods")->getSum([
            [ 'og.member_id', '=', $member_id ],
            [ 'og.goods_id', '=', $goods_id ],
            [ 'o.order_status', '<>', Order::ORDER_CLOSE ],
            [ 'og.refund_status', '<>', OrderRefund::REFUND_COMPLETE ]
        ], 'og.num', 'og', $join);
        return $num;
    }

    /**
     * 判断规格值是否禁用
     * @param $bargain_id
     * @param $site_id
     * @param $goods
     * @return false|string
     */
    public function getGoodsSpecFormat($sku_ids, $goods_spec_format)
    {
        if (!empty($goods_spec_format) && !empty($sku_ids)) {

            $sku_spec_format = model('goods_sku')->getColumn([ [ 'sku_id', 'in', $sku_ids ] ], 'sku_spec_format');

            $sku_spec_format_arr = [];
            foreach ($sku_spec_format as $sku_spec) {
                $format = json_decode($sku_spec, true);
                foreach ($format as $format_v) {
                    if (empty($sku_spec_format_arr[ $format_v[ 'spec_id' ] ])) {
                        $sku_spec_format_arr[ $format_v[ 'spec_id' ] ] = [];
                    }
                    $sku_spec_format_arr[ $format_v[ 'spec_id' ] ][] = $format_v[ 'spec_value_id' ];
                }
            }

            $goods_spec_format = json_decode($goods_spec_format, true);
            $count = count($goods_spec_format);
            foreach ($goods_spec_format as $k => $v) {
                foreach ($v[ 'value' ] as $key => $item) {
                    if (!in_array($item[ 'spec_value_id' ], $sku_spec_format_arr[ $item[ 'spec_id' ] ])) {
                        $v[ 'value' ][ $key ][ 'disabled' ] = true;
                    }
                }
                if ($k > 0 || $count == 1) {
                    foreach ($v[ 'value' ] as $key => $item) {
                        if (!in_array($item[ 'sku_id' ], $sku_ids)) {
                            $v[ 'value' ][ $key ][ 'disabled' ] = true;
                        }
                    }
                }
                $goods_spec_format[ $k ][ 'value' ] = $v[ 'value' ];
            }
            return $goods_spec_format;
        }
    }


    public function getEmptyGoodsSpecFormat($sku_ids, $sku_id)
    {
        if (!empty($sku_id) && !empty($sku_ids)) {

            $sku_spec_format = model('goods_sku')->getValue([ [ 'sku_id', '=', $sku_id ] ], 'sku_spec_format');
            $sku_spec_format = json_decode($sku_spec_format, true);
            $sku_spec_format = array_column($sku_spec_format, null, 'spec_id');

            $sku_array = [];
            $spec_dict = [];
            foreach ($sku_spec_format as $k => $v) {
                $spec_dict[] = $k;
            }
            $sku_spec_list = model('goods_sku')->getList([ [ 'sku_id', 'in', $sku_ids ] ], 'sku_spec_format,sku_id');
            $sku_spec_list = array_column($sku_spec_list, 'sku_spec_format', 'sku_id');
            foreach ($sku_spec_list as $sku_key => $sku_spec) {
                $format = json_decode($sku_spec, true);
                $format_column = array_column($format, null, 'spec_id');
                $key = 0;
                $num = $this->verifySkuSpec($format_column, $sku_spec_format, $key, $spec_dict);
                if (empty($sku_array)) {
                    $sku_array = array (
                        'sku_id' => $sku_key,
                        'num' => $num
                    );
                } else {
                    if ($num > $sku_array[ 'num' ]) {
                        $sku_array = array (
                            'sku_id' => $sku_key,
                            'num' => $num
                        );
                    }
                }
            }
            $temp_sku_id = $sku_array[ 'sku_id' ] ?? 0;
            return $temp_sku_id;
        }
        return 0;
    }


    public function verifySkuSpec($spec1, $spec2, $key, $spec_dict)
    {
        $real_key = $spec_dict[ $key ];
        $spec1_value = $spec1[ $real_key ];
        $spec2_value = $spec2[ $real_key ];
        $num = 0;
        if ($spec1_value[ 'spec_value_id' ] == $spec2_value[ 'spec_value_id' ]) {
            $num++;
            $key++;
            $num += $this->verifySkuSpec($spec1, $spec2, $key, $spec_dict);
        }
        return $num;

    }


}
