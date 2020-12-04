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

use app\model\express\Kd100;

/**
 * 关闭物流查询
 * @author Administrator
 *
 */
class CloseKd100Trace
{
    public function handle($param)
    {
        $kd100_model = new Kd100();
        $result      = $kd100_model->modifyStatus(0, $param['site_id']);
        return $result;

    }

}
