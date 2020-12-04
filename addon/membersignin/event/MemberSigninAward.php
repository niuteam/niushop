<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\membersignin\event;

use addon\membersignin\model\Signin as SigninModel;

/**
 * 会员签到奖励规则
 */
class MemberSigninAward
{
    /**
     * 会员操作
     */
    public function handle($param)
    {
        $signin_model  = new SigninModel();
        $config_result = $signin_model->getConfig($param['site_id']);
        $config_result = $config_result['data'];
        if ($config_result['is_use']) {
            $config_result = $config_result['value'];
            return $config_result;
        }
        return [];
    }
}