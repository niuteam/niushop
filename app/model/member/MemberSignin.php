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

use app\model\BaseModel;
use Carbon\Carbon;

/**
 * 会员签到
 */
class MemberSignin extends BaseModel
{
    /**
     * 获取签到奖励规则
     */
    public function getAward($site_id)
    {
        $award = event('MemberSigninAward', ['site_id' => $site_id], true);
        return $this->success($award);
    }

    /**
     * 判断是否已经签到
     * @param $member_id
     * @return array
     */
    public function isSign($member_id)
    {
        $member_info = model("member")->getInfo([['member_id', '=', $member_id]], 'sign_time');
        if ($member_info['sign_time'] != 0) {
            $compare_time = Carbon::today()->timestamp;
            if ($member_info['sign_time'] < $compare_time) {
                $is_sign = 0;
            } else {
                $is_sign = 1;
            }

            //纠正连签天数
            $compare_yesterday = Carbon::yesterday()->timestamp;
            if ($compare_yesterday > $member_info['sign_time']) {
                model("member")->update(['sign_days_series' => 0, 'sign_time' => 0], [['member_id', '=', $member_id]]);
            }

        } else {
            $is_sign = 0;
        }
        return $this->success($is_sign);
    }

    /**
     * 签到
     * @param $member_id
     * @return array|\multitype
     */
    public function signin($member_id, $site_id)
    {
        $member_info = model("member")->getInfo([['member_id', '=', $member_id]], 'sign_time,sign_days_series');
        if ($member_info['sign_time'] != 0) {
            $compare_time = Carbon::today()->timestamp;
            if ($member_info['sign_time'] < $compare_time) {
                $is_sign = 0;
            } else {
                $is_sign = 1;
            }
        } else {
            $is_sign = 0;
        }
        if ($is_sign == 1) {
            return $this->error('', "SIGNED_IN");
        } else {
            $data_log = [
                'member_id'   => $member_id,
                'action'      => 'membersignin',
                'action_name' => '会员签到',
                'create_time' => time(),
                'remark'      => '会员签到'
            ];
            model("member_log")->add($data_log);

            //连续签到
            $compare_yesterday = Carbon::yesterday()->timestamp;
            if ($compare_yesterday < $member_info['sign_time']) {
                model("member")->setInc([['member_id', '=', $member_id]], 'sign_days_series');
                model("member")->update(['sign_time' => time()], [['member_id', '=', $member_id]]);
            } else {
                model("member")->update(['sign_days_series' => 1, 'sign_time' => time()], [['member_id', '=', $member_id]]);
            }

            //执行签到奖励
            $res = event("MemberSignin", ['member_id' => $member_id, 'site_id' => $site_id], true);
            return $this->success($res);
        }

    }

    /**
     * 获取签到记录
     * @param array $condition
     * @param string $field
     * @param string $order
     * @return array
     */
    public function getMemberSigninList($condition = [],$field = '*',$order = 'create_time asc')
    {
        $list = model('member_log')->getList($condition,$field,$order);
        return $this->success($list);
    }
}