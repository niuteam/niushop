<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\cron\controller;

use app\Controller;
use think\facade\Log;
use think\facade\Cache;

/**
 * 计划任务
 * @author Administrator
 */
class Task extends Controller
{

    /**
     * 执行计划任务(单独计划任务)
     */
    public function execute()
    {
        ignore_user_abort(true);
        set_time_limit(0);
        //设置计划任务标识
        Log::write("检测事件执行" . date("Y-m-d H:i:s", time()));
        $last_time = Cache::get("cron_last_load_time");
        if (empty($last_time)) {
            $last_time = 0;
        }
        $time = time();
        if (($time - $last_time) < 20) {
            Log::write("防止多次执行");
            exit();//跳出
        }
        Cache::set("cron_last_load_time", time());
        $cron_model = new \app\model\system\Cron();
        $cron_model->execute();
        sleep(60);
        $url = url('cron/task/execute');
        http($url, 1);
        exit();
    }

    /**
     * php自动执行事件
     */
    public function phpCron()
    {
        $url = url('cron/task/execute');
        http($url, 1);
    }
}