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

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 商品分组
 */
class GoodsLabel extends BaseModel
{

    /**
     * 添加商品分组
     * @param array $data
     */
    public function addLabel($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data['create_time'] = time();
        $label_id            = model('goods_label')->add($data);
        Cache::tag("goods_label_" . $site_id)->clear();
        return $this->success($label_id);
    }

    /**
     * 修改商品分组
     * @param array $data
     * @return multitype:string
     */
    public function editLabel($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data['update_time'] = time();
        $res                 = model('goods_label')->update($data, [['id', '=', $data['id']], ['site_id', '=', $data['site_id']]]);
        Cache::tag("goods_label_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 删除商品分组
     * @param array $condition
     */
    public function deleteLabel($condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_label')->delete($condition);
        Cache::tag("goods_label_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 修改排序
     * @param $sort
     * @param $id
     * @param $site_id
     * @return array
     */
    public function modifySort($sort, $id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_label')->update(['sort' => $sort], [['id', '=', $id], ['site_id', '=', $site_id]]);
        Cache::tag("goods_label_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 获取商品分组列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getLabelList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("goods_label_getList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_label')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_label_" . $site_id)->set("goods_label_getList_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品分组分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getLabelPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc', $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("goods_label_getPageList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('goods_label')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("goods_label_" . $site_id)->set("goods_label_getPageList_" . $site_id . "_" . $data, $list);
        return $this->success($list);
    }

}