<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\web;

use think\facade\Cache;
use app\model\BaseModel;
use app\model\system\Config as ConfigModel;

/**
 * 系统站点信息管理
 * @author Administrator
 *
 */
class WebSite extends BaseModel
{
    /**
     * 获取系统银行账户
     */
    public function getSystemBankAccount()
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', 1], ['app_module', '=', 'shop'], ['config_key', '=', 'SYSTEM_BANK_ACCOUNT']]);
        if (empty($res['data']['value'])) {
            $res['data']['value'] = [
                'bank_account_name' => '',
                'bank_account_no'   => '',
                'bank_name'         => '',
                'bank_address'      => ''
            ];
        }
        return $res;
    }

    /**
     * 设置系统银行账户
     * @param unknown $data
     * @return Ambigous <multitype:unknown , multitype:number unknown >
     */
    public function setSystemBankAccount($data)
    {
        $config = new ConfigModel();
        $res    = $config->setConfig($data, '平台银行账户', 1, [['site_id', '=', 1], ['app_module', '=', 'shop'], ['config_key', '=', 'SYSTEM_BANK_ACCOUNT']]);
        return $res;
    }


    /**
     * 获取发票设置
     */
    public function getInvoiceConfig()
    {
        $config = new ConfigModel();
        $res    = $config->getConfig([['site_id', '=', 1], ['app_module', '=', 'shop'], ['config_key', '=', 'SYSTEM_INVOICE_CONFIG']]);
        if (empty($res['data']['value'])) {
            $res['data']['value'] = [
                'status'  => 0,
                'rate'    => 0,
                'content' => '',
                'money'   => 0
            ];
        }
        return $res;
    }

    /**
     * 设置发票设置
     * @param unknown $data
     * @return Ambigous <multitype:unknown , multitype:number unknown >
     */
    public function setInvoiceConfig($data)
    {
        $config = new ConfigModel();
        $res    = $config->setConfig($data, '发票设置', 1, [['site_id', '=', 1], ['app_module', '=', 'shop'], ['config_key', '=', 'SYSTEM_INVOICE_CONFIG']]);
        return $res;
    }

}