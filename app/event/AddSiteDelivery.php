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

use app\model\express\Config as ConfigModel;

/**
 * 增加默认配送管理数据
 */
class AddSiteDelivery
{

    public function handle($param)
    {
        if (!empty($param['site_id'])) {

            $config_model = new ConfigModel();
            $data         = array();
            $res          = $config_model->setExpressConfig($data, 1, $param['site_id']);
            return $res;

        }
    }
}