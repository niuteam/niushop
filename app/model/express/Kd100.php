<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\express;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use extend\Kd100 as Kd100Extend;

/**
 * 快递100
 */
class Kd100 extends BaseModel
{

    /*********************************************************************** 快递100 start ***********************************************************************/
    /**
     * 快递100配置
     * @param $site_id
     * @return \multitype
     */
    public function getKd100Config($site_id)
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['app_module', '=', 'shop'], ["site_id", "=", $site_id], ['config_key', '=', 'EXPRESS_KD100_CONFIG']]);
        return $res;
    }

    /**
     * 设置物流配送配置
     * @param $data
     * @return \multitype
     */
    public function setKd100Config($data, $is_use, $site_id)
    {
        if ($is_use > 0) {
            event("CloseTrace", ['site_id' => $site_id]);
        }
        $config = new ConfigModel();
        $res    = $config->setConfig($data, '快递100设置', $is_use, [['app_module', '=', 'shop'], ["site_id", "=", $site_id], ['config_key', '=', 'EXPRESS_KD100_CONFIG']]);
        return $res;
    }

    /**
     * 开关状态
     * @param $is_use
     * @return array
     */
    public function modifyStatus($is_use, $site_id)
    {
        $config = new ConfigModel();
        $res    = $config->modifyConfigIsUse($is_use, [['app_module', '=', 'shop'], ["site_id", "=", $site_id], ['config_key', '=', 'EXPRESS_KD100_CONFIG']]);
        return $res;
    }
    /*********************************************************************** 快递100 end ***********************************************************************/

    /**
     * 查询物流轨迹 并且转化为兼容数据结构
     * @param $code
     * @param $express_no
     * @return array
     */
    public function trace($code, $express_no, $site_id)
    {
        $config_result = $this->getKd100Config($site_id);
        $config        = $config_result["data"];
        if ($config["is_use"] == 0)
            return $this->error();

        $kd100_extend = new Kd100Extend($config["value"]);
        $result       = $kd100_extend->getExpressTracesEnterpriseEdition($express_no, $code);
        return $this->success($result);
    }
}