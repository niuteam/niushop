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

use app\model\express\Kdbird;

/**
 * 初始化配置信息
 * @author Administrator
 *
 */
class KdbirdTrace
{
    public function handle($data)
    {
        $express_no_data = $data["express_no_data"];

        $kdbird_model  = new Kdbird();
        $config_result = $kdbird_model->getKdbirdConfig($express_no_data["site_id"]);
        $config        = $config_result["data"];

        if ($config["is_use"]) {
            $express_no = $express_no_data["express_no"];
            $result     = $kdbird_model->trace($data["code"], $express_no, $express_no_data["site_id"]);
            return $result;
        }
    }
}
