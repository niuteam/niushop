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
 * 用户组
 * @author Administrator
 *
 */
class Group extends BaseModel
{

    /*****************************************用户组管理开始******************************************************************************/

    /**
     * 添加用户组
     * @param array $data
     * @return multitype:string mixed
     */
    public function addGroup($data)
    {

        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $app_module = isset($data['app_module']) ? $data['app_module'] : '';
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        Cache::tag("group_" . $site_id . '_' . $app_module)->clear();
        //预留验证
        $res = model('group')->add($data);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 修改用户组
     * @param array $data
     * @param array $condition
     * @return multitype:string mixed
     */
    public function editGroup($data, $condition)
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
        $condition[] = ["is_system", "=", 0];//只能删除非系统用户组
        Cache::tag("group_" . $site_id . '_' . $app_module)->clear();
        $res = model('group')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);

    }

    /**
     * 删除用户组(不能批量)
     * @param array $group_id
     * @param array $condition
     * @return multitype:string mixed
     */
    public function deleteGroup($condition)
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
        $group_id = isset($check_condition['group_id']) ? $check_condition['group_id'] : 0;
        if (!is_int($group_id) && $group_id <= 0) {
            return $this->error('', 'USER_GROUP_NOT_ALL_DELETE');
        }
        $temp_count = model('user')->getCount([["group_id", "=", $group_id], ["app_module", "=", $app_module], ["site_id", "=", $site_id]], "uid");
        if ($temp_count > 0)
            return $this->error('', 'USER_GROUP_USED');

        $condition[] = ["is_system", "=", 0];//只能删除非系统用户组
        Cache::tag("group_" . $site_id . '_' . $app_module)->clear();
        $res = model('group')->delete($condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 获取门店分组列信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getStoreGroupColumn($condition = [], $field = '')
    {
        $res = model('group')->getColumn($condition, $field);
        return $this->success($res);
    }

    /**
     * 修改用户组状态
     * @param array $data
     * @param array $condition
     * @return multitype:string mixed
     */
    public function modifyGroupStatus($group_status, $condition)
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
        $condition["is_system"] = 0;//只能删除非系统用户组
        Cache::tag("group_" . $site_id . '_' . $app_module)->clear();
        $res = model('group')->update(['group_status' => $group_status], $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 获取用户组详情
     * @param array $condition
     * @return multitype:string mixed
     */
    public function getGroupInfo($condition, $field = '*')
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
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("group_getGroupInfo_" . $site_id . '_' . $app_module . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('group')->getInfo($condition, $field);
        Cache::tag("group_" . $site_id . '_' . $app_module)->set("group_getGroupInfo_" . $site_id . '_' . $app_module . '_' . $data, $info);
        return $this->success($info);
    }

    /**
     * 通过groupid获取相应用户组数据，应用在门店，供应商等不创建站点
     * @param unknown $group_id
     * @param unknown $site_id
     * @param string $field
     * @return multitype:
     */
    public function getGroupInfoById($group_id, $site_id, $app_module, $field = '*')
    {
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $cache = Cache::get("group_getGroupInfoById_" . $site_id . '_' . $app_module . '_' . $group_id);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('group')->getInfo([['group_id', '=', $group_id], ['app_module', '=', $app_module]], $field);
        Cache::tag("group_" . $site_id . '_' . $app_module)->set("group_getGroupInfoById_" . $site_id . '_' . $app_module . '_' . $group_id, $info);
        return $this->success($info);
    }

    /**
     * 获取用户组列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return multitype:string mixed
     */
    public function getGroupList($condition = [], $field = true, $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        $app_module      = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("group_getGroupList_" . $site_id . '_' . $app_module . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('group')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("group_" . $site_id . '_' . $app_module)->set("group_getGroupList_" . $site_id . '_' . $app_module . '_' . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取管理组分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return multitype:string mixed
     */
    public function getGroupPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        $app_module      = isset($check_condition['app_module']) ? $check_condition['app_module'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if ($app_module === '') {
            return $this->error('', 'REQUEST_APP_MODULE');
        }
        $data  = json_encode([$condition, $page, $page_size, $order, $field]);
        $cache = Cache::get("group_getGroupPageList_" . $site_id . '_' . $app_module . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('group')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("group_" . $site_id . '_' . $app_module)->set("group_getGroupPageList_" . $site_id . '_' . $app_module . '_' . $data, $list);
        return $this->success($list);
    }


    /*****************************************用户组管理结束****************************************************************************/

}