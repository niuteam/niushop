<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\weapp\event;

use addon\weapp\model\Config;

/**
 * api
 */
class ApiConfigChange
{
    /**
     * api配置变更
     */
    public function handle($param = [])
    {
        $config = new Config();
        $config->clearWeappVersion();
    }
}