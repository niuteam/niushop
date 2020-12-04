<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\coupon\shop\controller;

use app\shop\controller\BaseShop;
use addon\coupon\model\CouponType as CouponTypeModel;
use addon\coupon\model\Coupon as CouponModel;
use addon\coupon\model\MemberCoupon as MemberCouponModel;

/**
 * 优惠券
 * @author Administrator
 *
 */
class Coupon extends BaseShop
{
    /**
     * 添加活动
     */
    public function add()
    {

        if (request()->isAjax()) {
            $data = [
                'site_id'        => $this->site_id,
                'coupon_name'    => input('coupon_name', ''),//优惠券名称
                'type'           => input('type'),//优惠券类型
                'goods_type'     => input('goods_type', 1),
                'goods_ids'      => input('goods_ids', ''),
                'money'          => input('money', 0),//优惠券面额
                'discount'       => input('discount', 0),//优惠券折扣
                'discount_limit' => input('discount_limit', 0),//最多优惠
                'count'          => input('count', ''),//发放数量
                'max_fetch'      => input('max_fetch', ''),//最大领取数量
                'at_least'       => input('at_least', ''),//满多少元可以使用
                'end_time'       => strtotime(input('end_time', '')),//活动结束时间
                'image'          => input('image', ''),//优惠券图片
                'validity_type'  => input('validity_type', ''),//有效期类型 0固定时间 1领取之日起
                'fixed_term'     => input('fixed_term', ''),//领取之日起N天内有效
                'is_show'        => input('is_show', 0),//是否允许直接领取 1:是 0：否 允许直接领取，用户才可以在手机端和PC端进行领取，否则只能以活动的形式发放。
            ];

            $coupon_type_model = new CouponTypeModel();
            return $coupon_type_model->addCouponType($data);
        } else {

            return $this->fetch("coupon/add");
        }
    }

    /**
     * 编辑活动
     */
    public function edit()
    {
        $coupon_type_model = new CouponTypeModel();
        if (request()->isAjax()) {
            $data           = [
                'site_id'        => $this->site_id,
                'coupon_name'    => input('coupon_name', ''),//优惠券名称
                'type'           => input('type'),//优惠券类型
                'goods_type'     => input('goods_type', 1),
                'goods_ids'      => input('goods_ids', ''),
                'money'          => input('money', 0),//优惠券面额
                'discount'       => input('discount', 0),//优惠券折扣
                'discount_limit' => input('discount_limit', 0),//最多优惠
                'count'          => input('count', ''),//发放数量
                'max_fetch'      => input('max_fetch', ''),//最大领取数量
                'at_least'       => input('at_least', ''),//满多少元可以使用
                'end_time'       => strtotime(input('end_time', '')),//活动结束时间
                'image'          => input('image', ''),//优惠券图片
                'validity_type'  => input('validity_type', ''),//有效期类型 0固定时间 1领取之日起
                'fixed_term'     => input('fixed_term', ''),//领取之日起N天内有效
                'is_show'        => input('is_show', 0),//是否允许直接领取 1:是 0：否 允许直接领取，用户才可以在手机端和PC端进行领取，否则只能以活动的形式发放。
            ];
            $coupon_type_id = input('coupon_type_id', 0);

            return $coupon_type_model->editCouponType($data, $coupon_type_id);
        } else {
            $coupon_type_id = input('coupon_type_id', 0);
            $this->assign('coupon_type_id', $coupon_type_id);

            $coupon_type_info = $coupon_type_model->getCouponTypeInfo($coupon_type_id, $this->site_id);
            $this->assign('coupon_type_info', $coupon_type_info['data']);

            return $this->fetch("coupon/edit");
        }
    }

    /**
     * 活动详情
     */
    public function detail()
    {
        $coupon_type_id    = input('coupon_type_id', 0);
        $coupon_type_model = new CouponTypeModel();
        $coupon_type_info  = $coupon_type_model->getCouponTypeInfo($coupon_type_id, $this->site_id);
        $this->assign('coupon_type_info', $coupon_type_info['data']);
        return $this->fetch("coupon/detail");
    }

    /**
     * 活动列表
     */
    public function lists()
    {
        $coupon_type_model = new CouponTypeModel();
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $coupon_name = input('coupon_name', '');
            $status      = input('status', '');

            $condition = [];
            if ($status !== "") {
                $condition[] = ['status', '=', $status];
            }
            $type = input('type');
            if ($type) {
                $condition[] = ['type', '=', $type];
            }
            //类型
            $validity_type = input('validity_type', '');
            if ($validity_type) {
                $start_time = input('start_time', '');
                $end_time   = input('end_time', '');
                switch ($validity_type) {
                    case 1: //固定
                        $condition[] = ['end_time', 'between', [$start_time, $end_time]];
                        break;
                    case 2:
                        $condition[] = ['fixed_term', 'between', [$start_time, $end_time]];
                        break;
                }
            }

            $condition[] = ['site_id', '=', $this->site_id];
            $condition[] = ['coupon_name', 'like', '%' . $coupon_name . '%'];
            $order       = 'create_time desc';
            $field       = '*';

            $res = $coupon_type_model->getCouponTypePageList($condition, $page, $page_size, $order, $field);

            //获取优惠券状态
            $coupon_type_status_arr = $coupon_type_model->getCouponTypeStatus();
            foreach ($res['data']['list'] as $key => $val) {
                $res['data']['list'][$key]['status_name'] = $coupon_type_status_arr[$val['status']];
            }
            return $res;

        } else {
            //优惠券状态
            $coupon_type_status_arr = $coupon_type_model->getCouponTypeStatus();
            $this->assign('coupon_type_status_arr', $coupon_type_status_arr);

            return $this->fetch("coupon/lists");
        }
    }



    /**
     * 发送优惠券
     */
    public function send()
    {
        $member_id = input('member_id');
        $coupon_type_model = new CouponTypeModel();
        if (request()->isAjax()) {
            $coupon_type_ids   = input('parent', 0);
            $get_type = input('get_type', 4);
            $parent = $coupon_type_ids;
            $site_id        = $this->site_id;
            if (empty($parent)) {
                return $this->error('', 'REQUEST_COUPON_TYPE_ID');
            }
            if(count($parent,COUNT_NORMAL)==1){
                $coupon_model = new CouponModel();
                $res          = $coupon_model->receiveCoupon($parent[0], $site_id, $member_id, $get_type);
            }else{
                $membercoupon_model = new MemberCouponModel();
                $res          = $membercoupon_model->sendCoupon($parent, $site_id, $member_id, $get_type);
            }
            return $res;
        } else {

            //优惠券状态
            $coupon_type_status_arr = $coupon_type_model->getCouponTypeStatus();
            $this->assign('coupon_type_status_arr', $coupon_type_status_arr);

            $this->assign('member_id', $member_id);

            return $this->fetch("coupon/send");
        }
    }

    /**
     * 活动列表
     */
    public function couponSelect()
    {
        $coupon_type_model = new CouponTypeModel();
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $coupon_name = input('coupon_name', '');

            $condition[] = ['site_id', '=', $this->site_id];
            $condition[] = ['status', '=', 1];
            $condition[] = ['coupon_name', 'like', '%' . $coupon_name . '%'];
            $order       = 'create_time desc';
            $field       = '*';

            $res = $coupon_type_model->getCouponTypePageList($condition, $page, $page_size, $order, $field);

            //获取优惠券状态
            $coupon_type_status_arr = $coupon_type_model->getCouponTypeStatus();
            foreach ($res['data']['list'] as $key => $val) {
                $res['data']['list'][$key]['status_name'] = $coupon_type_status_arr[$val['status']];
            }
            return $res;

        } else {
            //优惠券状态
            $coupon_type_status_arr = $coupon_type_model->getCouponTypeStatus();
            $this->assign('coupon_type_status_arr', $coupon_type_status_arr);
            $select_id = input('select_id', '');
            $this->assign('select_id', $select_id);

            return $this->fetch("coupon/coupon_select");
        }
    }

    /**
     * 关闭活动
     */
    public function close()
    {
        if (request()->isAjax()) {
            $coupon_type_id    = input('coupon_type_id', 0);
            $coupon_type_model = new CouponTypeModel();
            return $coupon_type_model->closeCouponType($coupon_type_id, $this->site_id);
        }
    }

    /**
     * 删除活动
     */
    public function delete()
    {
        if (request()->isAjax()) {
            $coupon_type_id    = input('coupon_type_id', 0);
            $coupon_type_model = new CouponTypeModel();
            return $coupon_type_model->deleteCouponType($coupon_type_id, $this->site_id);
        }
    }

    /**
     * 优惠券领取记录
     * */
    public function receive()
    {
        if (request()->isAjax()) {
            $page           = input('page', 1);
            $page_size      = input('page_size', PAGE_LIST_ROWS);
            $coupon_type_id = input('coupon_type_id', 0);
            $state = input('state','');
            $condition      = [];
            $condition[]    = ['npc.coupon_type_id', '=', $coupon_type_id];
            $condition[]    = ['npc.site_id', '=', $this->site_id];
            if($state !== ''){
                $condition[] = ['npc.state', '=', $state];
            }
            $coupon_model   = new CouponModel();
            $res            = $coupon_model->getMemberCouponPageList($condition, $page, $page_size);
            return $res;
        } else {
            $coupon_type_id = input('coupon_type_id', 0);
            $this->assign('coupon_type_id', $coupon_type_id);
            return $this->fetch("coupon/receive");
        }
    }


}