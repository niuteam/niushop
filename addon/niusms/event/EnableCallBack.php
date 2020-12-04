<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */

namespace addon\niusms\event;

use addon\niusms\model\Config;

/**
 * 使用这个短信，就要关闭其他短信插件
 */
class EnableCallBack
{
    /**
     * 短信发送方式方式及配置
     */
    public function handle($param)
    {
        if ($param[ 'sms_type' ] != 'niusms') {
            $param[ 'is_use' ] = 0;
            $config_model = new Config();
            $sms_config = $config_model->getSmsConfig($param[ 'site_id' ]);
            $is_use = $sms_config[ 'data' ][ 'is_use' ];
            if ($is_use) {
                $is_use = 0;
                $res = $config_model->modifyConfigIsUse($is_use, $param[ 'site_id' ]);
                return $res;
            }
        }
    }
}