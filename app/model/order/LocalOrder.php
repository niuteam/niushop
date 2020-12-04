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

use app\model\express\LocalPackage;
use app\model\goods\GoodsStock;
use app\model\message\Message;
use app\model\system\Cron;

/**
 * 外卖订单
 *
 * @author Administrator
 *
 */
class LocalOrder extends OrderCommon
{
    /*****************************************************************************************订单基础状态（其他使用）********************************/
    // 订单待付款
    const ORDER_CREATE = 0;

    // 订单已支付(待发货)
    const ORDER_PAY = 1;

    // 订单备货中
    const ORDER_PENDING_DELIVERY = 2;

    // 订单已发货（配货）
    const ORDER_DELIVERY = 3;

    // 订单已收货
    const ORDER_TAKE_DELIVERY = 4;

    // 订单已结算完成
    const ORDER_COMPLETE = 10;

    // 订单已关闭
    const ORDER_CLOSE = -1;

    /***********************************************************************************订单项  配送状态**************************************************/
    // 待发货
    const DELIVERY_WAIT = 0;

    // 已发货
    const DELIVERY_DOING = 1;

    // 已收货
    const DELIVERY_FINISH = 2;


    /**
     * 订单类型
     *
     * @var int
     */
    public $order_type = 3;


    /**
     * 基础订单状态(不同类型的订单可以不使用这些状态，但是不能冲突)
     * @var unknown
     */
    public $order_status = [
        self::ORDER_CREATE        => [
            'status'          => self::ORDER_CREATE,
            'name'            => '待支付',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon.png',
            'action'          => [
                [
                    'action' => 'orderClose',
                    'title'  => '关闭订单',
                    'color'  => ''
                ],
                [
                    'action' => 'orderAddressUpdate',
                    'title'  => '修改地址',
                    'color'  => ''
                ],
                [
                    'action' => 'orderAdjustMoney',
                    'title'  => '调整价格',
                    'color'  => ''
                ],
            ],
            'member_action'   => [
                [
                    'action' => 'orderClose',
                    'title'  => '关闭订单',
                    'color'  => ''
                ],
                [
                    'action' => 'orderPay',
                    'title'  => '支付',
                    'color'  => ''
                ],
            ],
            'color'           => ''
        ],
        self::ORDER_PAY           => [
            'status'          => self::ORDER_PAY,
            'name'            => '待发货',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon-send.png',
            'action'          => [
                [
                    'action' => 'orderLocalDelivery',
                    'title'  => '发货',
                    'color'  => ''
                ],
                [
                    'action' => 'orderAddressUpdate',
                    'title' => '修改地址',
                    'color' => ''
                ],
            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
        self::ORDER_DELIVERY      => [
            'status'          => self::ORDER_DELIVERY,
            'name'            => '已发货',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-receive.png',

            'action'        => [
                [
                    'action' => 'takeDelivery',
                    'title' => '确认收货',
                    'color' => ''
                ],
            ],
            'member_action' => [
                [
                    'action' => 'memberTakeDelivery',
                    'title'  => '确认收货',
                    'color'  => ''
                ],

            ],
            'color'         => ''
        ],
        self::ORDER_TAKE_DELIVERY => [
            'status'          => self::ORDER_TAKE_DELIVERY,
            'name'            => '已收货',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-received.png',

            'action'        => [
            ],
            'member_action' => [
            ],
            'color'         => ''
        ],
        self::ORDER_COMPLETE      => [
            'status'          => self::ORDER_COMPLETE,
            'name'            => '已完成',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-received.png',
            'action'          => [
            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
        self::ORDER_CLOSE         => [
            'status'          => self::ORDER_CLOSE,
            'name'            => '已关闭',
            'is_allow_refund' => 0,
            'icon'            => 'upload/uniapp/order/order-icon-close.png',
            'action'          => [

            ],
            'member_action'   => [

            ],
            'color'           => ''
        ],
    ];

    /**
     * 配送状态
     */
    public $delivery_status = [
        self::DELIVERY_WAIT   => [
            'status' => self::DELIVERY_WAIT,
            'name'   => '待发货',
            'color'  => ''
        ],
        self::DELIVERY_DOING  => [
            'status' => self::DELIVERY_DOING,
            'name'   => '已发货',
            'color'  => ''
        ],
        self::DELIVERY_FINISH => [
            'status' => self::DELIVERY_FINISH,
            'name'   => '已收货',
            'color'  => ''
        ]
    ];

    /**
     * 订单支付
     * @param unknown $order_info
     */
    public function orderPay($order_info, $pay_type)
    {
        if ($order_info['order_status'] != 0) {
            return $this->error();
        }
        $condition     = array(
            ["order_id", "=", $order_info["order_id"]],
            ["order_status", "=", self::ORDER_CREATE],
        );
        $pay_type_list = $this->getPayType();
        $data          = array(
            "order_status"        => self::ORDER_PAY,
            "order_status_name"   => $this->order_status[self::ORDER_PAY]["name"],
            "pay_status"          => 1,
            "order_status_action" => json_encode($this->order_status[self::ORDER_PAY], JSON_UNESCAPED_UNICODE),
            "pay_time"            => time(),
            "is_enable_refund"    => 1,
            "pay_type"            => $pay_type,
            "pay_type_name"       => $pay_type_list[$pay_type]
        );
        $result        = model("order")->update($data, $condition);
        return $this->success($result);
    }


    /**
     * 订单项发货（物流）
     * @param unknown $param
     * @return multitype:unknown |multitype:number unknown
     */
    public function orderGoodsDelivery($param)
    {
        model('order_goods')->startTrans();
        try {
            $delivery_no      = $param["delivery_no"] ?? '';//物流单号
            $delivery_type    = $param["delivery_type"] ?? 'default';
            $order_id         = $param['order_id'] ?? 0;
            $site_id          = $param["site_id"];
            $order_goods_list = model('order_goods')->getList([['site_id', '=', $site_id], ['order_id', '=', $order_id]], 'sku_id,num,order_id,sku_name,sku_image,member_id,refund_status,order_goods_id');
            if (empty($order_goods_list))
                return $this->error('', "发送货物不可为空!");

            $order_goods_id_array = [];
            $goods_id_array       = [];
            foreach ($order_goods_list as $k => $order_goods_info) {

                //已退款的订单项不可发货
                if ($order_goods_info["refund_status"] == 3) {
                    model('order_goods')->commit();
                    return $this->error([], "ORDER_GOODS_IS_REFUND");
                }
                $order_goods_id_array[] = $order_goods_info['order_goods_id'];
                $order_id               = $order_goods_info["order_id"];
                $member_id              = $order_goods_info["member_id"];
                $goods_id_array[]       = $order_goods_info["sku_id"] . ":" . $order_goods_info["num"] . ":" . $order_goods_info["sku_name"] . ":" . $order_goods_info["sku_image"];
                $data                   = ["delivery_status" => self::DELIVERY_DOING, "delivery_status_name" => $this->delivery_status[self::DELIVERY_DOING]["name"]];
                if (!empty($delivery_no)) {
                    $data['delivery_no'] = $delivery_no;
                }
                $res = model('order_goods')->update($data, [
                    ['order_goods_id', "=", $order_goods_info['order_goods_id']],
                    ['delivery_status', "=", self::DELIVERY_WAIT]
                ]);
            }

            //创建包裹
            $order_common_model = new OrderCommon();
            $lock_result        = $order_common_model->verifyOrderLock($order_id);
            if ($lock_result["code"] < 0) {
                model('order_goods')->rollback();
                return $lock_result;
            }

            $local_delivery_model = new LocalPackage();
            $delivery_data        = array(
                "order_id"             => $order_id,
                "order_goods_id_array" => $order_goods_id_array,
                "goods_id_array"       => $goods_id_array,
                "goods_array"          => $goods_id_array,
                "site_id"              => $site_id,
                "delivery_no"          => $delivery_no,
                "member_id"            => $member_id,
                "delivery_type"        => $delivery_type,
                "deliverer"            => $param['deliverer'],
                "deliverer_mobile"     => $param['deliverer_mobile'],
            );
            $result               = $local_delivery_model->delivery($delivery_data);
            //检测整体, 订单中订单项是否全部发放完毕
            $res = $this->orderCommonDelivery($order_id);
            model('order_goods')->commit();
            return $this->success($res);
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 订单发货
     *
     * @param array $condition
     */
    public function orderDelivery($order_id)
    {
        //统计订单项目
        $count          = model('order_goods')->getCount([['order_id', "=", $order_id], ['delivery_status', "=", self::DELIVERY_WAIT], ["refund_status", "<>", 3]], "order_goods_id");
        $delivery_count = model('order_goods')->getCount([['order_id', "=", $order_id], ['delivery_status', "=", self::DELIVERY_DOING], ["refund_status", "<>", 3]], "order_goods_id");
        if ($count == 0 && $delivery_count > 0) {

            $order_info = model('order')->getInfo([['order_id', "=", $order_id]], 'site_id');

            //修改订单项的配送状态
            $order_data = array(
                'order_status'         => self::ORDER_DELIVERY,
                'order_status_name'    => $this->order_status[self::ORDER_DELIVERY]["name"],
                'delivery_status'      => self::DELIVERY_FINISH,
                'delivery_status_name' => $this->delivery_status[self::DELIVERY_FINISH]["name"],
                'order_status_action'  => json_encode($this->order_status[self::ORDER_DELIVERY], JSON_UNESCAPED_UNICODE),
                'delivery_time'        => time()
            );
            $res        = model('order')->update($order_data, [['order_id', "=", $order_id]]);

            //获取订单自动收货时间
            $config_model             = new Config();
            $event_time_config_result = $config_model->getOrderEventTimeConfig($order_info['site_id']);
            $event_time_config        = $event_time_config_result["data"];
            $now_time                 = time();//当前时间

            if ($event_time_config["value"]["auto_take_delivery"] > 0) {
                $execute_time = $now_time + $event_time_config["value"]["auto_take_delivery"] * 86400;//自动收货时间
                $cron_model = new Cron();
                $cron_model->addCron(1, 1, "订单自动收货", "CronOrderTakeDelivery", $execute_time, $order_id);
            }

            event('OrderDelivery', ['order_id' => $order_id]);

            //订单发货消息
            $message_model = new Message();
            $message_model->sendMessage(['keywords' => "ORDER_DELIVERY", 'order_id' => $order_id, 'site_id' => $order_info['site_id']]);

            return $res;
        } else {
            return $this->error();
        }

    }

    /**
     * 订单收货
     *
     * @param int $order_id
     */
    public function orderTakeDelivery($order_id)
    {
        return $this->success();
    }

    /**
     * 退款完成操作
     * @param $order_info
     */
    public function refund($order_goods_info)
    {
        //是否入库
        if ($order_goods_info["is_refund_stock"] == 1) {
            $goods_stock_model = new GoodsStock();
            $item_param        = array(
                "sku_id" => $order_goods_info["sku_id"],
                "num"    => $order_goods_info["num"],
            );
            //返还库存
            $goods_stock_model->incStock($item_param);
        }
    }

    /**
     * 订单详情
     * @param $order_info
     */
    public function orderDetail($order_info)
    {

        $local_package_model  = new LocalPackage();
        $package_info         = $local_package_model->package(['order_id' => $order_info['order_id']]);
        $data['package_list'] = $package_info['data'];
        return $data;
    }
}