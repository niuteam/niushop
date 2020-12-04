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
class Coupon extends BaseModel
{
    /**
     * 获取编码
     */
    public function getCode()
    {
        return random_keys(8);
    }

    /**
     * 获取优惠券
     * @param int $coupon_type_id
     * @param int $site_id
     * @param int $member_id
     * @param int $get_type
     * @return multitype:string
     */
    public function receiveCoupon($coupon_type_id, $site_id, $member_id, $get_type, $is_stock = 0, $is_limit = 1)
    {

        // 用户已领取数量
        if (empty($member_id)) {
            return $this->error('', '请先进行登录');
        }
        $coupon_type_info = model('promotion_coupon_type')->getInfo(['coupon_type_id' => $coupon_type_id, 'site_id' => $site_id]);
        if (!empty($coupon_type_info)) {

            if ($coupon_type_info['count'] == $coupon_type_info['lead_count'] && $is_stock == 0) {
                return $this->error('', '来迟了该优惠券已被领取完了');
            }

            if ($coupon_type_info['max_fetch'] != 0 && $get_type == 2) {
                //限制领取
                $member_receive_num = model('promotion_coupon')->getCount([
                    'coupon_type_id' => $coupon_type_id,
                    'member_id'      => $member_id,
                    'get_type' => 2
                ]);
                if ($member_receive_num >= $coupon_type_info['max_fetch'] && $is_limit == 1) {
                    return $this->error('', '该优惠券领取已达到上限');
                }
            }

            //只有正在进行中的优惠券可以添加或者发送领取)
            if ($coupon_type_info['status'] !=1 ) {
                return $this->error('', '该优惠券已过期');
            }

            $data = [
                'coupon_type_id' => $coupon_type_id,
                'site_id'        => $site_id,
                'coupon_code'    => $this->getCode(),
                'member_id'      => $member_id,
                'money'          => $coupon_type_info['money'],
                'state'          => 1,
                'get_type'       => $get_type,
                'goods_type'     => $coupon_type_info['goods_type'],
                'fetch_time'     => time(),
                'coupon_name'    => $coupon_type_info['coupon_name'],
                'at_least'       => $coupon_type_info['at_least'],
                'type'           => $coupon_type_info['type'],
                'discount'       => $coupon_type_info['discount'],
                'discount_limit' => $coupon_type_info['discount_limit'],
                'goods_ids'      => $coupon_type_info['goods_ids'],
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
            return $this->success($res);

        } else {
            return $this->error('', '未查找到该优惠券');
        }
    }

    /**
     * 使用优惠券
     * @param $data
     */
    public function useCoupon($coupon_id, $member_id, $use_order_id)
    {
        $data      = array('use_order_id' => $use_order_id, 'use_time' => time(), 'state' => 2);
        $condition = array(
            ['coupon_id', '=', $coupon_id],
            ['member_id', '=', $member_id],
            ['state', '=', 1]
        );
        $result    = model("promotion_coupon")->update($data, $condition);
        return $this->success($result);
    }

    /**
     * 退还优惠券
     * @param $coupon_id
     * @param $member_id
     */
    public function refundCoupon($coupon_id, $member_id)
    {
        //获取优惠券信息
        $info = model("promotion_coupon")->getInfo([['coupon_id', '=', $coupon_id], ['member_id', '=', $member_id], ['state', '=', 2]]);
        if(empty($info)){
            return $this->success();
        }

        $data = ['use_time' => 0, 'state' => 1];
        //判断优惠券是否过期
        if($info['end_time'] <= time()){
            $data['state'] = 3;
        }

        $result = model("promotion_coupon")->update($data, [['coupon_id', '=', $coupon_id], ['member_id', '=', $member_id], ['state', '=', 2]]);
        return $this->success($result);
    }

    /**
     * 获取优惠券信息
     * @param unknown $coupon_code 优惠券编码
     * @param unknown $field
     */
    public function getCouponInfo($condition, $field)
    {
        $info = model("promotion_coupon")->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取优惠券列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param null $limit
     */
    public function getCouponList($condition = [], $field = true, $order = '', $limit = null)
    {
        $list = model("promotion_coupon")->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取优惠券列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getCouponPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'fetch_time desc', $field = 'coupon_id,coupon_type_id,site_id,coupon_code,member_id,use_order_id,at_least,money,state,get_type,fetch_time,use_time,end_time')
    {
        $list = model('promotion_coupon')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取会员优惠券列表
     * @param array $condition
     * @param number $page
     * @param number $page_size
     */
    public function getMemberCouponPageList($condition, $page = 1, $page_size = PAGE_LIST_ROWS)
    {
        $field = 'npc.coupon_name,npc.type,npc.use_order_id,npc.coupon_id,npc.coupon_type_id,npc.site_id,npc.coupon_code,npc.member_id,npc.discount_limit,
		npc.at_least,npc.money,npc.discount,npc.state,npc.get_type,npc.fetch_time,npc.use_time,npc.end_time,mem.nickname,on.order_no';
        $alias = 'npc';
        $join  = [
            [
                'member mem',
                'npc.member_id = mem.member_id',
                'inner'
            ],
            [
                'order on',
                'npc.use_order_id = on.order_id',
                'left'
            ]
        ];
        $list  = model("promotion_coupon")->pageList($condition, $field, 'fetch_time desc', $page, $page_size, $alias, $join);
        return $this->success($list);
    }

    /**
     * 获取优惠券信息
     * @param array $condition
     * @param unknown $field
     */
    public function getCouponTypeInfo($condition, $field = 'coupon_type_id,site_id,coupon_name,money,count,lead_count,max_fetch,at_least,end_time,image,validity_type,fixed_term,status')
    {
        $info = model("promotion_coupon_type")->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取优惠券列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param null $limit
     */
    public function getCouponTypeList($condition = [], $field = true, $order = '', $limit = null)
    {
        $list = model("promotion_coupon_type")->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取优惠券分页列表
     * @param $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getCouponTypePageList($condition, $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'coupon_type_id desc', $field = '*')
    {
        $list = model("promotion_coupon_type")->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }


    /**
     * 获取会员已领取优惠券优惠券
     * @param array $member_id
     */
    public function getMemberCouponList($member_id, $state, $site_id = 0, $money = 0, $order = "fetch_time desc")
    {
        $condition = array(
            ["member_id", "=", $member_id],
            ["state", "=", $state],
//            [ "end_time", ">", time()]
        );
        if ($site_id > 0) {
            $condition[] = ["site_id", "=", $site_id];
        }
        if ($money > 0) {
//            $condition[] = [ "at_least", "=", 0 ];
            $condition[] = ["at_least", "<=", $money];
        }
        $list = model("promotion_coupon")->getList($condition, "*", $order, '', '', '', 0);
        return $this->success($list);
    }

    public function getMemberCouponCount($condition)
    {
        $list = model("promotion_coupon")->getCount($condition);
        return $this->success($list);
    }

    /**
     * 增加库存
     * @param $param
     */
    public function incStock($param)
    {
        $condition   = array(
            ["coupon_type_id", "=", $param["coupon_type_id"]]
        );
        $num         = $param["num"];
        $coupon_info = model("promotion_coupon_type")->getInfo($condition, "count,lead_count");
        if (empty($coupon_info))
            return $this->error(-1, "");

        //更新优惠券库存
        $result = model("promotion_coupon_type")->setDec($condition, "lead_count", $num);
        return $this->success($result);
    }

    /**
     * 减少库存
     * @param $param
     */
    public function decStock($param)
    {
        $condition   = array(
            ["coupon_type_id", "=", $param["coupon_type_id"]]
        );
        $num         = $param["num"];
        $coupon_info = model("promotion_coupon_type")->getInfo($condition, "count,lead_count");
        if (empty($coupon_info))
            return $this->error(-1, "找不到优惠券");

        //编辑sku库存
        if (($coupon_info["count"] - $coupon_info["lead_count"]) < $num)
            return $this->error(-1, "库存不足");

        $result = model("promotion_coupon_type")->setInc($condition, "lead_count", $num);
        if ($result === false)
            return $this->error();

        return $this->success($result);
    }

    /**
     * 定时关闭
     * @return mixed
     */
    public function cronCouponEnd()
    {
        $res = model("promotion_coupon")->update(['state' => 3], [['state', '=', 1], ['end_time', '<=', time()]]);
        return $res;
    }
}