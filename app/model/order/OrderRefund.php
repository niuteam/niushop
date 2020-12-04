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
use app\model\member\MemberAccount;
use app\model\shop\Shop;
use app\model\system\Pay;
use app\model\BaseModel;
use app\model\message\Message;

/**
 * 订单退款
 *
 * @author Administrator
 *
 */
class OrderRefund extends BaseModel
{
    /*********************************************************************************订单退款状态*****************************************************/
    //已申请退款
    const REFUND_APPLY = 1;

    // 已确认
    const REFUND_CONFIRM = 2;

    //已完成
    const REFUND_COMPLETE = 3;

    //等待买家发货
    const REFUND_WAIT_DELIVERY = 4;

    //等待卖家收货
    const REFUND_WAIT_TAKEDELIVERY = 5;
    //卖家确认收货
    const REFUND_TAKEDELIVERY = 6;

    // 卖家拒绝退款
    const REFUND_DIEAGREE = -1;

    // 卖家关闭退款
    const REFUND_CLOSE = -2;

    const ONLY_REFUNDS = 1;//仅退款
    const A_REFUND_RETURN = 2;//退款退货
    /**
     * 订单退款状态
     * @var unknown
     */
    public $order_refund_status = [
        0 => [
            'status' => 0,
            'name' => '',
            'action' => [

            ],
            'member_action' => [
                [
                    'event' => 'orderRefundApply',
                    'title' => '申请维权',
                    'color' => ''
                ],
            ]
        ],
        self::REFUND_APPLY => [
            'status' => self::REFUND_APPLY,
            'name' => '申请维权',
            'action' => [
                [
                    'event' => 'orderRefundAgree',
                    'title' => '同意',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundRefuse',
                    'title' => '拒绝',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundClose',
                    'title' => '关闭维权',
                    'color' => ''
                ]
            ],
            'member_action' => [
                [
                    'event' => 'orderRefundCancel',
                    'title' => '撤销维权',
                    'color' => ''
                ],
            ]
        ],
        self::REFUND_CONFIRM => [
            'status' => self::REFUND_CONFIRM,
            'name' => '待转账',
            'action' => [
                [
                    'event' => 'orderRefundTransfer',
                    'title' => '转账',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundClose',
                    'title' => '关闭维权',
                    'color' => ''
                ]
            ],
            'member_action' => [

            ]
        ],
        self::REFUND_COMPLETE => [
            'status' => self::REFUND_COMPLETE,
            'name' => '维权结束',
            'action' => [

            ],
            'member_action' => [

            ]
        ],
        self::REFUND_WAIT_DELIVERY => [
            'status' => self::REFUND_WAIT_DELIVERY,
            'name' => '买家待退货',
            'action' => [
                [
                    'event' => 'orderRefundClose',
                    'title' => '关闭维权',
                    'color' => ''
                ]
            ],
            'member_action' => [
                [
                    'event' => 'orderRefundDelivery',
                    'title' => '填写发货物流',
                    'color' => ''
                ],
            ]
        ],
        self::REFUND_WAIT_TAKEDELIVERY => [
            'status' => self::REFUND_WAIT_TAKEDELIVERY,
            'name' => '卖家待收货',
            'action' => [
                [
                    'event' => 'orderRefundTakeDelivery',
                    'title' => '收货',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundRefuse',
                    'title' => '拒绝',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundClose',
                    'title' => '关闭维权',
                    'color' => ''
                ]
            ],
            'member_action' => [

            ]
        ],
        self::REFUND_TAKEDELIVERY => [
            'status' => self::REFUND_TAKEDELIVERY,
            'name' => '卖家已收货',
             'action' => [
                [
                    'event' => 'orderRefundTransfer',
                    'title' => '转账',
                    'color' => ''
                ],
                [
                     'event' => 'orderRefundClose',
                     'title' => '关闭维权',
                     'color' => ''
                ]
            ],
            'member_action' => [

            ]
        ],
        self::REFUND_DIEAGREE => [
            'status' => self::REFUND_DIEAGREE,
            'name' => '卖家拒绝',
            'action' => [
                [
                    'event' => 'orderRefundClose',
                    'title' => '关闭维权',
                    'color' => ''
                ]
            ],
            'member_action' => [
                [
                    'event' => 'orderRefundCancel',
                    'title' => '撤销维权',
                    'color' => ''
                ],
                [
                    'event' => 'orderRefundAsk',
                    'title' => '修改申请',
                    'color' => ''
                ],
            ]
        ]

    ];

    /**
     * 退款方式
     * @var unknown
     */
    public $refund_type = [
        self::ONLY_REFUNDS => '仅退款',
        self::A_REFUND_RETURN => '退货退款',
    ];

    /**
     * 退款方式
     * @var unknown
     */
    public $refund_reason_type = [
        '未按约定时间发货',
        '拍错/多拍/不喜欢',
        '协商一致退款',
        '其他',
    ];

    /****************************************************************************订单退款相关操作（开始）**********************************/

    /**
     * 获取退款金额
     * @param int $order_goods_id
     */
    public function getOrderRefundMoney($order_goods_id)
    {
        //订单商品项
        $order_goods_info = model('order_goods')->getInfo([
            'order_goods_id' => $order_goods_id
        ]);
        $count = model("order_goods")->getCount([ [ 'order_id', '=', $order_goods_info[ 'order_id' ] ], [ 'refund_status', '=', 0 ], [ 'order_goods_id', '<>', $order_goods_id ] ], 'order_goods_id');
        if ($count > 0) {
            $delivery_money = 0;
            $invoice_delivery_money = 0;
            $invoice_money = 0;
        } else {
            //订单整体项
            $order_info = model('order')->getInfo([ 'order_id' => $order_goods_info[ 'order_id' ]
            ], 'delivery_money, invoice_delivery_money, invoice_money');
            $delivery_money = $order_info[ 'delivery_money' ];
            $invoice_delivery_money = $order_info[ 'invoice_delivery_money' ];
            $invoice_money = $order_info[ 'invoice_money' ];
        }
        //todo  退款是最后要退物流费用  以及 发票相关项
        $refund_money = $order_goods_info[ 'real_goods_money' ] + $delivery_money + $invoice_delivery_money + $invoice_money;
        return $refund_money;
    }

    /**
     * 订单退回余额
     * @param int $order_goods_id
     */
    public function getOrderRefundBalance($order_goods_id)
    {
        //订单商品项
        $order_goods_info = model('order_goods')->getInfo([
            'order_goods_id' => $order_goods_id
        ], 'order_id, goods_money');
        //订单整体项
        $order_info = model('order')->getInfo([
            'order_id' => $order_goods_info[ 'order_id' ]
        ], 'goods_money, balance_money');
        if ($order_info[ 'balance_money' ] != 0) {
            if ($order_info[ 'goods_money' ] != 0) {
                return $this->success($order_info[ 'balance_money' ] * $order_goods_info[ 'goods_money' ] / $order_info[ 'goods_money' ]);
            } else {
                return $this->success(0);
            }
        }
        return $this->success(0);
    }

    /**
     * 添加退款操作日志
     * @param int $order_goods_id
     * @param int $refund_status
     * @param string $action
     * @param int $action_way
     * @param int $action_userid
     * @param string $action_username
     */
    public function addOrderRefundLog($order_goods_id, $refund_status, $action, $action_way, $action_userid, $action_username, $desc = '')
    {
        $data = [
            'order_goods_id' => $order_goods_id,
            'refund_status' => $refund_status,
            'action' => $action,
            'action_way' => $action_way,
            'action_userid' => $action_userid,
            'username' => $action_username,
            'action_time' => time(),
            'desc' => $desc
        ];
        $res = model('order_refund_log')->add($data);
        return $res;
    }

    /**
     * 会员申请退款
     * @param array $data
     * @param array $member_info
     * @return multitype:string mixed
     */
    public function orderRefundApply($data, $member_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ], 'order_id,refund_status,delivery_status,is_virtual,site_id');
        if (empty($order_goods_info))
            return $this->error();

        if ($order_goods_info[ 'refund_status' ] != 0 && $order_goods_info[ 'refund_status' ] != -1)
            return $this->error();

        $refund_type_list = $this->getRefundType($order_goods_info);
        //防止退款方式越权
        if (!in_array($data[ "refund_type" ], $refund_type_list))
            return $this->error();


        $order_info = model('order')->getInfo([ 'order_id' => $order_goods_info[ 'order_id' ] ]);
        //判断是否允许申请退款
        if ($order_info[ 'is_enable_refund' ] == 0) {
            return $this->error();
        }

        model('order_goods')->startTrans();
        try {

            $data[ 'refund_status' ] = self::REFUND_APPLY;
            $data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_APPLY ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_APPLY ], JSON_UNESCAPED_UNICODE);
            $data[ 'refund_type' ] = $data[ "refund_type" ];
            $data[ 'refund_remark' ] = $data[ "refund_remark" ];

            $pay_model = new Pay();
            $data[ 'refund_no' ] = $pay_model->createRefundNo();
            $data[ 'refund_action_time' ] = time();
            $refund_apply_money = $this->getOrderRefundMoney($data[ 'order_goods_id' ]);//可退款金额 通过计算获得
            $data[ 'refund_apply_money' ] = $refund_apply_money;
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);

            //验证订单锁定状态
            $local_result = $this->verifyOrderLock($order_goods_info[ "order_id" ]);

            $this->addOrderRefundLog($data[ 'order_goods_id' ], self::REFUND_APPLY, '买家申请退款', 1, $member_info[ 'member_id' ], $member_info[ 'nickname' ]);
            event('orderRefundApply', $data);//传入订单类型以及订单项id
            model('order_goods')->commit();

            //订单会员申请退款消息
            $message_model = new Message();
            $message_model->sendMessage([ 'keywords' => "BUYER_REFUND", 'order_goods_id' => $data[ 'order_goods_id' ], 'site_id' => $order_goods_info[ 'site_id' ] ]);

            return $this->success($res);
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 用户撤销退款申请
     * @param array $data
     * @param array $member_info
     * @return string[]|mixed[]
     */
    public function memberCancelRefund($data, $member_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
//            $order_info = model('order')->getInfo(['order_id' => $order_goods_info['order_id']]);
            $data[ 'refund_status' ] = 0;
            $data[ 'refund_status_name' ] = $this->order_refund_status[ 0 ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ 0 ], JSON_UNESCAPED_UNICODE);
            $data[ 'refund_type' ] = 0;
            //重置部分字段
            $data[ "refund_address" ] = "";
            $data[ "refund_delivery_remark" ] = "";
            $data[ "refund_remark" ] = "";
            $data[ "refund_delivery_name" ] = "";
            $data[ "refund_delivery_no" ] = "";
            $data[ "refund_reason" ] = "";
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);

            //验证订单锁定状态
            $lock_result = $this->verifyOrderLock($order_goods_info[ "order_id" ]);

            $this->addOrderRefundLog($data[ 'order_goods_id' ], 0, '买家撤销退款申请', 1, $member_info[ 'member_id' ], $member_info[ 'nickname' ]);
            event('memberCancelRefund', $data);//传入订单类型以及订单项id
            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 卖家确认退款
     * @param array $data
     * @param array $user_info
     */
    public function orderRefundConfirm($data, $user_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        if ($order_goods_info[ 'refund_status' ] != self::REFUND_APPLY) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
            if ($order_goods_info[ 'refund_type' ] == 1) {
                $data[ 'refund_status' ] = self::REFUND_CONFIRM;  //确认等待转账
            } else {
                $data[ 'refund_status' ] = self::REFUND_WAIT_DELIVERY;  //确认等待买家发货
            }
            $data[ 'refund_status_name' ] = $this->order_refund_status[ $data[ 'refund_status' ] ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ $data[ 'refund_status' ] ], JSON_UNESCAPED_UNICODE);

            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
            $this->addOrderRefundLog($data[ 'order_goods_id' ], $data[ 'refund_status' ], '卖家确认退款', 2, $user_info[ 'uid' ], $user_info[ 'username' ]);
            model('order_goods')->commit();

            //订单退款同意消息
            $message_model = new Message();
            $message_model->sendMessage([ 'keywords' => "ORDER_REFUND_AGREE", 'order_id' => $order_goods_info[ 'order_id' ], "order_goods_id" => $data[ 'order_goods_id' ], "site_id" => $order_goods_info[ 'site_id' ] ]);
            return $this->success($res);
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 卖家拒绝退款
     * @param array $data
     * @param array $user_info
     */
    public function orderRefundRefuse($data, $user_info, $refund_refuse_reason)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        if ($order_goods_info[ 'refund_status' ] != self::REFUND_APPLY && $order_goods_info[ 'refund_status' ] != self::REFUND_WAIT_TAKEDELIVERY) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
            $data[ 'refund_status' ] = self::REFUND_DIEAGREE;
            $data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_DIEAGREE ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_DIEAGREE ], JSON_UNESCAPED_UNICODE);
            $data[ "refund_refuse_reason" ] = $refund_refuse_reason;

            $data[ "refund_action_time" ] = time();
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
            //验证订单锁定状态
            $lock_result = $this->verifyOrderLock($order_goods_info[ "order_id" ]);

            $log_desc = empty($refund_refuse_reason) ? '' : '拒绝原因：' . $refund_refuse_reason;
            $this->addOrderRefundLog($data[ 'order_goods_id' ], $data[ 'refund_status' ], '卖家拒绝退款', 2, $user_info[ 'uid' ], $user_info[ 'username' ], $log_desc);
            event("OrderRefundRefuse", $data);
            model('order_goods')->commit();

            //订单退款拒绝消息
            $message_model = new Message();
            $message_model->sendMessage([ 'keywords' => "ORDER_REFUND_REFUSE", 'order_id' => $order_goods_info[ 'order_id' ], "order_goods_id" => $data[ 'order_goods_id' ], "site_id" => $order_goods_info[ 'site_id' ] ]);
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 买家退货
     * @param array $data 退货信息
     * @param array $member_info 会员信息
     */
    public function orderRefundDelivery($data, $member_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        if ($order_goods_info[ 'refund_status' ] != self::REFUND_WAIT_DELIVERY) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
            $data[ 'refund_status' ] = self::REFUND_WAIT_TAKEDELIVERY;
            $data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_WAIT_TAKEDELIVERY ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_WAIT_TAKEDELIVERY ], JSON_UNESCAPED_UNICODE);
            $shop_model = new Shop();
            $shop_info_result = $shop_model->getShopInfo([ [ "site_id", "=", $order_goods_info[ "site_id" ] ] ], "full_address");
            $shop_info = $shop_info_result[ "data" ];
            $data[ "refund_address" ] = $shop_info[ "full_address" ];
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);

            $this->addOrderRefundLog($data[ 'order_goods_id' ], $data[ 'refund_status' ], $data[ 'refund_delivery_name' ] . ':' . $data[ 'refund_delivery_no' ], 1, $member_info[ 'member_id' ], $member_info[ 'nickname' ]);
            model('order_goods')->commit();

            //买家已退货提醒
            $message_model = new Message();
            $message_model->sendMessage(['keywords' => "BUYER_DELIVERY_REFUND", 'order_goods_info' => $order_goods_info, 'site_id' => $order_goods_info['site_id']]);

            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 卖家确认收到退货
     * @param array $data 退货信息
     * @param array $member_info 会员信息
     */
    public function orderRefundTakeDelivery($data, $user_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        if ($order_goods_info[ 'refund_status' ] != self::REFUND_WAIT_TAKEDELIVERY) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
            $data[ 'refund_status' ] = self::REFUND_TAKEDELIVERY;
            $data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_TAKEDELIVERY ][ "name" ];
            $data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_TAKEDELIVERY ], JSON_UNESCAPED_UNICODE);
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
            $this->addOrderRefundLog($data[ 'order_goods_id' ], $data[ 'refund_status' ], '卖家确认收到退货', 2, $user_info[ 'uid' ], $user_info[ 'username' ]);
            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 退货完成
     * @param array $data
     * @param array $user_info
     * @return multitype:string mixed
     */
    public function orderRefundFinish($data, $user_info)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $data[ 'order_goods_id' ] ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }

        if ($order_goods_info[ 'refund_status' ] != self::REFUND_TAKEDELIVERY && $order_goods_info[ 'refund_status' ] != self::REFUND_CONFIRM) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {

            $update_data = array (
                "refund_time" => time(),
                "refund_real_money" => $order_goods_info[ "refund_apply_money" ]
            );
            $update_data[ 'refund_status' ] = self::REFUND_COMPLETE;
            $update_data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_COMPLETE ][ "name" ];
            $update_data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_COMPLETE ], JSON_UNESCAPED_UNICODE);
            $res = model('order_goods')->update($update_data, [ [ 'order_goods_id', "=", $data[ 'order_goods_id' ] ] ]);

            $result = $this->finishAction($data[ 'order_goods_id' ]);
            if ($result[ 'code' ] < 0) {
                model('order_goods')->rollback();
                return $result;
            }
            $order_info = model('order')->getInfo([ 'order_id' => $order_goods_info[ 'order_id' ] ]);
            //调用各种订单
            switch ( $order_info[ 'order_type' ] ) {
                case 1:
                    $order_model = new Order();
                    break;
                case 2:
                    $order_model = new StoreOrder();
                    break;
                case 3:
                    $order_model = new LocalOrder();
                    break;
                case 4:
                    $order_model = new VirtualOrder();
                    break;
            }
            //退货日志
            $this->addOrderRefundLog($data[ 'order_goods_id' ], self::REFUND_COMPLETE, '维权完成', 2, $user_info[ 'uid' ], $user_info[ 'username' ]);

            $order_goods_info = model("order_goods")->getInfo([ [ "order_goods_id", "=", $data[ 'order_goods_id' ] ] ]);
            $order_model->refund($order_goods_info);
            //同时修改用户的order_money
            model('member')->setDec([ [ 'member_id', '=', $order_goods_info[ 'member_id' ] ] ], 'order_money', $order_goods_info[ 'refund_real_money' ]);

//            event('OrderRefundFinish', $order_goods_info);//传入订单类型以及订单项id
            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }


    /**
     * 退款完成操作
     * @param $data
     * @param $user_info
     * @return array
     */
    public function finishAction($order_goods_id)
    {
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $order_goods_id ]);

        model('order_goods')->startTrans();
        try {
            $order_info = model('order')->getInfo([ 'order_id' => $order_goods_info[ 'order_id' ] ]);

            //验证订单是否全部退款完毕
            $order_goods_count = model("order_goods")->getCount([ [ "order_id", "=", $order_goods_info[ 'order_id' ] ] ], "order_goods_id");
            $refund_count = model("order_goods")->getCount([ [ "order_id", "=", $order_goods_info[ 'order_id' ] ], [ "refund_status", "=", self::REFUND_COMPLETE ] ], "order_goods_id");
            $refund_total_real_money = model("order_goods")->getSum([ [ "order_id", "=", $order_goods_info[ 'order_id' ] ], [ "refund_status", "=", self::REFUND_COMPLETE ] ], "refund_real_money");

            if ($refund_total_real_money > $order_info[ "order_money" ]) {
                model('order_goods')->rollback();
                return $this->error([], "退款金额不能大于订单总金额");
            }

            //实际执行转账 (存在余额支付的话   退款一部分余额  退还一部分实际金额)  //订单退款退回余额积分等操作
            if ($order_info[ "balance_money" ] > 0) {
//                if($order_goods_count == $refund_count){
//                    $refunded_balance_money = model("order_goods")->getSum([["order_id", "=", $order_goods_info['order_id']], ["refund_status", "=", self::REFUND_COMPLETE]], "order_goods_id");
//                    $refunded_balance_money = model("order_goods")->getSum([["order_id", "=", $order_goods_info['order_id']], ["refund_status", "=", self::REFUND_COMPLETE]], "order_goods_id");
//                    $refund_balance_money = $order_info["balance_money"] - $refunded_balance_money;
//                    $refund_pay_money = $order_info["pay_money"] - $refund_balance_money;
//                }else{
                $balance_rate = $order_info[ "balance_money" ] / $order_info[ "order_money" ];
                $refund_balance_money = $order_goods_info[ "refund_real_money" ] * $balance_rate;
                $refund_pay_money = $order_goods_info[ "refund_real_money" ] - $refund_balance_money;
//                }
            } else {
                $refund_balance_money = 0;
                $refund_pay_money = $order_goods_info[ "refund_real_money" ];
            }

            $addon_result = event('AddonOrderRefund', [ 'order_no' => $order_info[ 'order_no' ], 'promotion_type' => $order_info[ 'promotion_type' ] ], true);
            if (empty($addon_result)) {
                //退还直接支付的金额
                if ($refund_pay_money > 0) {
                    $pay_model = new Pay();
                    $refund_result = $pay_model->refund($order_goods_info[ "refund_no" ], $refund_pay_money, $order_info[ "out_trade_no" ], '', $order_info[ "pay_money" ], $order_info[ "site_id" ], 1);
                    if ($refund_result[ "code" ] < 0) {
                        model('order_goods')->rollback();
                        return $refund_result;
                    }
                }
            } else {
                if ($addon_result[ 'code' ] < 0) {
                    model('order_goods')->rollback();
                    return $addon_result;
                }
            }

            //退款余额
            if ($refund_balance_money > 0) {
                $member_account_model = new MemberAccount();
                $balance_result = $member_account_model->addMemberAccount($order_info[ 'site_id' ], $order_info[ "member_id" ], "balance", $refund_balance_money, "refund", "余额返还", "订单退款,返还余额:" . $refund_balance_money);
                if ($balance_result[ "code" ] < 0) {
                    model('order_goods')->rollback();
                    return $balance_result;
                }
            }
            // 退还积分
            if ($order_goods_info[ 'use_point' ] > 0) {
                $member_account_model = new MemberAccount();
                $point_result = $member_account_model->addMemberAccount($order_info[ 'site_id' ], $order_info[ "member_id" ], "point", $order_goods_info[ 'use_point' ], "refund", "积分返还", "订单退款,返还积分:" . $order_goods_info[ 'use_point' ]);
                if ($point_result[ "code" ] < 0) {
                    model('order_goods')->rollback();
                    return $point_result;
                }
            }

            // 未发货订单项自动退回库存
            if ($order_goods_info[ 'delivery_status' ] == Order::DELIVERY_WAIT) {
                $goods_stock_model = new GoodsStock();
                $goods_stock_model->incStock(["sku_id" => $order_goods_info["sku_id"], "num" => $order_goods_info["num"]]);
            }

            //验证订单锁定状态
            $lock_result = $this->verifyOrderLock($order_goods_info[ "order_id" ]);

            //验证订单是否全部退款完毕  订单如果全部退款完毕,订单关闭
            if ($order_goods_count == $refund_count) {
                $order_common_model = new OrderCommon();
                $close_result = $order_common_model->orderClose($order_goods_info[ "order_id" ]);
                if ($close_result[ "code" ] < 0) {
                    model('order_goods')->rollback();
                    return $close_result;
                }
            }

            //订单累加 退款
            model('order')->update([ 'refund_money' => $refund_total_real_money ], [ [ "order_id", "=", $order_goods_info[ 'order_id' ] ] ]);
            event('OrderRefundFinish', $order_goods_info);//传入订单类型以及订单项id
            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 判断当前订单是否全部退款完毕
     * @param $order_id
     */
    public function verifyOrderAllRefund($order_id)
    {
        //验证订单是否全部退款完毕  订单如果全部退款完毕,订单关闭
        $order_goods_count = model("order_goods")->getCount([ [ "order_id", "=", $order_id ] ], "order_goods_id");
        $refund_count = model("order_goods")->getCount([ [ "order_id", "=", $order_id ], [ "refund_status", "=", self::REFUND_COMPLETE ] ], "order_goods_id");
        if ($order_goods_count == $refund_count) {
            //调用订单关闭
            $order_common_model = new OrderCommon();
            $close_result = $order_common_model->orderClose($order_id);
            if ($close_result[ "code" ] < 0) {
                return $close_result;
            }
        } else {
            return $this->success();
        }
    }

    /**
     * 获取订单售后操作列表
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getOrderRefundLogList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('order_refund_log')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取退款维权订单列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getRefundOrderGoodsPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'nop.*,no.order_no,no.site_id,no.site_name')
    {
        $join = [
            [
                'order no',
                'nop.order_id = no.order_id',
                'left'
            ],
        ];
        $list = model('order_goods')->pageList($condition, $field, $order, $page, $page_size, 'nop', $join);
        if (!empty($list[ "list" ])) {
            foreach ($list[ "list" ] as $k => $v) {
                $refund_action = empty($v[ "refund_status_action" ]) ? [] : json_decode($v[ "refund_status_action" ], true);
                $refund_member_action = $refund_action[ "member_action" ] ?? [];
                $list[ 'list' ][ $k ][ 'refund_action' ] = $refund_member_action;
            }
        }
        return $this->success($list);
    }

    /**
     * 获取退款维权订单数量
     * @param array $condition
     */
    public function getRefundOrderGoodsCount($condition = [])
    {
        $count = model('order_goods')->getCount($condition);
        return $this->success($count);
    }

    /**
     * 初始化订单项退款操作
     * @param $order_id
     */
    public function initOrderGoodsRefundAction($condition)
    {
        //订单项增加可退款操作
        $data = array (
            "refund_status_action" => json_encode($this->order_refund_status[ 0 ], JSON_UNESCAPED_UNICODE)
        );
        $result = model("order_goods")->update($data, $condition);
        return $this->success($result);
    }

    /**
     * 移除订单项退款操作
     * @param $order_id
     */
    public function removeOrderGoodsRefundAction($condition)
    {
        //订单项增加可退款操作
        $data = array (
            "refund_status_action" => ''
        );
        $result = model("order_goods")->update($data, $condition);
        return $this->success($result);
    }

    /**
     * 会员维权详情
     * @param $order_goods_id
     */
    public function getMemberRefundDetail($order_goods_id, $member_id)
    {
        $condition = array (
            [ "order_goods_id", "=", $order_goods_id ]
        );

        $condition[] = [ "member_id", "=", $member_id ];

        $info = model("order_goods")->getInfo($condition);
        $refund_action = empty($info[ "refund_status_action" ]) ? [] : json_decode($info[ "refund_status_action" ], true);
        $refund_member_action = $refund_action[ "member_action" ] ?? [];
        $info[ 'refund_action' ] = $refund_member_action;

        //将售后日志引入
        $refund_log_list = model("order_refund_log")->getList([ [ "order_goods_id", "=", $order_goods_id ] ], "*", "action_time desc");
        $info[ 'refund_log_list' ] = $refund_log_list;
        return $this->success($info);
    }

    /**
     * 会员维权详情
     * @param $order_goods_id
     */
    public function getRefundDetail($order_goods_id)
    {
        $condition = array (
            [ "order_goods_id", "=", $order_goods_id ]
        );
        $info = model("order_goods")->getInfo($condition);
        $refund_action = empty($info[ "refund_status_action" ]) ? [] : json_decode($info[ "refund_status_action" ], true);
        $refund_action = $refund_action[ "action" ] ?? [];
        $info[ 'refund_action' ] = $refund_action;
        //将售后日志引入
        $refund_log_list = model("order_refund_log")->getList([ [ "order_goods_id", "=", $order_goods_id ] ], "*", "action_time desc");
        $info[ 'refund_log_list' ] = $refund_log_list;
        return $this->success($info);
    }

    /**
     * 根据配送状态获取退款方式
     * @param $refund_status
     */
    public function getRefundType($order_goods_info)
    {
        if ($order_goods_info[ "is_virtual" ] == 1) {
            return [ self::ONLY_REFUNDS ];
        } else {
            if ($order_goods_info[ "delivery_status" ] == 0) {
                return [ self::ONLY_REFUNDS ];
            } else {
                return [ self::ONLY_REFUNDS, self::A_REFUND_RETURN ];
            }
        }

    }
    /****************************************************************************订单退款相关操作（结束）**********************************/

    /********************************************************************** 主动退款 ********************************************************************/
    /**
     * 主动完成退款流程
     * @param $order_id
     */
    public function activeRefund($order_id, $remark, $refund_reason)
    {
        $order_info = model("order")->getInfo([ [ "order_id", "=", $order_id ] ], "pay_money, out_trade_no, site_id, delivery_money");
        if ($order_info[ "pay_money" ] > 0) {
            $pay_model = new Pay();
            //遍历订单项
            $order_goods_list = model("order_goods")->getList([ [ "order_id", "=", $order_id ] ]);
            if (!empty($order_goods_list)) {
                $count = count($order_goods_list);
                foreach ($order_goods_list as $k => $v) {
                    $item_refund_money = $v[ "real_goods_money" ];
                    if ($count == ( $k + 1 )) {
                        $item_refund_money += $order_info[ "delivery_money" ];
                    }
                    $item_result = $this->activeOrderGoodsRefund($v[ "order_goods_id" ], $item_refund_money, $remark, $refund_reason);
                    if ($item_result[ "code" ] < 0) {
                        return $item_result;
                    }
                }
            }

            //订单整体退款
//            $refund_result = $pay_model->refund($refund_no, $order_info["pay_money"], $order_info["out_trade_no"], '', $order_info["pay_money"], $order_info["site_id"], 1);
            return $this->success();
        } else {
            return $this->success();
        }

    }

    /**
     * 订单项主动退款
     * @param $order_goods_id
     * @param $refund_money
     * @return array|mixed|void
     */
    public function activeOrderGoodsRefund($order_goods_id, $refund_money, $remark = '', $refund_reason = '')
    {
        model('order_goods')->startTrans();
        try {
            $pay_model = new Pay();
            $refund_no = $pay_model->createRefundNo();

            $update_data = array (
                "refund_no" => $refund_no,
                "refund_time" => time(),
                "refund_reason" => $refund_reason,
                "refund_apply_money" => $refund_money,
                "refund_real_money" => $refund_money,
                "refund_action_time" => time()
            );
            $update_data[ 'refund_status' ] = self::REFUND_COMPLETE;
            $update_data[ 'refund_status_name' ] = $this->order_refund_status[ self::REFUND_COMPLETE ][ "name" ];
            $update_data[ 'refund_status_action' ] = json_encode($this->order_refund_status[ self::REFUND_COMPLETE ], JSON_UNESCAPED_UNICODE);
            $res = model('order_goods')->update($update_data, [ [ 'order_goods_id', "=", $order_goods_id ] ]);
            if ($res === false) {
                model('order_goods')->rollback();
                return $this->error();
            }
            $refund_result = $this->finishAction($order_goods_id);
            if ($refund_result[ 'code' ] < 0) {
                model('order_goods')->rollback();
                return $this->error();
            }
            //退货日志
            $this->addOrderRefundLog($order_goods_id, self::REFUND_COMPLETE, $remark . ',维权完成', 3, 0, "平台");

            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /********************************************************************** 主动退款 ********************************************************************/
    /**
     * 判断订单的锁定状态
     * @param $order_goods_id
     */
    public function verifyOrderLock($order_id)
    {
        $condition = array (
            [ "order_id", "=", $order_id ],
            [ "refund_status", "not in", [ 0, 3 ] ],
        );
        $count = model("order_goods")->getCount($condition, "order_goods_id");

        $order_common_model = new OrderCommon();

        if ($count > 0) {
            $res = $order_common_model->orderLock($order_id);
        } else {
            $res = $order_common_model->orderUnlock($order_id);

        }

        return $res;
    }

    /**
     * 关闭退款
     * @param $order_goods_id
     * @param $site_id
     */
    public function orderRefundClose($order_goods_id, $site_id, $user_info){
        $order_goods_info = model('order_goods')->getInfo([ 'order_goods_id' => $order_goods_id, 'site_id' => $site_id ]);
        if (empty($order_goods_info)) {
            return $this->error();
        }
        model('order_goods')->startTrans();
        try {
            $data = [
                'order_goods_id' => $order_goods_id,
                'refund_status' => 0,
                'refund_status_name' => $this->order_refund_status[ 0 ][ "name" ],
                'refund_status_action' => json_encode($this->order_refund_status[ 0 ], JSON_UNESCAPED_UNICODE),
                'refund_type' => 0,
                'refund_address' => '',
                'refund_delivery_remark' => '',
                'refund_remark' => '',
                'refund_delivery_name' => '',
                'refund_delivery_no' => '',
                'refund_reason' => ''
            ];
            $res = model('order_goods')->update($data, [ 'order_goods_id' => $order_goods_id ]);

            //验证订单锁定状态
            $lock_result = $this->verifyOrderLock($order_goods_info[ "order_id" ]);

            $this->addOrderRefundLog($data[ 'order_goods_id' ], 0, '卖家关闭本次维权', 2, $user_info[ 'uid' ], $user_info[ 'username' ]);
            event('memberCancelRefund', $data);//传入订单类型以及订单项id
            model('order_goods')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('order_goods')->rollback();
            return $this->error('', $e->getMessage());
        }
    }
}