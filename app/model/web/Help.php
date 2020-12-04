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
 * 帮助中心管理
 * @author Administrator
 *
 */
class Help extends BaseModel
{
    /****************************************************************帮助文章******************************************/
    /**
     * 添加帮助文章
     * @param array $data
     */
    public function addHelp($data)
    {
        $help_id = model('help')->add($data);
        Cache::tag("help")->clear();
        return $this->success($help_id);
    }

    /**
     * 修改帮助文章
     * @param array $data
     */
    public function editHelp($data, $condition)
    {
        $res = model('help')->update($data, $condition);
        Cache::tag("help")->clear();
        return $this->success($res);
    }

    /**
     * 删除文章
     * @param unknown $coupon_type_id
     */
    public function deleteHelp($condition)
    {
        $res = model('help')->delete($condition);
        Cache::tag("help")->clear();
        return $this->success($res);
    }

    /**
     * 获取帮助文章详情
     * @param int $help_id
     * @return multitype:string mixed
     */
    public function getHelpInfo($help_id)
    {
        $cache = Cache::get("help_getHelpInfo_" . $help_id);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('help')->getInfo([['id', '=', $help_id]], 'id, title, content, class_id, class_name, sort, link_address, create_time, modify_time');
        Cache::tag("help")->set("help_getHelpInfo_" . $help_id, $res);
        return $this->success($res);
    }

    /**
     * 获取菜单列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getHelpList($condition = [], $field = 'id, title, content, class_id, class_name, sort, create_time', $order = '', $limit = null)
    {

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("help_getHelpList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('help')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("help")->set("help_getHelpList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取帮助文章分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getHelpPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc,create_time desc', $field = 'id, title, content, class_id, class_name, sort, link_address, create_time')
    {
        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("help_getHelpPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('help')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("help")->set("help_getHelpList_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $help_id
     */
    public function modifyHelpSort($sort, $help_id)
    {
        $res = model('help')->update(['sort' => $sort], [['id', '=', $help_id]]);
        Cache::tag('help')->clear();
        return $this->success($res);
    }

    /****************************************************************帮助文章表******************************************/
    /**
     * 添加帮助类型
     * @param array $data
     */
    public function addHelpClass($data)
    {

        $model = model('help_class');
        $res   = $model->add($data);

        if ($res) {
            Cache::tag("help_class")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 修改帮助类型(主键修改，不修改排序)
     * @param array $data
     * @param int $class_id
     */
    public function editHelpClass($data, $class_id)
    {
        $res = model('help_class')->update($data, [['class_id', '=', $class_id]]);
        if ($res !== false) {
            Cache::tag("help_class")->clear();
            model('help')->update(['class_name' => $data['class_name']], [['class_id', '=', $class_id]]);
            Cache::tag("help")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 获取帮助文章分类详情
     * @param array $condition
     * @param string $field
     */
    public function getHelpClassInfo($condition, $field = 'class_id, class_name, sort')
    {
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("help_class_getHelpClassInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('help_class')->getInfo($condition, $field);
        Cache::tag("help_class")->set("help_class_getHelpClassInfo_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取帮助文章分类分页列表
     * @param array $condition
     * @param number $page
     * @param number $page_size
     * @param string $order
     * @param string $field
     */
    public function getHelpClassPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc,create_time desc', $field = 'class_id, class_name, sort')
    {
        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("help_class_getHelpClassInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('help_class')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("help_class")->set("help_class_getHelpClassPageList_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取帮助文章分类列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param number $limit
     */
    public function getHelpClassList($condition = [], $field = 'class_id, class_name, sort', $order = '', $limit = null)
    {
        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("help_class_getHelpClassList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('help_class')->getList($condition, $field, $order, $alias = 'a', $join = [], $group = '', $limit);
        Cache::tag("help_class")->set("help_class_getHelpClassList_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 删除帮助文章分类
     * @param array $condition
     */
    public function deleteHelpClass($condition)
    {

        $model = model('help_class');
        $res   = $model->delete($condition);
        Cache::tag("help_class")->clear();
        if ($res) {
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $class_id
     */
    public function modifyHelpClassSort($sort, $class_id)
    {
        $res = model('help_class')->update(['sort' => $sort], [['class_id', '=', $class_id]]);
        Cache::tag('help_class')->clear();
        return $this->success($res);
    }
}
