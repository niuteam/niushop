<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\member;

use think\facade\Cache;
use app\model\BaseModel;
use addon\coupon\model\CouponType;

/**
 * 会员等级
 */
class MemberLevel extends BaseModel
{

    /**
     * 添加会员等级
     *
     * @param array $data
     */
    public function addMemberLevel($data)
    {
        $res = model('member_level')->add($data);

        Cache::tag("member_level")->clear();
        return $this->success($res);
    }

    /**
     * 修改会员等级(不允许批量处理)
     *
     * @param array $data
     * @param array $condition
     */
    public function editMemberLevel($data, $condition)
    {
        $res = model('member_level')->update($data, $condition);

        Cache::tag("member_level")->clear();
        return $this->success();
    }

    /**
     * 刷新会员等级排序
     */
    private function refreshSort($site_id)
    {
        $list = model('member_level')->getList([['site_id', '=', $site_id]], 'level_id, growth', 'growth asc');
        foreach ($list as $k => $v) {
            model('member_level')->update(['sort' => $k], [['level_id', '=', $v['level_id']]]);
        }
    }

    /**
     * 刷新会员等级
     */
    private function refreshLevel($site_id)
    {
        model('member_level')->update(['is_default' => 0], [['is_default', '=', 1], ['site_id', '=', $site_id]]);
    }

    /**
     * 删除会员等级
     * @param array $condition
     */
    public function deleteMemberLevel($condition)
    {
        $res = model('member_level')->delete($condition);

        Cache::tag("member_level")->clear();
        return $this->success($res);
    }

    /**
     * 获取会员等级信息
     *
     * @param array $condition
     * @param string $field
     */
    public function getMemberLevelInfo($condition = [], $field = '*')
    {

        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("member_level_getMemberLevelInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('member_level')->getInfo($condition, $field);
        if ($info) {
            //获取优惠券信息
            if (isset($info['send_coupon']) && !empty($info['send_coupon'])) {
                //优惠券字段
                $coupon_field = 'coupon_type_id,coupon_name,money,count,lead_count,max_fetch,at_least,end_time,image,validity_type,fixed_term';

                $model               = new CouponType();
                $coupon              = $model->getCouponTypeList([['coupon_type_id', 'in', $info['send_coupon']]], $coupon_field);
                $info['coupon_list'] = $coupon;
            }
        }
        Cache::tag("member_level")->set("member_level_getMemberLevelInfo_" . $data, $info);
        return $this->success($info);
    }

    /**
     * 获取会员等级列表
     *
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getMemberLevelList($condition = [], $field = '*', $order = 'sort asc, level_id asc', $limit = null)
    {

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("member_level_getMemberLevelList_" . $data);

        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('member_level')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("member_level")->set("member_level_getMemberLevelList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取会员等级分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getMemberLevelPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc, level_id asc', $field = '*')
    {

        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("member_level_getMemberLevelPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('member_level')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("member_level")->set("member_level_getMemberLevelPageList_" . $data, $list);
        return $this->success($list);
    }

}