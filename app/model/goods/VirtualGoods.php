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

use app\model\BaseModel;
use app\model\order\OrderCommon;
use app\model\system\Cron;
use app\model\system\Stat;
use addon\discount\model\Discount;

/**
 * 虚拟商品
 */
class VirtualGoods extends BaseModel
{
    private $goods_class = array ( 'id' => 2, 'name' => '虚拟商品' );

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
                'is_virtual' => 1,
                'virtual_indate' => $data[ 'virtual_indate' ],
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
                // 刷新SKU商品规格项 / 规格值JSON字符串
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

            //添加统计
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
                'is_virtual' => 1,
                'virtual_indate' => $data[ 'virtual_indate' ],
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
                // 刷新SKU商品规格项 / 规格值JSON字符串
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
     * 获取商品信息
     * @param array $condition
     * @param string $field
     */
    public function getGoodsInfo($condition, $field = 'goods_id,goods_name,goods_class,goods_class_name,goods_attr_class,goods_attr_name,,goods_image,goods_content,goods_state,price,market_price,cost_price,goods_stock,goods_stock_alarm,goods_spec_format,goods_attr_format,introduction,keywords,unit,sort,video_url,evaluate,virtual_indate')
    {
        $info = model('goods')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取商品列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getGoodsList($condition = [], $field = 'goods_id,goods_class,goods_class_name,goods_attr_name,goods_name,site_id,,sort,goods_image,goods_content,goods_state,price,market_price,cost_price,goods_stock,goods_stock_alarm,is_virtual,goods_spec_format,goods_attr_format,create_time', $order = 'create_time desc', $limit = null)
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
    public function getGoodsPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = 'goods_id,goods_name,site_id,goods_image,goods_state,price,goods_stock,create_time,sale_num')
    {
        $list = model('goods')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取商品sku列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getGoodsSkuList($condition = [], $field = 'sku_id,sku_name,price,stock,sale_num,sku_image,goods_id,goods_name,site_id,spec_name', $order = 'create_time desc', $limit = null)
    {
        $list = model('goods_sku')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 刷新SKU商品规格项/规格值JSON字符串
     * @param int $goods_id 商品id
     * @param string $goods_spec_format 商品完整规格项/规格值json
     */
    private function dealGoodsSkuSpecFormat($goods_id, $goods_spec_format)
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

    /************************************************************************* 购买的虚拟产品 start *******************************************************************/
    /**
     * 生成购买的虚拟产品
     * @param $site_id
     * @param $order_id
     * @param $order_no
     * @param $sku_id
     * @param $sku_name
     * @param $code
     * @param $member_id
     * @param $sku_image
     */
    public function addGoodsVirtual($site_id, $order_id, $order_no, $sku_id, $sku_name, $code, $member_id, $sku_image)
    {
        $data = array (
            "site_id" => $site_id,
            "order_id" => $order_id,
            "order_no" => $order_no,
            "sku_id" => $sku_id,
            "sku_name" => $sku_name,
            "code" => $code,
            "member_id" => $member_id,
            'sku_image' => $sku_image
        );
        $res = model("goods_virtual")->add($data);
        return $this->success($res);
    }

    /**
     * 删除
     * @param $condition
     */
    public function deleteGoodsVirtual($condition)
    {
        $res = model("goods_virtual")->delete($condition);
        if ($res === false)
            return $this->error();

        return $this->success();
    }

    /**
     * 核销虚拟商品
     * @param $code
     */
    public function verify($code)
    {
        $goods_virtual_info = model("goods_virtual")->getInfo([ [ "code", '=', $code ], [ "is_veirfy", "=", 0 ] ]);
        if (empty($goods_virtual_info))
            return $this->error();//虚拟商品不存在或已核销

        $order_common_model = new OrderCommon();
        $local_result = $order_common_model->verifyOrderLock($goods_virtual_info[ 'order_id' ]);
        if ($local_result[ "code" ] < 0)
            return $local_result;

        $data = array (
            "is_veirfy" => 1,
            "verify_time" => time()
        );
        $res = model("goods_virtual")->update($data, [ [ "code", '=', $code ], [ "is_veirfy", "=", 0 ] ]);

        return $this->success($res);
    }


    /**
     * 虚拟商品详情
     * @param $condition
     */
    public function getVirtualGoodsInfo($condition, $field = "*")
    {
        $info = model('goods_virtual')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取虚拟商品分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getVirtualGoodsPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc', $field = '*')
    {
        $list = model('goods_virtual')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }
    /************************************************************************* 购买的虚拟产品 end *******************************************************************/
}