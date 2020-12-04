<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\pay\controller;

use app\Controller;
use think\facade\Log;

/**
 * 支付控制器
 */
class Pay extends Controller
{

    /**
     * 支付异步回调
     */
    public function notify()
    {
        $param = input();
        event('PayNotify', []);
    }

    public function payReturn()
    {

    }

}