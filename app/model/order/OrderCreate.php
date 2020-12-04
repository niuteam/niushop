<?php

/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\order;

use addon\coupon\model\Coupon;
use addon\freeshipping\model\Freeshipping;
use addon\manjian\model\Manjian;
use app\model\express\Local;
use app\model\goods\Goods;
use app\model\goods\GoodsStock;
use app\model\member\Member;
use app\model\member\MemberAccount;
use app\model\member\MemberLevel;
use app\model\store\Store;
use app\model\system\Cron;
use think\facade\Cache;
use app\model\express\Express;
use app\model\system\Pay;
use app\model\goods\Cart;
use app\model\member\MemberAddress;
use app\model\express\Config as ExpressConfig;
use app\model\BaseModel;
use app\model\message\Message;
use addon\pointcash\model\Config as PointCashConfig;

/**
 * 订单创建(普通订单)
 *
 * @author Administrator
 *
 */
class OrderCreate extends BaseModel
{

    private $goods_money = 0; //商品金额
    private $delivery_money = 0; //配送费用
    private $coupon_money = 0; //优惠券金额
    private $adjust_money = 0; //调整金额
    private $invoice_money = 0; //发票费用
    private $promotion_money = 0; //优惠金额
    private $order_money = 0; //订单金额
    private $pay_money = 0; //支付总价
    private $is_virtual = 0;  //是否是虚拟类订单
    private $order_name = '';  //订单详情
    private $goods_num = 0;  //商品种数
    private $error = 0;  //是否有错误
    private $error_msg = '';  //错误描述
    private $pay_type = 'ONLINE_PAY';
    private $invoice_delivery_money = 0;
    private $balance_money = 0;
    private $member_balance_money = 0; //会员账户余额(计算过程中会逐次减少)
    private $point_money = 0; // 积分抵现金额

    /**
     * 订单创建
     * @param unknown $data
     */
    public function create($data)
    {
        //查询出会员相关信息
        $calculate_data = $this->calculate($data);
        if (isset($calculate_data[ 'code' ]) && $calculate_data[ 'code' ] < 0)
            return $calculate_data;

        if ($this->error > 0) {
            return $this->error([ 'error_code' => $this->error ], $this->error_msg);
        }
        $pay = new Pay();
        $out_trade_no = $pay->createOutTradeNo($data[ 'member_id' ]);
        model("order")->startTrans();
        //循环生成多个订单
        try {

            $pay_money = 0;
            $goods_stock_model = new GoodsStock();
            $order_item = $calculate_data[ 'shop_goods_list' ]; //订单数据主体


            $item_delivery = $order_item[ 'delivery' ] ?? [];
            $delivery_type = $item_delivery[ 'delivery_type' ] ?? '';
            $delivery_type_name = Express::express_type[ $delivery_type ][ "title" ] ?? '';

            //订单主表
            $order_type = $this->orderType($order_item, $calculate_data);
            $order_no = $this->createOrderNo($order_item[ 'site_id' ], $data[ 'member_id' ]);
            $data_order = [
                'order_no' => $order_no,
                'site_id' => $order_item[ 'site_id' ],
                'site_name' => $order_item[ 'site_name' ],
                'order_from' => $data[ 'order_from' ],
                'order_from_name' => $data[ 'order_from_name' ],
                'order_type' => $order_type[ 'order_type_id' ],
                'order_type_name' => $order_type[ 'order_type_name' ],
                'order_status_name' => $order_type[ 'order_status' ][ 'name' ],
                'order_status_action' => json_encode($order_type[ 'order_status' ], JSON_UNESCAPED_UNICODE),
                'out_trade_no' => $out_trade_no,
                'member_id' => $data[ 'member_id' ],
                'name' => $calculate_data[ 'member_address' ][ 'name' ] ?? '',
                'mobile' => $calculate_data[ 'member_address' ][ 'mobile' ] ?? '',
                'telephone' => $calculate_data[ 'member_address' ][ 'telephone' ] ?? '',
                'province_id' => $calculate_data[ 'member_address' ][ 'province_id' ] ?? '',
                'city_id' => $calculate_data[ 'member_address' ][ 'city_id' ] ?? '',
                'district_id' => $calculate_data[ 'member_address' ][ 'district_id' ] ?? '',
                'community_id' => $calculate_data[ 'member_address' ][ 'community_id' ] ?? '',
                'address' => $calculate_data[ 'member_address' ][ 'address' ] ?? '',
                'full_address' => $calculate_data[ 'member_address' ][ 'full_address' ] ?? '',
                'longitude' => $calculate_data[ 'member_address' ][ 'longitude' ] ?? '',
                'latitude' => $calculate_data[ 'member_address' ][ 'latitude' ] ?? '',
                'buyer_ip' => request()->ip(),
                'goods_money' => $order_item[ 'goods_money' ],
                'delivery_money' => $order_item[ 'delivery_money' ],
                'coupon_id' => $order_item[ 'coupon_id' ] ?? 0,
                'coupon_money' => $order_item[ 'coupon_money' ] ?? 0,
                'adjust_money' => $order_item[ 'adjust_money' ],
                'invoice_money' => $order_item[ 'invoice_money' ],
                'promotion_money' => $order_item[ 'promotion_money' ],
                'order_money' => $order_item[ 'order_money' ],
                'balance_money' => $order_item[ 'balance_money' ],
                'point_money' => $calculate_data[ 'point_money' ],
                'pay_money' => $order_item[ 'pay_money' ],
                'create_time' => time(),
                'is_enable_refund' => 0,
                'order_name' => $order_item[ "order_name" ],
                'goods_num' => $order_item[ 'goods_num' ],
                'delivery_type' => $delivery_type,
                'delivery_type_name' => $delivery_type_name,
                'delivery_store_id' => $order_item[ "delivery_store_id" ] ?? 0,
                "delivery_store_name" => $order_item[ "delivery_store_name" ] ?? '',
                "delivery_store_info" => $order_item[ "delivery_store_info" ] ?? '',
                "buyer_message" => $order_item[ "buyer_message" ],

                "invoice_delivery_money" => $order_item[ "invoice_delivery_money" ] ?? 0,
                "taxpayer_number" => $order_item[ "taxpayer_number" ] ?? '',
                "invoice_rate" => $order_item[ "invoice_rate" ] ?? 0,
                "invoice_content" => $order_item[ "invoice_content" ] ?? '',
                "invoice_full_address" => $order_item[ "invoice_full_address" ] ?? '',
                "is_invoice" => $order_item[ "is_invoice" ] ?? 0,
                "invoice_type" => $order_item[ "invoice_type" ] ?? 0,
                "invoice_title" => $order_item[ "invoice_title" ] ?? '',
                'is_tax_invoice' => $order_item[ "is_tax_invoice" ] ?? '',
                'invoice_email' => $order_item[ "invoice_email" ] ?? '',
                'invoice_title_type' => $order_item[ "invoice_title_type" ] ?? 0,
                'buyer_ask_delivery_time' => $order_item[ 'buyer_ask_delivery_time' ] ?? '',//定时达
            ];

            $order_id = model("order")->add($data_order);

            $pay_money += $order_item[ 'pay_money' ];
            //订单项目表
            foreach ($order_item[ 'goods_list' ] as $k_order_goods => $order_goods) {
                $data_order_goods = array (
                    'order_id' => $order_id,
                    'site_id' => $order_item[ 'site_id' ],
                    'order_no' => $order_no,
                    'member_id' => $data[ 'member_id' ],
                    'sku_id' => $order_goods[ 'sku_id' ],
                    'sku_name' => $order_goods[ 'sku_name' ],
                    'sku_image' => $order_goods[ 'sku_image' ],
                    'sku_no' => $order_goods[ 'sku_no' ],
                    'is_virtual' => $order_goods[ 'is_virtual' ],
                    'goods_class' => $order_goods[ 'goods_class' ],
                    'goods_class_name' => $order_goods[ 'goods_class_name' ],
                    'price' => $order_goods[ 'price' ],
                    'cost_price' => $order_goods[ 'cost_price' ],
                    'num' => $order_goods[ 'num' ],
                    'goods_money' => $order_goods[ 'goods_money' ],
                    'cost_money' => $order_goods[ 'cost_price' ] * $order_goods[ 'num' ],
                    'goods_id' => $order_goods[ 'goods_id' ],
                    'delivery_status' => 0,
                    'delivery_status_name' => "未发货",
                    "real_goods_money" => $order_goods[ "real_goods_money" ],
                    'coupon_money' => $order_goods[ "coupon_money" ],
                    'promotion_money' => $order_goods[ "promotion_money" ],

                    'goods_name' => $order_goods[ 'goods_name' ],
                    'sku_spec_format' => $order_goods[ 'sku_spec_format' ],
                    'use_point' => $order_goods[ 'use_point' ] ?? 0,
                    'point_money' => $order_goods[ 'point_money' ] ?? 0.00
                );
                model("order_goods")->add($data_order_goods);

            }

            //todo  满减送
            if (!empty($order_item[ 'manjian_rule_list' ])) {
                $mansong_data = [];
                foreach ($order_item[ 'manjian_rule_list' ] as $item) {
                    // 检测是否有赠送内容
                    if (isset($item[ 'rule' ][ 'point' ]) || isset($item[ 'rule' ][ 'coupon' ])) {
                        array_push($mansong_data, [
                            'manjian_id' => $item[ 'manjian_info' ][ 'manjian_id' ],
                            'site_id' => $order_item[ 'site_id' ],
                            'manjian_name' => $item[ 'manjian_info' ][ 'manjian_name' ],
                            'point' => isset($item[ 'rule' ][ 'point' ]) ? number_format($item[ 'rule' ][ 'point' ]) : 0,
                            'coupon' => $item[ 'rule' ][ 'coupon' ] ?? 0,
                            'order_id' => $order_id,
                            'member_id' => $data[ 'member_id' ],
                            'order_sku_ids' => !empty($item[ 'sku_ids' ]) ? implode($item[ 'sku_ids' ]) : '',
                        ]);
                    }
                }
                if (!empty($mansong_data)) {
                    model('promotion_mansong_record')->addList($mansong_data);
                }
            }

            //todo   优惠券(新)
            //优惠券
            if ($data_order[ 'coupon_id' ] > 0 && $data_order[ 'coupon_money' ] > 0) {
                //优惠券处理方案
                $member_coupon_model = new Coupon();
                $coupon_use_result = $member_coupon_model->useCoupon($data_order[ 'coupon_id' ], $data[ 'member_id' ], $order_id); //使用优惠券
                if ($coupon_use_result[ 'code' ] < 0) {
                    model("order")->rollback();
                    return $this->error('', "COUPON_ERROR");
                }
            }

            //扣除余额(统一扣除)
            if ($calculate_data[ "balance_money" ] > 0) {
                $balance_result = $this->useBalance($calculate_data, $order_item[ 'site_id' ]);
                if ($balance_result[ "code" ] < 0) {
                    model("order")->rollback();
                    return $balance_result;
                }
            }
            // 扣除抵现积分
            if ($calculate_data[ 'is_point' ] && $calculate_data[ 'shop_goods_list' ][ 'max_usable_point' ] > 0) {
                $member_account_model = new MemberAccount();
                $point_result = $member_account_model->addMemberAccount($calculate_data[ 'site_id' ], $calculate_data[ 'member_id' ], 'point', -$calculate_data[ 'shop_goods_list' ][ 'max_usable_point' ], 'pointcash', $order_id, "积分抵现扣除积分");
                if ($point_result[ "code" ] < 0) {
                    model("order")->rollback();
                    return $point_result;
                }
            }

            //订单生成后操作
            $result_list = event("OrderCreate", [ 'order_id' => $order_id ]);

            if (!empty($result_list)) {
                foreach ($result_list as $k => $v) {
                    if (!empty($v) && $v[ "code" ] < 0) {
                        model("order")->rollback();
                        return $v;
                    }
                }
            }

            //生成整体付费支付单据
            $pay->addPay($calculate_data[ "site_id" ], $out_trade_no, $this->pay_type, $this->order_name, $this->order_name, $this->pay_money, '', 'OrderPayNotify', '');
            $this->addOrderCronClose($order_id, $data[ "site_id" ]); //增加关闭订单自动事件
            Cache::tag("order_create_member_" . $data[ 'member_id' ])->clear();
            $cart_ids = $data[ 'cart_ids' ] ?? '';
            if (!empty($cart_ids)) {
                $cart = new Cart();
                $data_cart = [
                    'cart_id' => $cart_ids,
                    'member_id' => $data[ 'member_id' ]
                ];
                $cart->deleteCart($data_cart);
            }
            //库存处理
            foreach ($order_item[ 'goods_list' ] as $k_order_goods => $order_goods) {
                //库存变化
                $stock_result = $goods_stock_model->decStock([ "sku_id" => $order_goods[ 'sku_id' ], "num" => $order_goods[ 'num' ] ]);
                if ($stock_result[ "code" ] != 0) {
                    model("order")->rollback();
                    return $stock_result;
                }
            }
            model("order")->commit();
            //订单生成的消息
            $message_model = new Message();
            $message_model->sendMessage([ 'keywords' => "ORDER_CREATE", 'order_id' => $order_id, 'site_id' => $calculate_data[ 'site_id' ] ]);
            return $this->success($out_trade_no);
        } catch (\Exception $e) {
            model("order")->rollback();
            return $this->error('', $e->getMessage() . $e->getFile() . $e->getLine());
        }
    }

    /**
     * 生成订单编号
     *
     * @param array $site_id
     */
    public function createOrderNo($site_id, $member_id = 0)
    {
        $time_str = date('YmdHi');
        $max_no = Cache::get($site_id . "_" . $member_id . "_" . $time_str);
        if (!isset($max_no) || empty($max_no)) {
            $max_no = 1;
        } else {
            $max_no = $max_no + 1;
        }
        $order_no = $time_str . $member_id . sprintf("%03d", $max_no);
        Cache::set($site_id . "_" . $member_id . "_" . $time_str, $max_no);
        return $order_no;
    }

    /**
     * 订单类型判断
     * @param unknown $shop_goods
     */
    public function orderType($shop_goods, $data)
    {
        if ($data[ "is_virtual" ] == 1) {
            $order = new VirtualOrder();
            return [
                'order_type_id' => 4,
                'order_type_name' => '虚拟订单',
                'order_status' => $order->order_status[ 0 ]
            ];
        } else {
            if ($shop_goods[ 'delivery' ][ 'delivery_type' ] == 'express') {
                $order = new Order();
                return [
                    'order_type_id' => 1,
                    'order_type_name' => '普通订单',
                    'order_status' => $order->order_status[ 0 ]
                ];
            } elseif ($shop_goods[ 'delivery' ][ 'delivery_type' ] == 'store') {
                $order = new StoreOrder();
                return [
                    'order_type_id' => 2,
                    'order_type_name' => '自提订单',
                    'order_status' => $order->order_status[ 0 ]
                ];
            } elseif ($shop_goods[ 'delivery' ][ 'delivery_type' ] == 'local') {
                $order = new LocalOrder();
                return [
                    'order_type_id' => 3,
                    'order_type_name' => '外卖订单',
                    'order_status' => $order->order_status[ 0 ]
                ];
            }
        }
    }

    /**
     * 订单计算
     * @param unknown $data
     */
    public function calculate($data)
    {
        $data = $this->initMemberAddress($data); //初始化地址
        $data = $this->initMemberAccount($data); //初始化会员账户

        //余额付款
        if ($data[ 'is_balance' ] > 0) {
            $this->member_balance_money = $data[ "member_account" ][ "balance_total" ] ?? 0;
        }
        //传输购物车id组合','隔开要进行拆单
        if (!empty($data[ 'cart_ids' ])) {
            //商品列表信息
            $shop_goods_list = $this->getOrderGoodsCalculate($data);
            $data[ 'shop_goods_list' ] = $this->shopOrderCalculate($shop_goods_list, $data);
        } else {
            //商品列表信息
            $shop_goods_list = $this->getOrderGoodsCalculate($data);
            //判断是否是虚拟订单
            if ($shop_goods_list[ 'goods_list' ][ 0 ][ 'is_virtual' ]) {
                $this->is_virtual = 1;
            } else {
                $this->is_virtual = 0;
            }
            $data[ 'shop_goods_list' ] = $this->shopOrderCalculate($shop_goods_list, $data);
        }

        // 商品限购判断
        foreach ($shop_goods_list[ 'limit_purchase' ] as $item) {
            if ($item[ 'min_buy' ] > 0 && $item[ 'num' ] < $item[ 'min_buy' ]) {
                $this->error = 1;
                $this->error_msg = "商品“{$item['goods_name']}”{$item['min_buy']}件起售";
                break;
            }
            if ($item[ 'max_buy' ] > 0) {
                $goods_model = new Goods();
                $purchased_num = $goods_model->getGoodsPurchasedNum($item[ 'goods_id' ], $data[ 'member_id' ]);
                if (( $purchased_num + $item[ 'num' ] ) > $item[ 'max_buy' ]) {
                    $this->error = 1;
                    $this->error_msg = "商品“{$item['goods_name']}”每人限购{$item['max_buy']}件，您已购买{$purchased_num}件";
                    break;
                }
            }
        }

        //总结计算
        $data[ 'delivery_money' ] = $this->delivery_money;
        $data[ 'coupon_money' ] = $this->coupon_money;
        $data[ 'adjust_money' ] = $this->adjust_money;
        $data[ 'invoice_money' ] = $this->invoice_money;
        $data[ 'invoice_delivery_money' ] = $this->invoice_delivery_money;
        $data[ 'promotion_money' ] = $this->promotion_money;
        $data[ 'order_money' ] = $this->order_money;
        $data[ 'balance_money' ] = $this->balance_money;
        $data[ 'pay_money' ] = $this->pay_money;
        $data[ 'goods_money' ] = $this->goods_money;
        $data[ 'goods_num' ] = $this->goods_num;
        $data[ 'is_virtual' ] = $this->is_virtual;
        $data[ 'point_money' ] = $this->point_money;
        return $data;
    }

    /**
     * 待付款订单
     * @param unknown $data
     */
    public function orderPayment($data)
    {

        $calculate_data = $this->calculate($data);

        //1、查询会员优惠券
        $coupon_list = $this->getOrderCouponList($calculate_data);
        $calculate_data[ 'shop_goods_list' ][ "coupon_list" ] = $coupon_list;
        $express_type = [];
        if ($this->is_virtual == 0) {

            //2. 查询店铺配送方式（1. 物流  2. 自提  3. 外卖）
            if ($calculate_data[ 'shop_goods_list' ][ "express_config" ][ "is_use" ] == 1) {
                $express_type[] = [ "title" => Express::express_type[ "express" ][ "title" ], "name" => "express" ];
            }
            //查询店铺是否开启门店自提
            if ($calculate_data[ 'shop_goods_list' ][ "store_config" ][ "is_use" ] == 1) {
                //根据坐标查询门店
                $store_model = new Store();
                $store_condition = array (
                    [ 'site_id', '=', $data[ 'site_id' ] ],
                    [ 'is_pickup', '=', 1 ],
                    [ 'status', '=', 1 ],
                    [ 'is_frozen', '=', 0 ],
                );


                $latlng = array (
                    'lat' => $data[ 'latitude' ],
                    'lng' => $data[ 'longitude' ],
                );
                $store_list_result = $store_model->getLocationStoreList($store_condition, '*', $latlng);
                $store_list = $store_list_result[ "data" ];


                //如果用户默认选中了门店
                $store_id = 0;
                if ($data[ 'default_store_id' ] > 0) {
                    if (!empty($store_list)) {
                        $store_array = array_column($store_list, 'store_id');
                        if (in_array($data[ 'default_store_id' ], $store_array)) {
                            $store_id = $data[ 'default_store_id' ];
                        } else {
                            $store_condition = array (
                                [ 'site_id', '=', $data[ 'site_id' ] ],
                                [ 'is_pickup', '=', 1 ],
                                [ 'status', '=', 1 ],
                                [ 'is_frozen', '=', 0 ],
                                [ 'store_id', '=', $data[ 'default_store_id' ] ],
                            );
                            $store_info_result = $store_model->getStoreInfo($store_condition, '*');
                            $store_info = $store_info_result[ 'data' ];
                            if (!empty($store_info)) {
                                $store_id = $data[ 'default_store_id' ];
                                $store_list[] = $store_info;
                            }
                        }
                    }
                }
                $express_type[] = [ "title" => Express::express_type[ "store" ][ "title" ], "name" => "store", "store_list" => $store_list, 'store_id' => $store_id ];
            }
            //查询店铺是否开启外卖配送
            if ($calculate_data[ 'shop_goods_list' ][ "local_config" ][ "is_use" ] == 1) {
                //查询本店的通讯地址
                $express_type[] = [ "title" => "外卖配送", "name" => "local" ];
            }
        }

        $calculate_data[ 'shop_goods_list' ][ "express_type" ] = $express_type;

        return $calculate_data;
    }

    public function expressPayment()
    {
    }

    /**
     * 初始化收货地址
     * @param unknown $data
     */
    public function initMemberAddress($data)
    {
        $delivery_type = $data[ 'delivery' ][ "delivery_type" ] ?? '';
        if (empty($data[ 'member_address' ])) {
            $member_address = new MemberAddress();
            $type = 1;
            if ($delivery_type == 'local') {
                $type = 2;
            }
            $address = $member_address->getMemberAddressInfo([ [ 'member_id', '=', $data[ 'member_id' ] ], [ 'is_default', '=', 1 ], [ 'type', '=', $type ] ]);
            $data[ 'member_address' ] = $address[ 'data' ];
        }

        if (!empty($data[ 'member_address' ])) {
            if ($delivery_type == 'local') {
                //外卖订单 如果收货地址没有定位的话,就不取用地址
                $type = $data[ 'member_address' ][ 'type' ] ?? 1;
                if ($type == 1) {
                    $data[ 'member_address' ] = '';
                }
            }
        }

        return $data;
    }

    /**
     * 获取商品的计算信息
     * @param unknown $data
     */
    public function getOrderGoodsCalculate($data)
    {
        $shop_goods_list = [];
        //传输购物车id组合','隔开要进行拆单
        if (!empty($data[ 'cart_ids' ])) {
            //            $cache = Cache::get("order_create_cart_".$data['cart_ids'].'_'.$data['member_id']);
            //            if(!empty($cache))
            //            {
            //                return $cache;
            //            }
            $shop_goods = $this->getCartGoodsList($data[ 'cart_ids' ], $data[ 'member_id' ], $data[ "site_id" ]);
            //todo  验证商品是否是当前site_id
            //todo  验证商品是否是当前site_id

            $shop_goods[ 'promotion_money' ] = 0;

            $shop_goods_list = $shop_goods;

            //            Cache::tag("order_create_member_".$data['member_id'])->set("order_create_cart_".$data['cart_ids'].'_'.$data['member_id'], $shop_goods_list, 600);

        } else {
            //            $cache = Cache::get("order_create_".$data['sku_id'].'_'.$data['num'].'_'.$data['member_id']);
            //            if(!empty($cache))
            //            {
            //                return $cache;
            //            }
            $shop_goods = $this->getShopGoodsList($data);
            $shop_goods[ 'promotion_money' ] = 0;


            $shop_goods_list = $shop_goods;
            //            Cache::tag("order_create_member_".$data['member_id'])->set("order_create_".$data['sku_id'].'_'.$data['num'].'_'.$data['member_id'], $shop_goods_list, 600);
        }
        //满减优惠
        $shop_goods_list = $this->manjianPromotion($shop_goods_list);

        return $shop_goods_list;
    }

    /**
     * 获取购物车商品列表信息
     * @param unknown $cart_ids
     */
    public function getCartGoodsList($cart_ids, $member_id, $site_id)
    {
        $goods_model = new Goods();
        //组装商品列表
        $field = ' ngc.member_id, ngc.sku_id, ngc.num, ngs.sku_name, ngs.sku_no,
            ngs.price, ngs.discount_price, ngs.cost_price, ngs.stock, ngs.weight, ngs.volume, ngs.sku_image, 
            ngs.site_id, ngs.goods_state, ngs.is_virtual, 
            ngs.is_free_shipping, ngs.shipping_template, ngs.goods_class, ngs.goods_class_name, ngs.goods_id,ns.site_name,ngs.sku_spec_format,ngs.goods_name,ngs.max_buy,ngs.min_buy';
        $alias = 'ngc';
        $join = [
            [
                'goods_sku ngs',
                'ngc.sku_id = ngs.sku_id',
                'inner'
            ],
            [
                'site ns',
                'ngc.site_id = ns.site_id',
                'inner'
            ]
        ];
        $goods_list = model("goods_cart")->getList([ [ 'cart_id', 'in', $cart_ids ], [ 'member_id', '=', $member_id ] ], $field, '', $alias, $join);
        $shop_goods_list = [];
        if (!empty($goods_list)) {
            foreach ($goods_list as $k => $v) {

                if ($v[ "site_id" ] != $site_id) {
                    return $this->error([], "不存在的商品!");
                }
                $price_result = $goods_model->getGoodsPrice($v[ 'sku_id' ], $member_id);
                $price_info = $price_result[ "data" ];
                $price = $price_info[ "price" ];
                $v[ 'price' ] = $price;
                $v[ 'goods_money' ] = $price * $v[ 'num' ];
                $v[ 'real_goods_money' ] = $v[ 'goods_money' ];
                $v[ 'coupon_money' ] = 0; //优惠券金额
                $v[ 'promotion_money' ] = 0; //优惠金额
                if (!empty($shop_goods_list)) {
                    $shop_goods_list[ 'goods_list' ][] = $v;
                    $shop_goods_list[ 'order_name' ] = string_split($shop_goods_list[ 'order_name' ], ",", $v[ 'sku_name' ]);
                    $shop_goods_list[ 'goods_num' ] += $v[ 'num' ];
                    $shop_goods_list[ 'goods_money' ] += $v[ 'goods_money' ];

                    $shop_goods_list[ 'goods_list_str' ] = $shop_goods_list[ 'goods_list_str' ] . ';' . $v[ 'sku_id' ] . ':' . $v[ 'num' ];
                    // 商品限购处理
                    if (isset($shop_goods_list[ 'limit_purchase' ][ 'goods_' . $v[ 'goods_id' ] ])) {
                        $shop_goods_list[ 'limit_purchase' ][ 'goods_' . $v[ 'goods_id' ] ][ 'num' ] += $v[ 'num' ];
                    } else {
                        $shop_goods_list[ 'limit_purchase' ][ 'goods_' . $v[ 'goods_id' ] ] = [
                            'goods_id' => $v[ 'goods_id' ],
                            'goods_name' => $v[ 'sku_name' ],
                            'num' => $v[ 'num' ],
                            'max_buy' => $v[ 'max_buy' ],
                            'min_buy' => $v[ 'min_buy' ]
                        ];
                    }
                } else {
                    $shop_goods_list[ 'site_id' ] = $site_id;
                    $shop_goods_list[ 'site_name' ] = $v[ 'site_name' ];
                    $shop_goods_list[ 'goods_money' ] = $v[ 'goods_money' ];
                    $shop_goods_list[ 'goods_list_str' ] = $v[ 'sku_id' ] . ':' . $v[ 'num' ];
                    $shop_goods_list[ 'order_name' ] = string_split("", ",", $v[ 'sku_name' ]);
                    $shop_goods_list[ 'goods_num' ] = $v[ 'num' ];
                    $shop_goods_list[ 'goods_list' ][] = $v;
                    // 商品限购处理
                    $shop_goods_list[ 'limit_purchase' ][ 'goods_' . $v[ 'goods_id' ] ] = [
                        'goods_id' => $v[ 'goods_id' ],
                        'goods_name' => $v[ 'sku_name' ],
                        'num' => $v[ 'num' ],
                        'max_buy' => $v[ 'max_buy' ],
                        'min_buy' => $v[ 'min_buy' ]
                    ];
                }
            }
        }
        return $shop_goods_list;
    }

    /**
     * 获取立即购买商品信息
     * @param unknown $data
     * @return multitype:string number unknown mixed
     */
    public function getShopGoodsList($data)
    {
        $join = [
            [
                'site ns',
                'ngs.site_id = ns.site_id',
                'inner'
            ]
        ];
        $field = 'sku_id, sku_name, sku_no, price, discount_price,cost_price, stock, volume, weight, sku_image, ngs.site_id, goods_state, is_virtual, is_free_shipping, shipping_template,goods_class, goods_class_name, goods_id, ns.site_name,sku_spec_format,goods_name,max_buy,min_buy';
        $sku_info = model("goods_sku")->getInfo([ [ 'sku_id', '=', $data[ 'sku_id' ] ], [ "ngs.site_id", "=", $data[ "site_id" ] ] ], $field, 'ngs', $join);
        if (empty($sku_info)) {
            return $this->error([], "不存在的商品!");
        }
        $goods_model = new Goods();
        $price_result = $goods_model->getGoodsPrice($data[ 'sku_id' ], $data[ 'member_id' ]);
        $price_info = $price_result[ "data" ];
        $price = $price_info[ "price" ];

        $sku_info[ 'num' ] = $data[ 'num' ];
        $goods_money = $price * $data[ 'num' ];
        $sku_info[ 'price' ] = $price;
        $sku_info[ 'goods_money' ] = $goods_money;
        $sku_info[ 'real_goods_money' ] = $goods_money;
        $sku_info[ 'coupon_money' ] = 0; //优惠券金额
        $sku_info[ 'promotion_money' ] = 0; //优惠金额
        $goods_list[] = $sku_info;
        $shop_goods = [
            'goods_money' => $goods_money,
            'site_id' => $sku_info[ 'site_id' ],
            'site_name' => $sku_info[ 'site_name' ],
            'goods_list_str' => $sku_info[ 'sku_id' ] . ':' . $sku_info[ 'num' ],
            'goods_list' => $goods_list,
            'order_name' => $sku_info[ "sku_name" ],
            'goods_num' => $sku_info[ 'num' ],
            'limit_purchase' => [
                'goods_' . $sku_info[ 'goods_id' ] => [
                    'goods_id' => $sku_info[ 'goods_id' ],
                    'goods_name' => $sku_info[ "sku_name" ],
                    'num' => $sku_info[ 'num' ],
                    'max_buy' => $sku_info[ 'max_buy' ],
                    'min_buy' => $sku_info[ 'min_buy' ]
                ]
            ]
        ];
        return $shop_goods;
    }

    /**
     * 获取店铺订单计算
     * @param unknown $site_id 店铺id
     * @param unknown $goods_money 商品总价
     * @param unknown $goods_list 店铺商品列表
     * @param unknown $data 传输生成订单数据
     */
    public function shopOrderCalculate($shop_goods, $data)
    {
        $site_id = $data[ 'site_id' ];

        //交易配置
        $config_model = new Config();
        $order_config_result = $config_model->getOrderEventTimeConfig($site_id);
        $order_config = $order_config_result[ "data" ];
        $shop_goods[ 'order_config' ] = $order_config[ 'value' ] ?? [];


        //定义计算金额
        $goods_money = $shop_goods[ 'goods_money' ];  //商品金额
        $delivery_money = 0;  //配送费用
        $promotion_money = $shop_goods[ 'promotion_money' ];  //优惠费用（满减）
        $coupon_money = 0;     //优惠券费用
        $adjust_money = 0;     //调整金额
        $invoice_money = 0;    //发票金额
        $order_money = 0;      //订单金额
        $balance_money = 0;    //会员余额
        $pay_money = 0;        //应付金额

        //计算邮费
        if ($this->is_virtual == 1) {
            //虚拟订单  运费为0
            $delivery_money = 0;
            $shop_goods[ 'delivery' ][ 'delivery_type' ] = '';
        } else {

            //查询店铺是否开启快递配送
            $express_config_model = new ExpressConfig();
            $express_config_result = $express_config_model->getExpressConfig($site_id);
            $express_config = $express_config_result[ "data" ];
            $shop_goods[ "express_config" ] = $express_config;
            //查询店铺是否开启门店自提
            $store_config_result = $express_config_model->getStoreConfig($site_id);
            $store_config = $store_config_result[ "data" ];
            $shop_goods[ "store_config" ] = $store_config;
            //查询店铺是否开启外卖配送
            $local_config_result = $express_config_model->getLocalDeliveryConfig($site_id);
            $local_config = $local_config_result[ "data" ];
            $shop_goods[ "local_config" ] = $local_config;
            //如果本地配送开启, 则查询出本地配送的配置
            if ($shop_goods[ "local_config" ][ 'is_use' ] == 1) {
                $local_model = new Local();
                $local_info_result = $local_model->getLocalInfo([ [ 'site_id', '=', $site_id ] ]);
                $local_info = $local_info_result[ 'data' ];
                $shop_goods[ "local_config" ][ 'info' ] = $local_info;
            }

            $delivery_array = $data[ 'delivery' ] ?? [];
            $delivery_type = $delivery_array[ "delivery_type" ] ?? 'express';
            if ($delivery_type == "store") {
                if (isset($data[ 'delivery' ][ "delivery_type" ]) && $data[ 'delivery' ][ "delivery_type" ] == "store") {
                    //门店自提
                    $delivery_money = 0;
                    $shop_goods[ 'delivery' ][ 'delivery_type' ] = 'store';
                    if ($shop_goods[ "store_config" ][ "is_use" ] == 0) {
                        $this->error = 1;
                        $this->error_msg = "门店自提方式未开启!";
                    }
                    if (empty($data[ 'delivery' ][ "store_id" ])) {
                        $this->error = 1;
                        $this->error_msg = "门店未选择!";
                    }
                    $shop_goods[ 'delivery' ][ 'store_id' ] = $data[ 'delivery' ][ "store_id" ];

                    $shop_goods = $this->storeOrderData($shop_goods, $data);
                }
            } else {
                if (empty($data[ 'member_address' ])) {
                    $delivery_money = 0;
                    $shop_goods[ 'delivery' ][ 'delivery_type' ] = 'express';

                    $this->error = 1;
                    $this->error_msg = "未配置默认收货地址!";
                } else {
                    if (!isset($data[ 'delivery' ][ "delivery_type" ]) || $data[ 'delivery' ][ "delivery_type" ] == "express") {
                        if ($shop_goods[ "express_config" ][ "is_use" ] == 1) {
                            //物流配送
                            $express = new Express();
                            $express_fee_result = $express->calculate($shop_goods, $data);
                            if ($express_fee_result[ "code" ] < 0) {
                                $this->error = 1;
                                $this->error_msg = $express_fee_result[ "message" ];
                                $delivery_fee = 0;
                            } else {
                                $delivery_fee = $express_fee_result[ 'data' ][ 'delivery_fee' ];
                            }
                        } else {
                            $this->error = 1;
                            $this->error_msg = "物流配送方式未开启!";
                            $delivery_fee = 0;
                        }
                        $delivery_money = $delivery_fee;
                        $shop_goods[ 'delivery' ][ 'delivery_type' ] = 'express';
                    } else if ($data[ 'delivery' ][ "delivery_type" ] == "local") {
                        //外卖配送
                        $delivery_money = 0;
                        $shop_goods[ 'delivery' ][ 'delivery_type' ] = 'local';
                        if ($shop_goods[ "local_config" ][ "is_use" ] == 0) {
                            $this->error = 1;
                            $this->error_msg = "外卖配送方式未开启!";
                        } else {
                            $local_delivery_time = 0;
                            if (!empty($data[ 'buyer_ask_delivery_time' ])) {
                                //$buyer_ask_delivery_time_temp = explode(':', $data['buyer_ask_delivery_time']);
                                //$local_delivery_time          = $buyer_ask_delivery_time_temp[0] * 3600 + $buyer_ask_delivery_time_temp[1] * 60;
                                $local_delivery_time = strtotime($data[ 'buyer_ask_delivery_time' ]);
                            }
                            $shop_goods[ 'buyer_ask_delivery_time' ] = $local_delivery_time;

                            $local_model = new Local();
                            $local_result = $local_model->calculate($shop_goods, $data);


                            if ($local_result[ 'code' ] < 0) {
                                $this->error = $local_result[ 'data' ][ 'code' ];
                                $this->error_msg = $local_result[ 'message' ];
                            } else {
                                $delivery_money = $local_result[ 'data' ][ 'delivery_money' ];
                                if (!empty($local_result[ 'data' ][ 'error_code' ])) {
                                    $this->error = $local_result[ 'data' ][ 'code' ];
                                    $this->error_msg = $local_result[ 'data' ][ 'error' ];
                                }
                            }
                        }
                    }
                }
            }
        }

        //满额包邮插件
        $shop_goods = $this->freeShippingCalculate($shop_goods, $data);

        //会员等级包邮权益
        $shop_goods = $this->memberLevelCalculate($shop_goods, $data);

        //是否符合免邮
        $is_free_delivery = $shop_goods[ 'is_free_delivery' ] ?? false;
        if ($is_free_delivery) {
            $delivery_money = 0;
        }

        $order_money = $shop_goods[ 'goods_money' ] + $delivery_money - $promotion_money;
        $shop_goods[ 'order_money' ] = $order_money; //订单总金额
        //优惠券活动(采用站点id:coupon_id)
        $shop_goods = $this->couponPromotion($shop_goods, $data);
        $coupon_money = $shop_goods[ 'coupon_money' ] ?? 0;
        $order_money = $shop_goods[ 'order_money' ];

        // 积分抵现
        $shop_goods[ 'max_usable_point' ] = 0;
        $point_money = 0;
        if ($data[ 'member_account' ][ 'point' ] > 0 && addon_is_exit('pointcash', $data[ 'site_id' ])) {
            $shop_goods = $this->getMaxUsablePoint($shop_goods, $data);
            $point_money = $shop_goods[ 'point_money' ] ?? 0;
            $order_money = $shop_goods[ 'order_money' ];
        }

        //发票相关
        $shop_goods = $this->invoice($shop_goods, $data);

        $order_money = $order_money + $shop_goods[ 'invoice_money' ] + $shop_goods[ 'invoice_delivery_money' ];

        //理论上是多余的操作
        if ($order_money < 0) {
            $order_money = 0;
        }

        //余额抵扣(判断是否使用余额)
        if ($this->member_balance_money > 0) {
            $temp_order_money = $order_money;
            if ($temp_order_money <= $this->member_balance_money) {
                $balance_money = $temp_order_money;
            } else {
                $balance_money = $this->member_balance_money;
            }
        } else {
            $balance_money = 0;
        }

        $pay_money = $order_money - $balance_money; //计算出实际支付金额
        //判断是否存在支付金额为0的订单
        $this->member_balance_money -= $balance_money; //预减少账户余额
        $this->balance_money += $balance_money; //累计余额

        //总结计算
        $shop_goods[ 'goods_money' ] = $goods_money;
        $shop_goods[ 'delivery_money' ] = $delivery_money;
        $shop_goods[ 'adjust_money' ] = $adjust_money;
        //        $shop_goods['invoice_money'] = $invoice_money;
        $shop_goods[ 'promotion_money' ] = $promotion_money;
        $shop_goods[ 'order_money' ] = $order_money;
        $shop_goods[ 'balance_money' ] = $balance_money;
        $shop_goods[ 'pay_money' ] = $pay_money;

        $this->goods_money += $goods_money;
        $this->delivery_money += $delivery_money;
        $this->coupon_money += $coupon_money;
        $this->adjust_money += $adjust_money;
        $this->invoice_money += $shop_goods[ 'invoice_money' ];
        $this->invoice_delivery_money += $shop_goods[ 'invoice_delivery_money' ];
        $this->promotion_money += $promotion_money;
        $this->order_money += $order_money;
        $this->pay_money += $pay_money;

        $this->goods_num += $shop_goods[ "goods_num" ];
        $this->order_name = string_split($this->order_name, ",", $shop_goods[ "order_name" ]);
        $this->point_money += $point_money;

        //买家留言
        if (isset($data[ 'buyer_message' ]) && isset($data[ 'buyer_message' ])) {
            $item_buyer_message = $data[ 'buyer_message' ];
            $shop_goods[ "buyer_message" ] = $item_buyer_message;
        } else {
            $shop_goods[ "buyer_message" ] = '';
        }
        return $shop_goods;
    }

    /**
     * 发票信息
     * @param $shop_goods
     * @param $data
     */
    public function invoice($shop_goods, $data)
    {
        $invoice_status = $shop_goods[ 'order_config' ][ 'invoice_status' ] ?? 0;
        $shop_goods[ 'invoice_status' ] = $invoice_status;
        $invoice_money = 0;
        $invoice_delivery_money = 0;
        if ($invoice_status == 1) {
            $invoice_content = $shop_goods[ 'order_config' ][ 'invoice_content' ] ?? '';
            $invoice_content_array = explode(',', $invoice_content);
            $shop_goods[ 'invoice' ][ 'invoice_content_array' ] = $invoice_content_array;
            $shop_goods[ 'invoice' ][ 'invoice_delivery_money' ] = $shop_goods[ 'order_config' ][ 'invoice_money' ] ?? 0;
            $shop_goods[ 'invoice' ][ 'invoice_rate' ] = $shop_goods[ 'order_config' ][ 'invoice_rate' ] ?? 0;

            $is_invoice = $data[ 'is_invoice' ] ?? 0;
            $shop_goods[ 'is_invoice' ] = $is_invoice;
            //是否需要发票
            if ($is_invoice) {
                $promotion_money = $shop_goods[ 'promotion_money' ];//优惠金额
                $coupon_money = $shop_goods[ 'coupon_money' ] ?? 0;//优惠券金额
                $real_goods_money = $shop_goods[ 'goods_money' ] - $promotion_money - $coupon_money;
                $invoice_money = round(floor($real_goods_money * $shop_goods[ 'invoice' ][ 'invoice_rate' ]) / 100, 2);
                $invoice_type = $data[ 'invoice_type' ] ?? 1;
                if ($invoice_type == 1) {
                    $invoice_delivery_money = $shop_goods[ 'invoice' ][ 'invoice_delivery_money' ];
                    if (empty($data[ 'invoice_full_address' ])) {
                        $this->error = 1;
                        $this->error_msg = "发票邮寄地址不能为空!";
                    } else {
                        $shop_goods[ 'invoice_full_address' ] = $data[ 'invoice_full_address' ];
                    }
                } else {
                    if (empty($data[ 'invoice_email' ])) {
                        $this->error = 1;
                        $this->error_msg = "发票邮箱不能为空!";
                    } else {
                        $shop_goods[ 'invoice_email' ] = $data[ 'invoice_email' ];
                    }
                }
                if (empty($data[ 'invoice_title' ]) || empty($data[ 'invoice_type' ]) || empty($data[ 'invoice_content' ] || $data[ 'invoice_title_type' ] == 0)) {
                    $this->error = 1;
                    $this->error_msg = "发票相关项不能为空!";
                }
                //企业抬头  必须填写税号
                if ($data[ 'invoice_title_type' ] == 2 && empty($data[ 'taxpayer_number' ])) {
                    $this->error = 1;
                    $this->error_msg = "发票相关项不能为空!";
                }

                $shop_goods[ 'invoice_title_type' ] = $data[ 'invoice_title_type' ];
                $shop_goods[ 'is_tax_invoice' ] = $data[ 'is_tax_invoice' ];
                $shop_goods[ 'taxpayer_number' ] = $data[ 'taxpayer_number' ];
                $shop_goods[ 'invoice_title' ] = $data[ 'invoice_title' ];
                $shop_goods[ 'invoice_type' ] = $data[ 'invoice_type' ];
                $shop_goods[ 'invoice_content' ] = $data[ 'invoice_content' ];
                $shop_goods[ 'invoice_rate' ] = $shop_goods[ 'invoice' ][ 'invoice_rate' ];
            }
        }
        $shop_goods[ 'invoice_money' ] = $invoice_money;
        $shop_goods[ 'invoice_delivery_money' ] = $invoice_delivery_money;
        return $shop_goods;
    }

    /**
     * 增加订单自动关闭事件
     * @param $order_id
     */
    public function addOrderCronClose($order_id, $site_id)
    {
        //计算订单自动关闭时间
        $config_model = new Config();
        $order_config_result = $config_model->getOrderEventTimeConfig($site_id);
        $order_config = $order_config_result[ "data" ];
        $now_time = time();
        if ($order_config[ "value" ][ "auto_close" ] > 0) {
            $execute_time = $now_time + $order_config[ "value" ][ "auto_close" ] * 60; //自动关闭时间
            $cron_model = new Cron();
            $cron_model->addCron(1, 0, "订单自动关闭", "CronOrderClose", $execute_time, $order_id);
        }
    }

    /**
     * 补齐门店数据
     * @param $data
     */
    public function storeOrderData($shop_goods, $data)
    {
        $temp_data = [];
        $delivery_store_id = $shop_goods[ 'delivery' ][ 'store_id' ] ?? 0; //门店id

        if ($delivery_store_id > 0) {
            $store_model = new Store();
            $condition = array (
                [ "store_id", "=", $delivery_store_id ],
                [ "site_id", "=", $shop_goods[ 'site_id' ] ],
                [ "status", "=", 1 ],
                [ "is_pickup", "=", 1 ],
            );
            $store_info_result = $store_model->getStoreInfo($condition);
            $store_info = $store_info_result[ "data" ] ?? [];
            if (empty($store_info)) {
                $this->error = 1;
                $this->error_msg = "当前门店不存在或未开启!";
            } else {
                $temp_data[ "delivery_store_id" ] = $delivery_store_id;
                $delivery_store_name = $store_info_result[ "data" ][ "store_name" ];
                $temp_data[ "delivery_store_name" ] = $delivery_store_name;
                $delivery_store_info = array (
                    "open_date" => $store_info[ "open_date" ],
                    "full_address" => $store_info[ "full_address" ] . $store_info[ "address" ],
                    "longitude" => $store_info[ "longitude" ],
                    "latitude" => $store_info[ "latitude" ],
                    "telphone" => $store_info[ "telphone" ],
                    "store_image" => $store_info[ "store_image" ],
                );
                $temp_data[ "delivery_store_info" ] = json_encode($delivery_store_info, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $this->error = 1;
            $this->error_msg = "配送门店不可为空!";
        }
        return array_merge($shop_goods, $temp_data);
    }

    /**
     * 使用优惠券
     * @param $data
     * @param $site_id
     * @return array
     */
    public function useBalance($data, $site_id)
    {
        $this->pay_type = "BALANCE";
        $member_model = new Member();
//        $result         = $member_model->checkPayPassword($data["member_id"], $data["pay_password"]);
//        if ($result["code"] >= 0) {

        $balance_money = $data[ "member_account" ][ "balance_money" ]; //不可提现余额
        $balance = $data[ "member_account" ][ "balance" ]; //可提现余额
        $member_account_model = new MemberAccount();
        $surplus_banance = $data[ "balance_money" ];
        //优先扣除不可提现余额
        if ($balance > 0) {
            if ($balance >= $surplus_banance) {
                $real_balance = $surplus_banance;
            } else {
                $real_balance = $balance;
            }
            $result = $member_account_model->addMemberAccount($site_id, $data[ "member_id" ], "balance", -$real_balance, "order", "余额抵扣", "订单余额抵扣,扣除不可提现余额:" . $real_balance);
            $surplus_banance -= $real_balance;
        }

        //            if($balance_money > 0){
        //                if($balance_money > $surplus_banance){
        //                    $real_balance_money = $surplus_banance;
        //                }else{
        //                    $real_balance_money = $balance_money;
        //                }
        //                $result = $member_account_model->addMemberAccount($data["member_id"], "balance", -$real_balance, "order", "余额抵扣","订单余额抵扣,扣除不可提现余额:".$real_balance);
        //            }
        if ($surplus_banance > 0) {
            $result = $member_account_model->addMemberAccount($site_id, $data[ "member_id" ], "balance_money", -$surplus_banance, "order", "余额抵扣", "订单余额抵扣,扣除可提现余额:" . $surplus_banance);
        }

        return $result;
//        } else {
//            return $result;
//        }
    }

    /**
     * 初始化会员账户
     * @param $data
     * @return mixed
     */
    public function initMemberAccount($data)
    {
        $member_model = new Member();
        $member_info_result = $member_model->getMemberDetail($data[ "member_id" ]);
        $member_info = $member_info_result[ "data" ];

        if (!empty($member_info)) {
            if (!empty($member_info[ "pay_password" ])) {
                $is_pay_password = 1;
            } else {
                $is_pay_password = 0;
            }
            unset($member_info[ "pay_password" ]);
            $member_info[ "is_pay_password" ] = $is_pay_password;
            $data[ 'member_account' ] = $member_info;
        }

        return $data;
    }

    /****************************************************************************** 满减 start *****************************************************************************/
    /**
     * 满减优惠
     * @param $data
     */
    public function manjianPromotion($calculate_data)
    {
        $calculate_data[ 'manjian_rule_list' ] = [];
        //先查询全部商品的满减套餐  进行中
        $manjian_model = new Manjian();
        $all_info_result = $manjian_model->getManjianInfo([ [ 'manjian_type', '=', 1 ], [ 'site_id', '=', $calculate_data[ 'site_id' ] ], [ 'status', '=', 1 ] ], 'manjian_name,type,goods_ids,rule_json,manjian_id');
        $all_info = $all_info_result[ 'data' ];
        $goods_list = $calculate_data[ 'goods_list' ];
        //存在全场满减(不考虑部分满减情况)
        if (!empty($all_info)) {
            $discount_array = $this->getManjianDiscountMoney($all_info, $calculate_data);
            $all_info[ 'discount_array' ] = $discount_array;
            //判断有没有优惠
            $temp_goods_list = $this->distributionGoodsDemiscount($goods_list, $calculate_data[ 'goods_money' ], $discount_array[ 'real_discount_money' ], isset($discount_array[ 'rule' ][ 'free_shipping' ]));
            $goods_list = $temp_goods_list;

            $manjian_list[] = $all_info;

            $discount_money = $discount_array[ 'real_discount_money' ];
            $calculate_data[ 'goods_list' ] = $goods_list;
            $calculate_data[ "promotion" ][ 'manjian' ] = $manjian_list;
            $calculate_data[ 'promotion_money' ] += $discount_money;

            if (!empty($discount_array[ 'rule' ])) {
                $calculate_data[ 'manjian_rule_list' ][] = [
                    'manjian_info' => $all_info,
                    'rule' => $discount_array[ 'rule' ],
                    'sku_ids' => ''
                ];
            }
        } else {
            $goods_ids = array_unique(array_column($calculate_data[ 'goods_list' ], 'goods_id'));

            $manjian_condition = array (
                [ 'goods_id', 'in', $goods_ids ],
                [ 'status', '=', 1 ]
            );
            $manjian_goods_list_result = $manjian_model->getManjianGoodsList($manjian_condition, 'manjian_id');
            $manjian_goods_list = $manjian_goods_list_result[ 'data' ];
            if (!empty($manjian_goods_list)) {
                $discount_money = 0;
                $manjian_goods_list = array_column($manjian_goods_list, 'manjian_id');
                $manjian_goods_list = array_unique($manjian_goods_list); //去重
                sort($manjian_goods_list);
                $manjian_list_result = $manjian_model->getManjianList([ [ 'manjian_id', 'in', $manjian_goods_list ], [ 'status', '=', 1 ] ]);
                $manjian_list = $manjian_list_result[ 'data' ];
                foreach ($manjian_list as $k => $v) {
                    $manjian_goods_ids = explode(',', $v[ 'goods_ids' ]);
                    $item_goods_data = [
                        'goods_money' => 0,
                        'goods_num' => 0
                    ];
                    $item_goods_list = [];
                    $sku_ids = [];
                    foreach ($goods_list as $goods_k => $goods_item) {
                        if (in_array($goods_item[ 'goods_id' ], $manjian_goods_ids)) {
                            $item_goods_data[ 'goods_money' ] += $goods_item[ 'goods_money' ];
                            $item_goods_data[ 'goods_num' ] += $goods_item[ 'num' ];
                            $item_goods_list[] = $goods_item;
                            array_push($sku_ids, $goods_item[ 'sku_id' ]);
                            unset($goods_list[ $goods_k ]);
                        }
                    }
                    $discount_array = $this->getManjianDiscountMoney($v, $item_goods_data);

                    $temp_goods_list = $this->distributionGoodsDemiscount($item_goods_list, $item_goods_data[ 'goods_money' ], $discount_array[ 'real_discount_money' ], isset($discount_array[ 'rule' ][ 'free_shipping' ]), $sku_ids);
                    $goods_list = array_merge($goods_list, $temp_goods_list);
                    $manjian_list[ $k ][ 'discount_array' ] = $discount_array;
                    $discount_money += $discount_array[ 'real_discount_money' ];

                    if (!empty($discount_array[ 'rule' ])) {
                        array_push($calculate_data[ 'manjian_rule_list' ], [
                            'manjian_info' => $v,
                            'rule' => $discount_array[ 'rule' ],
                            'sku_ids' => $sku_ids
                        ]);
                    }
                }
                $calculate_data[ 'goods_list' ] = $goods_list;
                $calculate_data[ "promotion" ][ 'manjian' ] = $manjian_list;
                $calculate_data[ 'promotion_money' ] += $discount_money;
            }
        }
        return $calculate_data;
    }

    /**
     * 满减优惠金额
     * @param $rule_list
     * @param $goods_money
     */
    public function getManjianDiscountMoney($manjian_info, $data)
    {
        $goods_money = $data[ 'goods_money' ];
        $value = $manjian_info[ 'type' ] == 0 ? $data[ 'goods_money' ] : $data[ 'goods_num' ];

        //阶梯计算优惠
        $rule_item = json_decode($manjian_info[ 'rule_json' ], true);
        $discount_money = 0;
        $money = 0;
        $rule = []; // 符合条件的优惠规则
        array_multisort(array_column($rule_item, 'limit'), SORT_ASC, $rule_item); //排序，根据num 排序
        foreach ($rule_item as $k => $v) {
            if ($value >= $v[ 'limit' ]) {
                $rule = $v;
                if (isset($v[ 'discount_money' ])) {
                    $discount_money = $v[ 'discount_money' ];
                    $money = $v[ 'limit' ];
                }
            }
        }
        $real_discount_money = $discount_money > $goods_money ? $goods_money : $discount_money;
        return [ 'discount_money' => $discount_money, 'money' => $money, 'real_discount_money' => $real_discount_money, 'rule' => $rule ];
    }

    /**
     * 处理商品满减
     */
    public function distributionGoodsDemiscount($goods_list, $goods_money, $discount_money, $is_free_shipping = false, $sku_ids = [])
    {
        $temp_discount_money = $discount_money;
        $last_key = count($goods_list) - 1;
        foreach ($goods_list as $k => $v) {
            if ($last_key != $k) {
                $item_discount_money = round(floor($v[ 'goods_money' ] / $goods_money * $discount_money * 100) / 100, 2);
            } else {
                $item_discount_money = $temp_discount_money;
            }
            $temp_discount_money -= $item_discount_money;
            $goods_list[ $k ][ 'promotion_money' ] = $item_discount_money;
            $real_goods_money = $v[ 'real_goods_money' ] - $item_discount_money;
            $real_goods_money = $real_goods_money < 0 ? 0 : $real_goods_money;
            $goods_list[ $k ][ 'real_goods_money' ] = $real_goods_money; //真实订单项金额
            // 满减送包邮
            if ($is_free_shipping) {
                if (empty($sku_ids) || in_array($v[ 'sku_id' ], $sku_ids)) {
                    $goods_list[ $k ][ 'is_free_shipping' ] = 1;
                }
            }
        }
        return $goods_list;
    }
    /****************************************************************************** 满减 end *****************************************************************************/
    /****************************************************************************** 订单优惠券 start *****************************************************************************/
    /**
     * 优惠券活动
     * @param $shop_goods
     * @param $coupon_info
     * @return mixed
     */
    public function couponPromotion($shop_goods, $data)
    {
        $coupon_money = 0;
        if (!empty($data[ 'coupon' ]) && $data[ 'coupon' ][ "coupon_id" ] > 0) {
            //查询优惠券信息,计算优惠券费用
            $coupon_model = new Coupon();
            $coupon_info_result = $coupon_model->getCouponInfo([ [ 'coupon_id', '=', $data[ 'coupon' ][ "coupon_id" ] ], [ "site_id", "=", $shop_goods[ 'site_id' ] ] ], 'member_id,at_least,money,state,goods_type,type,goods_ids,discount,discount_limit');
            $coupon_info = $coupon_info_result[ "data" ];
            $is_coupon = false;
            $coupon_goods_money = 0;
            $goods_list = $shop_goods[ 'goods_list' ];

            if ($coupon_info[ 'member_id' ] == $data[ 'member_id' ] && $coupon_info[ 'state' ] == 1) {
                $coupon_goods_list = [];
                if ($coupon_info[ 'goods_type' ] == 1) { //全场通用优惠券
                    if ($coupon_info[ 'at_least' ] <= $shop_goods[ 'goods_money' ]) {
                        $is_coupon = true;
                    } else {
                        $this->error = 1;
                        $this->error_msg = "优惠券不可用!";
                    }
                    $coupon_goods_money = $shop_goods[ 'goods_money' ];
                    $coupon_goods_list = $goods_list;
                    $goods_list = [];
                } else {
                    $item_goods_ids = explode(',', $coupon_info[ 'goods_ids' ]);
                    $temp_money = 0;
                    foreach ($goods_list as $goods_k => $goods_v) {
                        if (in_array($goods_v[ 'goods_id' ], $item_goods_ids)) {
                            $temp_money += $goods_v[ 'goods_money' ];
                            $coupon_goods_list[] = $goods_v;
                            unset($goods_list[ $goods_k ]);
                        }
                    }
                    if ($temp_money >= $coupon_info[ 'at_least' ]) {
                        $is_coupon = true;
                    }
                    $coupon_goods_money = $temp_money;
                }
            }

            if ($is_coupon) {
                $coupon_money = 0;
                if ($coupon_info[ 'type' ] == 'reward') { //满减优惠券
                    $coupon_money = $coupon_info[ 'money' ] > $coupon_goods_money ? $coupon_goods_money : $coupon_info[ 'money' ];
                } else if ($coupon_info[ 'type' ] == 'discount') { //折扣优惠券
                    //计算折扣优惠金额
                    $coupon_money = $coupon_goods_money * ( 10 - $coupon_info[ 'discount' ] ) / 10;
                    $coupon_money = $coupon_money > $coupon_info[ 'discount_limit' ] && $coupon_info[ 'discount_limit' ] != 0 ? $coupon_info[ 'discount_limit' ] : $coupon_money;
                    $coupon_money = $coupon_money > $coupon_goods_money ? $coupon_goods_money : $coupon_money;
                    $coupon_money = round(floor($coupon_money * 100) / 100, 2);
                }
                $temp_goods_list = $this->distributionGoodsCouponMoney($coupon_goods_list, $coupon_goods_money, $coupon_money);
                $goods_list = array_merge($goods_list, $temp_goods_list);
                $shop_goods[ 'goods_list' ] = $goods_list;
            } else {
                $this->error = 1;
                $this->error_msg = "优惠券不可用!";
            }
        }

        if ($coupon_money > 0) {
            $shop_goods[ 'coupon_id' ] = $data[ 'coupon' ][ "coupon_id" ];
            if ($coupon_money > $shop_goods[ 'order_money' ]) {
                $coupon_money = $shop_goods[ 'order_money' ];
            }
            $shop_goods[ 'order_money' ] -= $coupon_money;
            $shop_goods[ 'coupon_money' ] = $coupon_money;
        }
        return $shop_goods;
    }

    /**
     * 查询可用优惠券
     * @param $data
     */
    public function getOrderCouponList($data)
    {
        $coupon_list = [];
        //先查询全场通用的优惠券
        $member_coupon_model = new Coupon();
        $all_condition = array (
            [ 'member_id', '=', $data[ "member_id" ] ],
            [ 'state', '=', 1 ],
            [ 'site_id', '=', $data[ "site_id" ] ],
            [ 'goods_type', '=', 1 ],
            [ 'at_least', "<=", $data[ 'shop_goods_list' ][ "goods_money" ] ]
        );
        $all_coupon_list_result = $member_coupon_model->getCouponList($all_condition);
        $all_coupon_list = $all_coupon_list_result[ "data" ];
        $coupon_list = array_merge($coupon_list, $all_coupon_list);
        $shop_goods_list = $data[ 'shop_goods_list' ];
        $goods_ids = array_column($shop_goods_list[ 'goods_list' ], 'goods_id');
        $goods_list = $shop_goods_list[ 'goods_list' ];
        $item_condition = array (
            [ 'member_id', '=', $data[ "member_id" ] ],
            [ 'state', '=', 1 ],
            [ 'site_id', '=', $data[ "site_id" ] ],
            [ 'goods_type', '=', 2 ],
        );
        $item_like_array = [];
        foreach ($goods_ids as $k => $v) {
            $item_like_array[] = "%," . $v . ",%";
        }
        $item_condition[] = [ 'goods_ids', 'like', $item_like_array, 'OR' ];
        $item_coupon_list_result = $member_coupon_model->getCouponList($item_condition);
        $item_coupon_list = $item_coupon_list_result[ "data" ];
        if (!empty($item_coupon_list)) {
            foreach ($item_coupon_list as $item_k => $item_v) {
                $item_goods_ids = explode(',', $item_v[ 'goods_ids' ]);
                $item_goods_money = 0;
                foreach ($goods_list as $goods_k => $goods_v) {
                    if (in_array($goods_v[ 'goods_id' ], $item_goods_ids)) {
                        $item_goods_money += $goods_v[ 'goods_money' ];
                    }
                }
                if ($item_goods_money > $v[ 'at_least' ]) {
                    $coupon_list[] = $item_v;
                }
                //            $intersect_goods_ids = array_intersect($item_goods_ids, $goods_ids);

            }
        }
        array_multisort(array_column($coupon_list, 'money'), SORT_DESC, $coupon_list);
        return $coupon_list;
    }

    /**
     * 按比例摊派优惠券优惠
     */
    public function distributionGoodsCouponMoney($goods_list, $goods_money, $coupon_money)
    {
        $temp_coupon_money = $coupon_money;
        $last_key = count($goods_list) - 1;
        foreach ($goods_list as $k => $v) {
            if ($last_key != $k) {
                $item_coupon_money = round(floor($v[ 'goods_money' ] / $goods_money * $coupon_money * 100) / 100, 2);
            } else {
                $item_coupon_money = $temp_coupon_money;
            }
            $temp_coupon_money -= $item_coupon_money;
            $goods_list[ $k ][ 'coupon_money' ] = $item_coupon_money;
            $real_goods_money = $v[ 'real_goods_money' ] - $item_coupon_money;
            $real_goods_money = $real_goods_money < 0 ? 0 : $real_goods_money;
            $goods_list[ $k ][ 'real_goods_money' ] = $real_goods_money; //真实订单项金额
        }
        return $goods_list;
    }
    /****************************************************************************** 订单优惠券 end *****************************************************************************/

    /**
     * 满额包邮
     * @param $shop_goods
     */
    public function freeShippingCalculate($shop_goods, $data)
    {

        if (addon_is_exit("freeshipping", $data[ 'site_id' ])) {
            $free_shipping_model = new Freeshipping();
            $city_id = $data[ 'member_address' ][ 'city_id' ] ?? 0;
            $free_result = $free_shipping_model->calculate($shop_goods[ 'goods_money' ], $city_id, $data[ 'site_id' ]);
            if ($free_result[ 'code' ] >= 0) {
                $shop_goods[ "promotion" ][ 'freeshipping' ] = $free_result[ 'data' ]; //优惠活动  满额包邮
                $shop_goods[ 'is_free_delivery' ] = true;
            }
        }
        return $shop_goods;
    }

    /**
     * 会员等级免邮
     */
    public function memberLevelCalculate($shop_goods, $data)
    {
        $member_model = new Member();
        $info = $member_model->getMemberInfo([ [ 'member_id', '=', $data[ 'member_id' ] ], [ 'site_id', '=', $data[ 'site_id' ] ] ], 'member_level');

        if (!empty($info[ 'data' ])) {

            $member_level_model = new MemberLevel();
            $member_level_result = $member_level_model->getMemberLevelInfo([ [ 'level_id', '=', $info[ 'data' ][ 'member_level' ] ] ], '*');
            $member_level = $member_level_result[ 'data' ];
            $is_free_shipping = $member_level[ 'is_free_shipping' ] ?? 0;
            if ($is_free_shipping > 0) {
                $shop_goods[ "promotion" ][ 'member_level' ] = $member_level; //优惠活动  满额包邮
                $shop_goods[ 'is_free_delivery' ] = true;
            }
        }
        return $shop_goods;
    }

    /**
     * 获取订单最大可用积分
     * @param $data
     */
    public function getMaxUsablePoint($shop_goods, $data)
    {
        $point = 0;
        // 获取积分抵现配置
        $config_model = new PointCashConfig();
        $config = $config_model->getPointCashConfig($data[ 'site_id' ]);
        $config = $config[ 'data' ][ 'value' ];
        $shop_goods[ 'point_cash_config' ] = $config;

        if ($config[ 'is_enable' ]) {
            if ($config[ 'is_limit' ] == 1 && $shop_goods[ 'order_money' ] < $config[ 'limit' ]) {
                $shop_goods[ 'max_usable_point' ] = $point;
                return $shop_goods;
            }
            $deduction_money = $shop_goods[ 'order_money' ];
            if ($config[ 'is_limit_use' ] == 1) {
                if ($config[ 'type' ] == 0) {
                    $deduction_money = $config[ 'max_use' ];
                } else {
                    $ratio = $config[ 'max_use' ] / 100;
                    $deduction_money = round(( $shop_goods[ 'order_money' ] * $ratio ), 2);
                }
                if ($deduction_money > $shop_goods[ 'order_money' ]) {
                    $deduction_money = $shop_goods[ 'order_money' ];
                }
            }
            $max_point = round($deduction_money * $config[ 'cash_rate' ]);
            $point = $max_point > $data[ 'member_account' ][ 'point' ] ? $data[ 'member_account' ][ 'point' ] : $max_point;
        }
        if ($data[ 'is_point' ] && $point > 0) {
            $point_money = round(( $point * ( 1 / $config[ 'cash_rate' ] ) ), 2);
            if ($point_money > $shop_goods[ 'order_money' ]) {
                $point_money = $shop_goods[ 'order_money' ];
            }
            $shop_goods[ 'goods_list' ] = $this->distributionGoodsPoint($shop_goods[ 'goods_list' ], $shop_goods[ 'goods_money' ], $point, $point_money);
            $shop_goods[ 'order_money' ] -= $point_money;
            $shop_goods[ 'point_money' ] = $point_money;
        }
        $shop_goods[ 'max_usable_point' ] = $point;
        return $shop_goods;
    }

    /**
     * 按比例摊派积分
     * @param $goods_list
     * @param $goods_money
     * @param $point
     */
    public function distributionGoodsPoint($goods_list, $goods_money, $point, $point_money)
    {
        $temp_point = $point;
        $temp_point_money = $point_money;
        $last_key = count($goods_list) - 1;
        foreach ($goods_list as $k => $v) {
            if ($last_key != $k) {
                $use_point = round(floor($v[ 'goods_money' ] / $goods_money * $point * 100) / 100);
                $item_point_money = round(floor($v[ 'goods_money' ] / $goods_money * $point_money * 100) / 100, 2);
            } else {
                $use_point = $temp_point;
                $item_point_money = $temp_point_money;
            }
            $temp_point -= $use_point;
            $goods_list[ $k ][ 'use_point' ] = $use_point;
            $goods_list[ $k ][ 'point_money' ] = $item_point_money;
            $real_goods_money = $v[ 'real_goods_money' ] - $item_point_money;
            $real_goods_money = $real_goods_money < 0 ? 0 : $real_goods_money;
            $goods_list[ $k ][ 'real_goods_money' ] = $real_goods_money; //真实订单项金额
        }
        return $goods_list;
    }
}
