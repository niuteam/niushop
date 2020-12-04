<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\memberconsume\event;

/**
 * 会员账户变化来源类型
 */
class MemberAccountFromType
{

    public function handle($data)
    {
        $from_type = [

            'point'  => [
                'memberconsume' => [
                    'type_name' => '消费奖励',
                    'admin_url' => 'admin/order/detail',
                    'tag_name'  => 'order_id'
                ],

            ],
            'growth' => [
                'memberconsume' => [
                    'type_name' => '消费奖励',
                    'admin_url' => 'admin/order/detail',
                    'tag_name'  => 'order_id'
                ],
            ],

        ];
        if ($data == '') {
            return $from_type;
        } else {
            if (isset($from_type[$data])) {
                return $from_type[$data];
            } else {
                return [];
            }
        }

    }
}