<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\goods;

use app\model\BaseModel;
use app\model\system\Document as DocumentModel;

/**
 * 商品设置
 */
class Config extends BaseModel
{

    /**
     * 获取售后保障设置
     */
    public function getAfterSaleConfig($site_id)
    {
        $document = new DocumentModel();
        $info     = $document->getDocument([['site_id', '=', $site_id], ['app_module', '=', 'shop'], ['document_key', '=', "GOODS_AFTER_SALE"]]);
        return $info;
    }

    /**
     * 设置售后保障
     * @param $title
     * @param $content
     * @param $site_id
     * @return \app\model\system\multitype
     */
    public function setAfterSaleConfig($title, $content, $site_id)
    {
        $document = new DocumentModel();
        $res      = $document->setDocument($title, $content, [['site_id', '=', $site_id], ['app_module', '=', 'shop'], ['document_key', '=', "GOODS_AFTER_SALE"]]);
        return $res;
    }

}