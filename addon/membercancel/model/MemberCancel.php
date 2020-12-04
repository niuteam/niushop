<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\membercancel\model;

use addon\fenxiao\model\Fenxiao;
use addon\fenxiao\model\FenxiaoOrder;
use app\model\BaseModel;
use app\model\member\Config as ConfigModel;
use app\model\message\Message;
use app\model\message\Sms;
use app\model\order\OrderCommon;
use app\model\order\OrderRefund;
use app\model\shop\ShopAcceptMessage;
use addon\wechat\model\Message as WechatMessage;
use think\facade\Cache;

/**
 * 会员注销
 */
class MemberCancel extends BaseModel
{

    /**
     * 申请注销
     * @param $member_id
     * @param $site_id
     * @return array
     */
    public function applyMemberCancel($param)
    {
        //获取注销配置
        $config_model = new ConfigModel();
        $config_info = $config_model->getCancelConfig($param['site_id'], 'shop');
        $value = $config_info['data']['value'];
        if ($value['is_enable'] == 0) {
            return $this->error('', '未开放注销');
        }

        //获取用户信息
        $member_info = model('member')->getInfo(
            [
                ['site_id', '=', $param['site_id']],
                ['member_id', '=', $param['member_id']],
                ['is_delete', '=', 0]
            ]
        );
        if (empty($member_info)) {
            return $this->error('', '会员不存在');
        }
        if ($member_info['balance_withdraw_apply'] > 0) {
            return $this->error('', '有余额正在提现中，请提现成功后在申请注销');
        }
        $member_json = json_encode($member_info);

        //判断是否申请过
        $member_cancel_info = model('member_cancel')->getInfo([['site_id', '=', $param['site_id']], ['member_id', '=', $param['member_id']]]);
        if (!empty($member_cancel_info)) {
            if ($member_cancel_info['status'] != -1) {
                return $this->error('', '请勿重复申请注销');
            }
        }

        //判断是否有未完成的订单
        $order_condition = [
            ['site_id', '=', $param['site_id']],
            ['member_id', '=', $param['member_id']],
            ['order_status', 'in', [1, 3, 4]]
        ];
        $order_count = model('order')->getCount($order_condition);
        if ($order_count > 0) {
            return $this->error('', '还有订单未完成，请等订单完成后在申请注销');
        }

        //分销
        $fenxiao_json = '';
        if (addon_is_exit('fenxiao', $param['site_id']) == 1) {
            //获取分销商信息
            $fenxiao_info = model('fenxiao')->getInfo([['site_id', '=', $param['site_id']], ['member_id', '=', $param['member_id']]]);
            if (!empty($fenxiao_info)) {
                if ($fenxiao_info['account_withdraw_apply'] > 0) {
                    return $this->error('', '有分销佣金正在提现中，请提现成功后在申请注销');
                }

                //判断是否存在未结算的分销订单
                $fenxiao_condition = [
                    ['site_id', '=', $param['site_id']],
                    ['one_fenxiao_id|two_fenxiao_id|three_fenxiao_id', '=', $fenxiao_info['fenxiao_id']],
                    ['is_settlement', '=', 0]
                ];
                $fenxiao_order_count = model('fenxiao_order')->getCount($fenxiao_condition);
                if ($fenxiao_order_count > 0) {
                    return $this->error('', '还有分销订单未结算，请等订单结算后在申请注销');
                }

                $fenxiao_json = json_encode($fenxiao_info);
            }
        }

        model('member_cancel')->startTrans();
        try {
            if (!empty($member_cancel_info)) {
                $id = $member_cancel_info['id'];
                $data = [
                    'status' => 0,
                    'audit_uid' => '',
                    'audit_username' => '',
                    'reason' => '',
                    'audit_time' => ''
                ];
                model('member_cancel')->update($data, [['id', '=', $id]]);

            } else {
                $data = [
                    'member_id' => $member_info['member_id'],
                    'site_id' => $param['site_id'],
                    'username' => $member_info['username'],
                    'mobile' => $member_info['mobile'],
                    'nickname' => $member_info['nickname'],
                    'create_time' => time(),
                    'member_json' => $member_json,
                    'fenxiao_json' => $fenxiao_json
                ];
                $id = model('member_cancel')->add($data);
            }


            //审核开关关闭
            if ($value['is_audit'] == 0) {
                //todo 调用审核成功接口
                $param['id'] = $id;
                $param['audit_uid'] = '';
                $param['audit_username'] = '';
                $res = $this->memberCancelAuditPass($param);
                if ($res['code'] < 0) {
                    model('member_cancel')->rollback();
                    return $res;
                }
            }
            model('member_cancel')->commit();

            //会员申请注销消息
            $message_model = new Message();
            $message_model->sendMessage(['keywords' => "USER_CANCEL_APPLY", 'member_id' => $member_info['member_id'], 'site_id' => $param['site_id']]);

            return $this->success();
        } catch (\Exception $e) {
            model('member_cancel')->rollback();
            return $this->error('', $e->getMessage());
        }
    }


    /**
     * 撤销申请注销
     * @param $member_id
     * @param $site_id
     * @return array
     */
    public function cancelApplyMemberCancel($member_id, $site_id)
    {
        $member_cancel_info = model('member_cancel')->getInfo(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id]
            ]
        );
        if (empty($member_cancel_info)) {
            return $this->error('', '数据不合法');
        }
        if ($member_cancel_info['status'] == 1) {
            return $this->error('', '数据不合法');
        }

        $res = model('member_cancel')->delete([['member_id', '=', $member_id], ['site_id', '=', $site_id]]);
        return $this->success($res);
    }

    /**
     * 审核通过
     * @param $condition
     * @return array
     */
    public function memberCancelAuditPass($param)
    {
        $info = model('member_cancel')->getInfo([['id', '=', $param['id']], ['site_id', '=', $param['site_id']]], 'member_id,status');
        if (empty($info)) {
            return $this->error('', '请核实数据后重试');
        }
        if ($info['status'] != 0) {
            return $this->error('', '该数据已审核，请勿重复审核');
        }

        model('member_cancel')->startTrans();
        try {

            //修改注销状态
            $data = [
                'status' => 1,
                'audit_uid' => $param['audit_uid'],
                'audit_username' => $param['audit_username'],
                'audit_time' => time()
            ];
            model('member_cancel')->update($data, [['id', '=', $param['id']], ['site_id', '=', $param['site_id']]]);

            //删除会员信息
            model('member')->update(['is_delete' => 1, 'status' => 0], [['member_id', '=', $info['member_id']], ['site_id', '=', $param['site_id']]]);
            Cache::set('member_blacklist_' . $param['site_id'], null);

            event('MemberCancel', ['member_id' => $info['member_id'], 'site_id' => $param['site_id']]);

            model('member_cancel')->commit();

            //会员注销成功消息
            $message_model = new Message();
            $message_model->sendMessage(['keywords' => "USER_CANCEL_SUCCESS", 'member_id' => $info['member_id'], 'site_id' => $param['site_id']]);

            return $this->success();
        } catch (\Exception $e) {
            model('member_cancel')->rollback();
            return $this->error('', $e->getMessage());
        }
    }


    /**
     * 审核拒绝
     * @param $param
     * @return array
     */
    public function memberCancelAuditRefuse($param)
    {
        $info = model('member_cancel')->getInfo([['id', '=', $param['id']], ['site_id', '=', $param['site_id']]], 'status,member_id');

        if (empty($info)) {
            return $this->error('', '请核实数据后重试');
        }
        if ($info['status'] != 0) {
            return $this->error('', '该数据已审核，请勿重复审核');
        }

        $data = [
            'status' => -1,
            'audit_uid' => $param['audit_uid'],
            'audit_username' => $param['audit_username'],
            'reason' => $param['reason'],
            'audit_time' => time()
        ];
        $res = model('member_cancel')->update($data, [['id', '=', $param['id']], ['site_id', '=', $param['site_id']]]);

        //会员注销失败消息
        $message_model = new Message();
        $message_model->sendMessage(['keywords' => "USER_CANCEL_FAIL", 'member_id' => $info['member_id'], 'site_id' => $param['site_id']]);

        return $this->success($res);
    }


    /**
     * 获取会员注销信息
     *
     * @param array $condition
     * @param string $field
     */
    public function getMemberCancelInfo($condition = [], $field = '*')
    {
        $info = model('member_cancel')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取会员注销分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getMemberCancelPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc', $field = '*')
    {

        $list = model('member_cancel')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取用户账户信息
     * @param $member_id
     * @param $site_id
     */
    public function getMemberAccountInfo($member_id, $site_id)
    {
        $data = [];
        //会员信息
        $member_info = model('member')->getInfo(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['is_delete', '=', 0]
            ],
            'is_fenxiao,point,balance,balance_money,balance_withdraw_apply'
        );
        $data['member_info'] = $member_info;
        //优惠券数量
        $data['member_coupon_count'] = model('promotion_coupon')->getCount(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['state', '=', 1]
            ]
        );

        //订单待发货
        $data['order_pay_count'] = model('order')->getCount(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['order_status', '=', OrderCommon::ORDER_PAY]
            ]
        );
        //订单待收货
        $data['order_delivery_count'] = model('order')->getCount(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['order_status', '=', OrderCommon::ORDER_DELIVERY]
            ]
        );
        //订单待完成
        $data['order_take_delivery_count'] = model('order')->getCount(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['order_status', '=', OrderCommon::ORDER_TAKE_DELIVERY]
            ]
        );
        //退款订单
        $data['order_refund_count'] = model('order')->getCount(
            [
                ['member_id', '=', $member_id],
                ['site_id', '=', $site_id],
                ['refund_status', 'not in', [0, OrderRefund::REFUND_COMPLETE]]
            ]
        );

        //判断用户是否是分销商
        if ($member_info['is_fenxiao'] == 1 && addon_is_exit('fenxiao', $site_id)) {

            //分销商信息
            $fenxiao_model = new Fenxiao();
            $fenxiao_info = $fenxiao_model->getFenxiaoInfo(
                [
                    ['member_id', '=', $member_id],
                    ['site_id', '=', $site_id]
                ],
                'account,account_withdraw,account_withdraw_apply,total_commission'
            );
            $data['fenxiao_info'] = $fenxiao_info['data'];

            //分销待结算订单
            $fenxiao_order_model = new FenxiaoOrder();
            $fenxiao_order_count = $fenxiao_order_model->getFenxiaoOrderCount(
                [
                    ['member_id', '=', $member_id],
                    ['site_id', '=', $site_id],
                    ['is_settlement', '=', 0]
                ]
            );
            $data['fenxiao_order_count'] = $fenxiao_order_count['data'];
        }

        return $this->success($data);
    }

    /****************************************** 会员注销通知 start **********************************************/

    /**
     * 会员注销成功
     * @param $param
     * @return array
     */
    public function memberCancelSuccess($data)
    {
        $member_cancel = model('member_cancel')->getInfo(
            [
                ['member_id', '=', $data['member_id']],
                ['site_id', '=', $data['site_id']]
            ]
        );
        if (empty($member_cancel)) {
            return $this->success();
        }
        $member_info = json_decode($member_cancel['member_json'], true);

        //发送短信
        $sms_model = new Sms();

        $name = $member_info["username"] == '' ? $member_info["mobile"] : $member_info["username"];
        $var_parse = array(
            "username" => $name,
        );

        $data["sms_account"] = $member_info["mobile"] ?? '';//手机号
        $data["var_parse"] = $var_parse;
        $sms_result = $sms_model->sendMessage($data);

        return $this->success();
    }


    /**
     * 会员注销失败
     * @param $param
     * @return array
     */
    public function memberCancelFail($data)
    {
        $member_cancel = model('member_cancel')->getInfo(
            [
                ['member_id', '=', $data['member_id']],
                ['site_id', '=', $data['site_id']]
            ]
        );
        if (empty($member_cancel)) {
            return $this->success();
        }
        $member_info = json_decode($member_cancel['member_json'], true);

        //发送短信
        $sms_model = new Sms();

        $name = $member_info["username"] == '' ? $member_info["mobile"] : $member_info["username"];
        $var_parse = array(
            "username" => $name,
        );

        $data["sms_account"] = $member_info["mobile"] ?? '';//手机号
        $data["var_parse"] = $var_parse;
        $sms_result = $sms_model->sendMessage($data);

        return $this->success();
    }


    /**
     * 会员注销申请通知（店铺）
     * @param $data
     * @return array
     */
    public function memberCancelApply($data)
    {
        $member_cancel = model('member_cancel')->getInfo(
            [
                ['member_id', '=', $data['member_id']],
                ['site_id', '=', $data['site_id']]
            ]
        );
        if (empty($member_cancel)) {
            return $this->success();
        }
        $member_info = json_decode($member_cancel['member_json'], true);
        $name = $member_info["username"] == '' ? $member_info["mobile"] : $member_info["username"];
        //发送短信
        $sms_model = new Sms();

        $var_parse = array(
            "username" => $name,
        );
//        $site_id    = $data['site_id'];
//        $shop_info  = model("shop")->getInfo([["site_id", "=", $site_id]], "mobile,email");
//        $message_data["sms_account"] = $shop_info["mobile"];//手机号
        $data["var_parse"] = $var_parse;

        $shop_accept_message_model = new ShopAcceptMessage();
        $result = $shop_accept_message_model->getShopAcceptMessageList();
        $list = $result['data'];
        if (!empty($list)) {
            foreach ($list as $v) {
                $message_data = $data;
                $message_data["sms_account"] = $v["mobile"];//手机号
                $sms_model->sendMessage($message_data);

                if($v['wx_openid'] != ''){
                    $wechat_model = new WechatMessage();
                    $data["openid"] = $v['wx_openid'];
                    $data["template_data"] = [
                        'keyword1' => $member_info['username'],
                        'keyword2' => $member_info['mobile']
                    ];

                    $data["page"] = "";
                    $wechat_model->sendMessage($data);
                }
            }
        }
    }

    /****************************************** 会员注销通知 end ************************************************/
}