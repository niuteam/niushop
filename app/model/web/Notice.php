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

/**
 * 公告管理
 * @author Administrator
 *
 */
class Notice extends BaseModel
{

    /**
     * 添加公告
     * @param unknown $data
     */
    public function addNotice($data)
    {
        $data['create_time'] = time();
        $res                 = model('notice')->add($data);
        Cache::tag("notice")->clear();
        return $this->success($res);
    }

    /**
     * 修改公告
     * @param unknown $data
     * @return multitype:string
     */
    public function editNotice($data, $condition)
    {
        $data['modify_time'] = time();
        $res                 = model('notice')->update($data, $condition);
        Cache::tag("notice")->clear();
        return $this->success($res);
    }

    /**
     * 删除公告
     * @param unknown $condition
     */
    public function deleteNotice($condition)
    {
        $res = model('notice')->delete($condition);
        Cache::tag("notice")->clear();
        return $this->success($res);
    }

    /**
     * 获取公告信息
     * @param array $condition
     * @param string $field
     */
    public function getNoticeInfo($condition, $field = 'id, title, content, create_time, modify_time, is_top,receiving_type,receiving_name')
    {
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("notice_getNoticeInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('notice')->getInfo($condition, $field);
        Cache::tag("notice")->set("notice_getNoticeInfo_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取公告列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getNoticeList($condition = [], $field = 'id, title, content, create_time, modify_time, is_top,receiving_type,receiving_name', $order = '', $limit = null)
    {
        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("notice_getNoticeList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('notice')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("notice")->set("notice_getNoticeList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取公告分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getNoticePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'is_top desc,create_time desc', $field = 'id, title,content, create_time, is_top,receiving_type,receiving_name,sort')
    {
        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("notice_getNoticePageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('notice')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("notice")->set("notice_getNoticePageList_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 修改标签排序
     * @param $sort
     * @param $id
     * @return array
     */
    public function modifyNoticeSort($sort, $id)
    {

        $res = model('notice')->update(['sort' => $sort], [['id', '=', $id]]);
        Cache::tag("notice")->clear();
        return $this->success($res);
    }
}