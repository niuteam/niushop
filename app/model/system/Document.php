<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 系统文章
 */
class Document extends BaseModel
{

    /**
     * 设置文章内容
     * @param unknown $title
     * @param unknown $content
     * @param array $condition
     * @return multitype:string
     */
    public function setDocument($title, $content, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $app_module = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $document_key = isset($check_condition['document_key']) ? $check_condition['document_key'] : '';
        if (empty($document_key)) {
            return $this->error('', 'REQUEST_DOCUMENT_KEY');
        }
        $data            = $check_condition;
        $data['title']   = $title;
        $data['content'] = $content;
        $json_condition  = json_encode($condition);
        $document_model  = model('document');
        $info            = $document_model->getInfo($condition, 'id');
        Cache::tag("document")->set("document_" . $json_condition, "");
        if (empty($info)) {
            $data['create_time'] = time();
            $res                 = $document_model->add($data);
        } else {
            $data['modify_time'] = time();
            $res                 = $document_model->update($data, $condition);
        }
        return $this->success($res);
    }

    /**
     * 获取系统文章
     * @param array $condition
     */
    public function getDocument($condition)
    {

        $json_condition = json_encode($condition);
        $cache          = Cache::get("document_" . $json_condition, "");
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $app_module = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $document_key = isset($check_condition['document_key']) ? $check_condition['document_key'] : '';
        if (empty($document_key)) {
            return $this->error('', 'REQUEST_DOCUMENT_KEY');
        }

        $info = model('document')->getInfo($condition, 'site_id, app_module, document_key, title, content, create_time, modify_time');
        if (empty($info)) {
            //默认初始值
            $info = [
                'site_id'      => $site_id,
                'app_module'   => $app_module,
                'document_key' => $document_key,
                'title'        => '',
                'content'      => '',
                'create_time'  => 0,
                'modify_time'  => 0
            ];
        }
        Cache::tag("document")->set("document_" . $json_condition, $info);
        return $this->success($info);
    }

}