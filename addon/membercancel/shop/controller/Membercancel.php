<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\membercancel\shop\controller;

use app\model\member\Config as ConfigModel;
use addon\membercancel\model\MemberCancel as MemberCancelModel;
use app\shop\controller\BaseShop;

/**
 * 会员注销管理 控制器
 */
class Membercancel extends BaseShop
{

    /**
     * 注销列表
     */
    public function lists()
    {
        if (request()->isAjax()) {

            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $condition = [['site_id', '=', $this->site_id]];

            $search_text = input('search_text', '');
            $search_type = input('search_type', '');
            if (!empty($search_text)) {
                $condition[] = [
                    $search_type, '=', $search_text
                ];
            }
            //状态
            $status = input('status', '');
            if ($status !== '') {
                $condition[] = ['status', '=', $status];
            }
            //注销时间
            $start_time = input('start_time', '');
            $end_time = input('end_time', '');
            if ($start_time && $end_time) {
                $condition[] = ['create_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
            } elseif (!$start_time && $end_time) {
                $condition[] = ['create_time', '<=', date_to_time($end_time)];

            } elseif ($start_time && !$end_time) {
                $condition[] = ['create_time', '>=', date_to_time($start_time)];
            }

            $member_cancel_model = new MemberCancelModel();
            $list = $member_cancel_model->getMemberCancelPageList($condition, $page, $page_size);
            return $list;
        }else{

            //筛选条件
            $search_type = [
                'username' => '会员账号',
                'phone' => '手机号',
                'nickname' => '昵称'
            ];
            $this->assign('search_type', $search_type);
            return $this->fetch('membercancel/lists');
        }
    }

    /**
     * 审核通过
     */
    public function auditPass()
    {
        if(request()->isAjax()){

            $id = input('id','');

            $data = [
                'id' => $id,
                'site_id' => $this->site_id,
                'audit_uid' => $this->user_info['uid'],
                'audit_username' => $this->user_info['username']
            ];

            $member_cancel_model = new MemberCancelModel();
            $res = $member_cancel_model -> memberCancelAuditPass($data);
            return $res;
        }
    }

    /**
     * 审核失败
     */
    public function auditRefuse()
    {
        if(request()->isAjax()){

            $id = input('id','');
            $reason = input('reason','');
            $data = [
                'id' => $id,
                'site_id' => $this->site_id,
                'audit_uid' => $this->user_info['uid'],
                'audit_username' => $this->user_info['username'],
                'reason' => $reason
            ];

            $member_cancel_model = new MemberCancelModel();
            $res = $member_cancel_model -> memberCancelAuditRefuse($data);
            return $res;
        }
    }

    /**
     * 注销协议
     */
    public function cancelAgreement()
    {
        if (request()->isAjax()) {
            //设置注销协议
            $title = input('title', '');
            $content = input('content', '');
            $config_model = new ConfigModel();
            return $config_model->setCancelDocument($title, $content, $this->site_id, 'shop');
        } else {
            //获取注销协议
            $config_model = new ConfigModel();
            $document_info = $config_model->getCancelDocument($this->site_id, 'shop');
            $this->assign('document_info', $document_info);

            return $this->fetch('membercancel/cancel_agreement');
        }
    }

    /**
     * 注销设置
     */
    public function cancelConfig()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            //设置注册设置
            $data = array(
                'is_enable' => input('is_enable', 0),
                'is_audit' => input('is_audit', 1),
            );
            return $config_model->setCancelConfig($data, $this->site_id, 'shop');
        } else {
            //获取注册设置
            $config_info = $config_model->getCancelConfig($this->site_id, 'shop');
            $value = $config_info['data']['value'];

            $this->assign('value', $value);
            return $this->fetch('membercancel/cancel_config');
        }
    }

}