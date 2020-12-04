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
use app\model\system\Cron;

/**
 * 优惠券活动
 */
class CouponType extends BaseModel
{
    //优惠券类型状态
    private $coupon_type_status = [
        1  => '进行中',
        2  => '已结束',
        -1 => '已关闭',
    ];

    public function getCouponTypeStatus()
    {
        return $this->coupon_type_status;
    }

    /**
     * 添加优惠券活动
     * @param unknown $data
     * @return multitype:string
     */
    public function addCouponType($data)
    {
        //只要创建了就是进行中
        $data['status']      = 1;
        $data['create_time'] = time();
        //获取商品id
        if ($data['goods_type'] == 1) {//全部商品参与
            $goods_ids         = model('goods')->getColumn([['site_id', '=', $data['site_id']], ['goods_state', '=', 1]], 'goods_id');
            $data['goods_ids'] = implode(',', $goods_ids);
        }

        $data['goods_ids'] = ',' . $data['goods_ids'] . ',';
        $res               = model("promotion_coupon_type")->add($data);
        if ($data['validity_type'] == 0) {
            $cron = new Cron();
            $cron->addCron(1, 1, '优惠券活动定时结束', 'CronCouponTypeEnd', $data['end_time'], $res);
        }

        $this->qrcode($res, 'all', $data['site_id']);
        return $this->success($res);
    }

    /**
     * 编辑优惠券活动
     * @param unknown $data
     * @param unknown $coupon_type_id
     * @return multitype:string
     */
    public function editCouponType($data, $coupon_type_id)
    {
        $data['update_time'] = time();

        //获取商品id
        if ($data['goods_type'] == 1) {//全部商品参与
            $goods_ids         = model('goods')->getColumn([['site_id', '=', $data['site_id']], ['goods_state', '=', 1]], 'goods_id');
            $data['goods_ids'] = implode(',', $goods_ids);
        }

        $data['goods_ids'] = ',' . $data['goods_ids'] . ',';
        $res               = model("promotion_coupon_type")->update($data, [['coupon_type_id', '=', $coupon_type_id]]);
        $cron              = new Cron();
        $cron->deleteCron([['event', '=', 'CronCouponTypeEnd'], ['relate_id', '=', $coupon_type_id]]);
        if ($data['validity_type'] == 0) {
            $cron->addCron(1, 1, '优惠券活动定时结束', 'CronCouponTypeEnd', $data['end_time'], $coupon_type_id);
        }
        return $this->success($res);
    }

    /**
     * 关闭优惠券
     * @param $coupon_type_id
     * @return array|\multitype
     */
    public function closeCouponType($coupon_type_id, $site_id)
    {
        $res = model('promotion_coupon_type')->update(['status' => -1], [['coupon_type_id', '=', $coupon_type_id], ['site_id', '=', $site_id]]);
        if ($res) {
            model("promotion_coupon")->update(['state' => 3], [['coupon_type_id', '=', $coupon_type_id], ['site_id', '=', $site_id]]);
        }
        $cron = new Cron();
        $cron->deleteCron([['event', '=', 'CronCouponTypeEnd'], ['relate_id', '=', $coupon_type_id]]);
        return $this->success($res);
    }

    /**
     * 删除优惠券活动
     * @param unknown $coupon_type_id
     * @return multitype:string
     */
    public function deleteCouponType($coupon_type_id, $site_id)
    {
        $res = model("promotion_coupon_type")->delete([['coupon_type_id', '=', $coupon_type_id], ['site_id', '=', $site_id]]);
        if ($res) {
            model("promotion_coupon")->delete([['coupon_type_id', '=', $coupon_type_id]]);
        }
        $cron = new Cron();
        $cron->deleteCron([['event', '=', 'CronCouponTypeEnd'], ['relate_id', '=', $coupon_type_id]]);

        return $this->success($res);
    }

    /**
     * 获取优惠券活动详情
     * @param int $discount_id
     * @return multitype:string mixed
     */
    public function getCouponTypeInfo($coupon_type_id, $site_id)
    {
        $res = model('promotion_coupon_type')->getInfo([['coupon_type_id', '=', $coupon_type_id], ['site_id', '=', $site_id]]);
        if (!empty($res)) {
            //获取商品信息s
            if ($res['goods_type'] == 2) {//指定商品

                $field      = 'goods_id,goods_name,goods_stock,price';
                $goods_ids  = substr($res['goods_ids'], '1', '-1');
                $goods_list = model('goods')->getList([['goods_id', 'in', $goods_ids]], $field);
            }
        }
        $res['goods_list'] = isset($goods_list) ? $goods_list : [];
        return $this->success($res);
    }

    /**
     * 获取优惠券活动信息
     * @param array $where
     * @param string $field
     * @param string $alias
     * @param unknown $join
     * @param unknown $data
     * @return array
     */
    public function getInfo($where = [], $field = true, $alias = 'a', $join = null, $data = null)
    {
        $res = model('promotion_coupon_type')->getInfo($where, $field, $alias, $join, $data);
        return $this->success($res);
    }

    /**
     * 获取 优惠券类型列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getCouponTypeList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $res = model('promotion_coupon_type')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($res);
    }

    /**
     * 获取优惠券活动分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getCouponTypePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('promotion_coupon_type')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 生成优惠券二维码
     * @param $coupon_type_id
     * @param string $app_type all为全部
     * @param string $type 类型 create创建 get获取
     * @return mixed|array
     */
    public function qrcode($coupon_type_id, $app_type, $site_id, $type = 'create')
    {
        $res = event('Qrcode', [
            'site_id'     => $site_id,
            'app_type'    => $app_type,
            'type'        => $type,
            'data'        => [
                'coupon_type_id' => $coupon_type_id
            ],
            'page'        => '/otherpages/goods/coupon_receive/coupon_receive',
            'qrcode_path' => 'upload/qrcode/coupon',
            'qrcode_name' => 'coupon_type_code_' . $coupon_type_id . '_' . $site_id,
        ], true);
        return $res;
    }

    /**
     * 优惠券定时结束
     * @param unknown $coupon_type_id
     */
    public function couponCronEnd($coupon_type_id)
    {
        $res = model('promotion_coupon_type')->update(['status' => 2], [['coupon_type_id', '=', $coupon_type_id]]);
        return $this->success($res);
    }
}