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

use app\model\goods\GoodsStock;
use app\model\goods\VirtualGoods;
use app\model\verify\Verify as VerifyModel;

/**
 * 虚拟订单
 *
 * @author Administrator
 *
 */
class VirtualOrder extends OrderCommon
{

    /*****************************************************************************************订单状态***********************************************/
    // 订单创建
    const ORDER_CREATE = 0;

    // 订单已支付
    const ORDER_PAY = 1;

    // 订单已收货
    const ORDER_TAKE_DELIVERY = 4;

    // 订单已结算完成
    const ORDER_COMPLETE = 10;

    // 订单已关闭
    const ORDER_CLOSE = -1;

    /**
     * 订单类型
     *
     * @var int
     */
    public $order_type = 4;

    public $order_status = [
        self::ORDER_CREATE => [
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

        self::ORDER_TAKE_DELIVERY => [
            'status'          => self::ORDER_TAKE_DELIVERY,
            'name'            => '已收货',
            'is_allow_refund' => 1,
            'icon'            => 'upload/uniapp/order/order-icon-received.png',
            'action'          => [
            ],
            'member_action'   => [
            ],
            'color'           => ''
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
     * 订单支付
     * @param unknown $order_info
     */
    public function orderPay($order_info, $pay_type)
    {
        $pay_type_list = $this->getPayType();
        $data          = array(
            "pay_status"       => 1,
            "pay_time"         => time(),
            "is_enable_refund" => 1,
            "pay_type"         => $pay_type,
            "pay_type_name"    => $pay_type_list[$pay_type]
        );
        $res           = model('order')->update($data, [['order_id', "=", $order_info['order_id']]]);

        //虚拟产品发货
        if ($order_info['is_lock'] == 0) {
            $this->orderCommonTakeDelivery($order_info['order_id']);
        }

        return $this->success($res);
    }

    /**
     * 订单自动收发货
     * @param unknown $order_id
     */
    public function orderTakeDelivery($order_id)
    {
        $order_info = model("order")->getInfo([['order_id', '=', $order_id]], 'order_no,site_id,site_name,member_id,order_type,
        sign_time,order_status,delivery_code,create_time,name,pay_time,pay_money,mobile,is_lock,order_money');
        if (empty($order_info))
            return $this->error([], "ORDER_EMPTY");

        model('order')->startTrans();
        try {
            //订单项变为已发货
            model('order_goods')->update(['delivery_status' => 1, "delivery_status_name" => "已发货"], [['order_id', "=", $order_id]]);
            $order_goods_info = model('order_goods')->getInfo([['order_id', '=', $order_id]], 'sku_id,sku_name,sku_image,price,num,order_goods_id');//订单项详情
            //创建待核销记录
            $verify_model        = new VerifyModel();
            $item_array          = array(
                [
                    "img"            => $order_goods_info["sku_image"],
                    "name"           => $order_goods_info["sku_name"],
                    "price"          => $order_goods_info["price"],
                    "num"            => $order_goods_info["num"],
                    "order_goods_id" => $order_goods_info["order_goods_id"],
                    "remark_array"   => [
                        ["title" => "联系人", "value" => $order_info['name'] . $order_info['mobile']]
                    ]
                ],
            );
            $remark_array        = array(
                ["title" => '订单金额', "value" => $order_info["order_money"]],
                ["title" => '订单编号', "value" => $order_info["order_no"]],
                ["title" => '创建时间', "value" => time_to_date($order_info["create_time"])],
                ["title" => '付款时间', "value" => time_to_date($order_info["pay_time"])],
            );
            $verify_content_json = $verify_model->getVerifyJson($item_array, $remark_array);
            $code_result         = $verify_model->addVerify("virtualgoods", $order_info['site_id'], $order_info['site_name'], $verify_content_json);
            $code                = $code_result["data"]["verify_code"];
            $result              = $verify_model->qrcode($code, "all", "virtualgoods", $order_info['site_id'], "create");//生成二维码
            //自动收发货
            $order_data = array(
                'virtual_code' => $code,
            );
            $res        = model('order')->update($order_data, [['order_id', '=', $order_id]]);
            //生成所购买的产品
            $virtual_goods_model = new VirtualGoods();
            $virtual_goods_model->addGoodsVirtual($order_info["site_id"], $order_id, $order_info["order_no"], $order_goods_info["sku_id"], $order_goods_info["sku_name"], $code, $order_info["member_id"], $order_goods_info["sku_image"]);
            model('order')->commit();
            return $this->success($res);
        } catch (\Exception $e) {
            model('order')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 退款完成操作
     * @param $order_info
     */
    public function refund($order_goods_info)
    {
        //删除已退款订单项会员虚拟商品, 并退回商品库存
        //无需判断订单项是否需要入库
        $goods_stock_model = new GoodsStock();
        $item_param        = array(
            "sku_id" => $order_goods_info["sku_id"],
            "num"    => $order_goods_info["num"],
        );
        //返还库存
        $goods_stock_model->incStock($item_param);
        //删除用户的这条虚拟商品
        $goods_virtual_model = new VirtualGoods();
        $goods_virtual_model->deleteGoodsVirtual([["order_id", "=", $order_goods_info["order_id"]], ["member_id", "=", $order_goods_info["member_id"]]]);
    }

    /**
     * 订单详情
     * @param $order_info
     */
    public function orderDetail($order_info)
    {
        $goods_virtual_model = new VirtualGoods();
        $info_result         = $goods_virtual_model->getVirtualGoodsInfo([["order_id", "=", $order_info["order_id"]]]);

        $info                  = $info_result["data"];
        $data["virtual_goods"] = $info;
        return $data;
    }
}