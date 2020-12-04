<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\coupon\model;

use app\model\BaseModel;

/**
 * 优惠券
 */
class MemberCoupon extends BaseModel
{

    /**
     * 获取会员已领取优惠券优惠券
     * @param array $member_id
     */
    public function getMemberCouponList($member_id, $state, $site_id = 0, $order = "fetch_time desc")
    {
        $condition = array(
            ["member_id", "=", $member_id],
            ["state", "=", $state],
        );
        if ($site_id > 0) {
            $condition[] = ["site_id", "=", $site_id];
        }
        $list = model("promotion_coupon")->getList($condition, "*", $order, '', '', '', 0);
        return $this->success($list);
    }

    /**
     * 使用优惠券
     * @param $coupon_id
     */
    public function useMemberCoupon($coupon_id, $member_id, $order_id = 0)
    {
        //优惠券处理方案
        $result = model('promotion_coupon')->update(['use_order_id' => $order_id, 'state' => 2, 'use_time' => time()], [['coupon_id', '=', $coupon_id], ["member_id", "=", $member_id], ['state', '=', 1]]);
        if ($result === false) {
            return $this->error();
        }
        return $this->success();
    }

    /**
     * 获取会员已领取优惠券优惠券数量
     * @param unknown $member_id
     * @param unknown $state
     * @param number $site_id
     * @return multitype:number unknown
     */
    public function getMemberCouponNum($member_id, $state, $site_id = 0)
    {
        $condition = array(
            ["member_id", "=", $member_id],
            ["state", "=", $state],
        );
        if ($site_id > 0) {
            $condition[] = ["site_id", "=", $site_id];
        }
        $num = model("promotion_coupon")->getCount($condition);
        return $this->success($num);
    }

    /**
     * 会员是否可领取该优惠券
     */
    public function receivedNum($coupon_type_id, $member_id)
    {
        $received_num = model('promotion_coupon')->getCount([['coupon_type_id', '=', $coupon_type_id], ['member_id', '=', $member_id]]);
        return $this->success($received_num);
    }

    /**
     * 获取编码
     */
    public function getCode()
    {
        return random_keys(8);
    }

    /**
     * 会员批量发送优惠券
     */
    public function sendCoupon($coupon_type_ids, $site_id, $member_id, $get_type = 4, $is_stock = 0, $is_limit = 1)
    {
        //已选优惠券提交数组
        if(!empty($coupon_type_ids)){
            $res = 0;
            foreach ($coupon_type_ids as $coupon_type_id) {
                $coupon_type_info = model('promotion_coupon_type')->getInfo(['coupon_type_id' => $coupon_type_id, 'site_id' => $site_id]);
                if (!empty($coupon_type_info)) {

                    if ($coupon_type_info['count'] == $coupon_type_info['lead_count'] && $is_stock == 0) {
                        continue;
                    }

                    if ($coupon_type_info['max_fetch'] != 0) {
                        //限制领取
                        $member_receive_num = model('promotion_coupon')->getCount([
                            'coupon_type_id' => $coupon_type_id,
                            'member_id' => $member_id
                        ]);
                        if ($member_receive_num >= $coupon_type_info['max_fetch'] && $is_limit == 1) {
                            continue;
                        }

                    }
                    //优惠券已过期
                    if ($coupon_type_info['status'] !=1 ) {
                        continue;
                    }

                    $data = [
                        'coupon_type_id' => $coupon_type_id,
                        'site_id' => $site_id,
                        'coupon_code' => $this->getCode(),
                        'member_id' => $member_id,
                        'money' => $coupon_type_info['money'],
                        'state' => 1,
                        'get_type' => $get_type,
                        'goods_type' => $coupon_type_info['goods_type'],
                        'fetch_time' => time(),
                        'coupon_name' => $coupon_type_info['coupon_name'],
                        'at_least' => $coupon_type_info['at_least'],
                        'type' => $coupon_type_info['type'],
                        'discount' => $coupon_type_info['discount'],
                        'discount_limit' => $coupon_type_info['discount_limit'],
                        'goods_ids' => $coupon_type_info['goods_ids'],
                    ];

                    if ($coupon_type_info['validity_type'] == 0) {
                        $data['end_time'] = $coupon_type_info['end_time'];
                    } else {
                        $data['end_time'] = (time() + $coupon_type_info['fixed_term'] * 86400);
                    }
                    $res = model('promotion_coupon')->add($data);
                    if ($is_stock == 0) {
                        model('promotion_coupon_type')->setInc(['coupon_type_id' => $coupon_type_id], 'lead_count');
                    }
                }
            }
            if($res){
                return $this->success($res);
            }else{
                return $this->error();
            }
        }else{
            return $this->error();
        }
    }



}