<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\member\MemberLevel;


/**
 * 增加默认会员等级
 */
class AddMemberLevel
{

    public function handle($param)
    {
        if (!empty($param['site_id'])) {

            $member_level = new MemberLevel();
            $data         = [
                'site_id'          => $param['site_id'],
                'level_name'       => '普通会员',
                'is_default'       => 1,
                'is_free_shipping' => 0
            ];
            $res          = $member_level->addMemberLevel($data);
            return $res;

        }

    }

}