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

use addon\memberconsume\model\Consume;

/**
 * 会员账户变化规则
 */
class MemberAccountRule
{

    public function handle($data)
    {
        $config = new Consume();
        $info   = $config->getConfig($data['site_id']);
        $return = '';
        if ($data['account'] == 'point') {
            if ($info['data']['is_use'] == 1) {
                if ($info['data']['value']['return_point_status'] == 'receive') {
                    $return .= "会员消费，订单收货返积分,比率" . $info['data']['value']['return_point_rate'] . "%";
                }
                if ($info['data']['value']['return_point_status'] == 'pay') {
                    $return .= "会员消费，订单支付返积分,比率" . $info['data']['value']['return_point_rate'] . "%";
                }
                if ($info['data']['value']['return_point_status'] == 'complete') {
                    $return .= "会员消费，订单支付返积分,比率" . $info['data']['value']['return_point_rate'] . "%";
                }
            }
        }
        if ($data['account'] == 'growth') {
            if ($info['data']['is_use'] == 1) {
                if ($info['data']['value']['return_point_status'] == 'receive') {
                    $return .= "会员消费订单收货返成长值,比率" . $info['data']['value']['return_growth_rate'] . "%";
                }
                if ($info['data']['value']['return_point_status'] == 'pay') {
                    $return .= "会员消费订单支付返成长值,比率" . $info['data']['value']['return_growth_rate'] . "%";
                }
                if ($info['data']['value']['return_point_status'] == 'complete') {
                    $return .= "会员消费订单支付返成长值,比率" . $info['data']['value']['return_growth_rate'] . "%";
                }
            }
        }

        return isset($return) ? $return : '';

    }
}