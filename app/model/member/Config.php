<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\member;

use app\model\system\Document;
use app\model\system\Config as ConfigModel;
use app\model\BaseModel;

/**
 * 会员设置
 */
class Config extends BaseModel
{
    /**
     * 注册协议
     * @param unknown $site_id
     * @param unknown $name
     * @param unknown $value
     */
    public function setRegisterDocument($title, $content, $site_id, $app_module = 'shop')
    {
        $document = new Document();
        $res = $document->setDocument($title, $content, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['document_key', '=', 'REGISTER_AGREEMENT']]);
        return $res;
    }

    /**
     * 查询注册协议
     * @param unknown $where
     * @param unknown $field
     * @param unknown $value
     */
    public function getRegisterDocument($site_id, $app_module = 'shop')
    {
        $document = new Document();
        $info = $document->getDocument([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['document_key', '=', 'REGISTER_AGREEMENT']]);
        return $info;
    }

    /**
     * 注册规则
     * array $data
     */
    public function setRegisterConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '注册规则', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'REGISTER_CONFIG']]);
        return $res;
    }

    /**
     * 查询注册规则
     */
    public function getRegisterConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'REGISTER_CONFIG']]);
        if (empty($res['data']['value'])) {
            //默认值设置
            $res['data']['value'] = [
                'login' => 'username,mobile',
                'register' => 'username,mobile',
                'third_party' => 0,
                'bind_mobile' => 0,
                'pwd_len' => 6,
                'pwd_complexity' => ''
            ];
        } else {
            $value = $res['data']['value'];
            $value['login'] = $value['login'] ?? 'username,mobile';
            $value['register'] = $value['register'] ?? 'username,mobile';
            $value['third_party'] = $value['third_party'] ?? 0;
            $value['bind_mobile'] = $value['bind_mobile'] ?? 0;
            $res['data']['value'] = $value;
        }
        return $res;
    }


    /**
     * 注销协议
     * @param unknown $site_id
     * @param unknown $name
     * @param unknown $value
     */
    public function setCancelDocument($title, $content, $site_id, $app_module = 'shop')
    {
        $document = new Document();
        $res = $document->setDocument($title, $content, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['document_key', '=', 'CANCEL_AGREEMENT']]);
        return $res;
    }

    /**
     * 查询注销协议
     * @param unknown $where
     * @param unknown $field
     * @param unknown $value
     */
    public function getCancelDocument($site_id, $app_module = 'shop')
    {
        $document = new Document();
        $info = $document->getDocument([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['document_key', '=', 'CANCEL_AGREEMENT']]);
        return $info;
    }


    /**
     * 注销规则
     * array $data
     */
    public function setCancelConfig($data, $site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '注销规则', 1, [['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'CANCEL_CONFIG']]);
        return $res;
    }

    /**
     * 查询注销规则
     */
    public function getCancelConfig($site_id, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([['site_id', '=', $site_id], ['app_module', '=', $app_module], ['config_key', '=', 'CANCEL_CONFIG']]);
        if (empty($res['data']['value'])) {
            //默认值设置
            $res['data']['value'] = [
                'is_enable' => 0,  //注销开关
                'is_audit' => 1, //审核开关
            ];
        }
        return $res;
    }
}