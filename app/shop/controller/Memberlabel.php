<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\model\member\MemberLabel as MemberLabelModel;

/**
 * 会员标签管理 控制器
 */
class Memberlabel extends BaseShop
{
    /**
     * 会员标签列表
     */
    public function labelList()
    {
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');

            $condition   = [['site_id', '=', $this->site_id]];
            $condition[] = ['label_name', 'like', "%" . $search_text . "%"];
            $order       = 'create_time desc';
            $field       = '*';

            $member_label_model = new MemberLabelModel();
            $list               = $member_label_model->getMemberLabelPageList($condition, $page, $page_size, $order, $field);
            return $list;
        } else {
            return $this->fetch('memberlabel/label_list');
        }
    }

    /**
     * 会员标签添加
     */
    public function addLabel()
    {
        if (request()->isAjax()) {
            $data = [
                'site_id'     => $this->site_id,
                'label_name'  => input('label_name', ''),
                'remark'      => input('remark', ''),
                'sort'        => input('sort', 0),
                'create_time' => time(),
            ];

            $member_label_model = new MemberLabelModel();
            return $member_label_model->addMemberLabel($data);
        } else {
            return $this->fetch('memberlabel/add_label');
        }
    }

    /**
     * 会员标签修改
     */
    public function editLabel()
    {
        $member_label_model = new MemberLabelModel();
        $label_id           = input('label_id', 0);
        if (request()->isAjax()) {
            $data = [
                'site_id'     => $this->site_id,
                'label_name'  => input('label_name', ''),
                'remark'      => input('remark', ''),
                'sort'        => input('sort', 0),
                'modify_time' => time(),
            ];
            return $member_label_model->editMemberLabel($data, [['label_id', '=', $label_id]]);
        } else {

            $label_info = $member_label_model->getMemberLabelInfo([['label_id', '=', $label_id]]);
            $this->assign('label_info', $label_info);

            return $this->fetch('memberlabel/edit_label');
        }
    }

    /**
     * 会员标签删除
     */
    public function deleteLabel()
    {
        $label_ids          = input('label_ids', '');
        $member_label_model = new MemberLabelModel();
        return $member_label_model->deleteMemberLabel([['label_id', 'in', $label_ids]]);
    }

    /**
     * 修改排序
     */
    public function modifySort()
    {
        $sort               = input('sort', 0);
        $label_id           = input('label_id', 0);
        $member_label_model = new MemberLabelModel();
        return $member_label_model->modifyMemberLabelSort($sort, $label_id);
    }
}