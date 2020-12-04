<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * 4.0.1升级测试
 */

namespace addon\memberregister\event;

use addon\memberregister\model\Register as RegisterModel;
use app\model\member\MemberAccount as MemberAccountModel;

/**
 * 会员注册奖励
 */
class MemberRegister
{
    /**
     * @param $param
     * @return array|\multitype
     */
    public function handle($param)
    {
        $register_model       = new RegisterModel();
        $member_account_model = new MemberAccountModel();

        $register_config = $register_model->getConfig($param['site_id']);
        $register_config = $register_config['data'];

        $res = [];
        if ($register_config['is_use']) {
            $register_config = $register_config['value'];
            foreach ($register_config as $k => $v) {
                if (!empty($v)) {
                    $adjust_num   = $v;
                    $account_type = $k;
                    $remark       = '注册送' . $adjust_num . $this->accountType($k);
                    $res          = $member_account_model->addMemberAccount($param['site_id'], $param['member_id'], $account_type, $adjust_num, 'register', 0, $remark);
                }
            }
        }

        return $res;

    }

    private function accountType($key)
    {
        $type = [
            'point'   => '积分',
            'balance' => '余额',
            'growth'  => '成长值',
            'coupon'  => '优惠券'
        ];
        return $type[$key];
    }

}