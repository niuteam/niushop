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

use app\model\web\Notice as NoticeModel;

/**
 * 网站公告
 */
class Notice extends BaseShop
{

    /**
     * 公告管理
     * @return \think\mixed
     */
    public function index()
    {
        if (request()->isAjax()) {
            $page      = input('page', 1);
            $limit     = input('page_size', PAGE_LIST_ROWS);
            $condition = [['site_id', '=', $this->site_id]];
            $notice    = new NoticeModel();
            $list      = $notice->getNoticePageList($condition, $page, $limit);

            foreach ($list['data']['list'] as $key => $val){
            	$list['data']['list'][$key]['content'] = preg_replace("/[^\x{4e00}-\x{9fa5}^0-9^A-Z^a-z]+/u", '', $val['content']);
            }

            return $list;
        }
        return $this->fetch('notice/index');
    }

    /**
     * 公告管理
     * @return \think\mixed
     */
    public function noticeSelect()
    {
        if (request()->isAjax()) {
            $page      = input('page', 1);
            $limit     = input('page_size', PAGE_LIST_ROWS);
            $condition = [['site_id', '=', $this->site_id]];
            $notice    = new NoticeModel();
            $list      = $notice->getNoticePageList($condition, $page, $limit);
            return $list;
        } else {
            $select_id = input('select_id', '');
            $this->assign('select_id', $select_id);

            return $this->fetch("notice/notice_select");
        }
    }

    /**
     * 公告add
     */
    public function addNotice()
    {
        if (request()->isAjax()) {
            $data = [
                'site_id'        => $this->site_id,
                'title'          => input('title', ''),
                'content'        => input('content', ''),
                'is_top'         => input('is_top', 0),
                'create_time'    => time(),
                'receiving_type' => input('receiving_type', 'mobile'),
                'receiving_name' => input('receiving_name', '手机端')
            ];
//			if (!empty($data['receiving_type'])) {
//				$data['receiving_name'] .= in_array('mobile', $data['receiving_type']) ? ' 手机端' : '';
//				$data['receiving_type'] = implode(',', $data['receiving_type']);
//			}
            $notice = new NoticeModel();
            $this->addLog("发布公告:" . $data['title']);
            $res = $notice->addNotice($data);
            return $res;
        } else {
            return $this->fetch('notice/add_notice');
        }
    }

    /**
     * 公告编辑
     */
    public function editNotice()
    {
        $notice = new NoticeModel();
        if (request()->isAjax()) {
            $id   = input('id', 0);
            $data = [
                'site_id'        => $this->site_id,
                'title'          => input('title', ''),
                'content'        => input('content', ''),
                'is_top'         => input('is_top', 0),
                'receiving_type' => input('receiving_type', 'mobile'),
                'receiving_name' => input('receiving_name', '手机端')
            ];

//			if (!empty($data['receiving_type'])) {
//				$data['receiving_name'] .= in_array('mobile', $data['receiving_type']) ? ' 手机端' : '';
//				$data['receiving_type'] = implode(',', $data['receiving_type']);
//			}
            $res = $notice->editNotice($data, [['id', '=', $id]]);
            return $res;
        } else {
            $id   = input('id', 0);
            $info = $notice->getNoticeInfo([['id', '=', $id], ['site_id', '=', $this->site_id]]);
            $this->assign('info', $info['data']);
            echo $this->fetch('notice/edit_notice');
        }
    }

    /**
     * 公告删除
     * @return string[]|mixed[]
     */
    public function deleteNotice()
    {
        if (request()->isAjax()) {
            $id     = input('id', '');
            $notice = new NoticeModel();
            $res    = $notice->deleteNotice([['id', 'in', $id], ['site_id', '=', $this->site_id]]);
            return $res;
        }
    }

    /**
     * 公告置顶
     */
    public function modifyNoticeTop()
    {
        $id     = input('id', '');
        $notice = new NoticeModel();
        $res    = $notice->editNotice(['is_top' => 1], [['id', '=', $id], ['site_id', '=', $this->site_id]]);
        return $res;
    }

    /**
     * 公告详情
     */
    public function detail()
    {
        $id           = input('id', 1);
        $notice_model = new NoticeModel();
        $info         = $notice_model->getNoticeInfo([['id', '=', $id]]);

        $this->assign("info", $info['data']);
        $this->assign("menu_info", ['title' => "网站公告"]);
        return $this->fetch('notice/detail');
    }

    /**
     * 修改排序
     */
    public function modifySort()
    {
        $sort               = input('sort', 0);
        $id           = input('id', 0);
        $notice_model = new NoticeModel();
        return $notice_model->modifyNoticeSort($sort, $id);
    }

}