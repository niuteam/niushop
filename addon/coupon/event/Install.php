<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\coupon\event;

use app\model\system\Cron;

/**
 * 应用安装
 */
class Install
{
    /**
     * 执行安装
     */
    public function handle()
    {
        try {
            execute_sql('addon/coupon/data/install.sql');

            $cron = new Cron();
            $cron->deleteCron([ ['event', '=', 'CronCouponEnd'] ]);
            $cron->addCron(2, 1, '优惠券过期自动关闭', 'CronCouponEnd', time(), 0);

            return success();
        } catch (\Exception $e) {
            return error('', $e->getMessage());
        }
    }
}