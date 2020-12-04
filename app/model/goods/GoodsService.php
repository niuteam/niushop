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
 * 商品服务
 */
class GoodsService extends BaseModel
{

    /**
     * 添加商品服务
     * @param array $data
     */
    public function addService($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data['create_time'] = time();
        $service_id          = model('goods_service')->add($data);
        Cache::tag("goods_service_" . $site_id)->clear();
        return $this->success($service_id);
    }

    /**
     * 添加多个商品服务
     * @param array $data
     */
    public function addServiceList($data)
    {
        $site_id = isset($data[0]['site_id']) ? $data[0]['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = time();
        }
        $service_id = model('goods_service')->addList($data);
        Cache::tag("goods_service_" . $site_id)->clear();
        return $this->success($service_id);
    }

    /**
     * 修改商品服务
     * @param array $data
     * @return multitype:string
     */
    public function editService($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_service')->update($data, [['id', '=', $data['id']]]);
        Cache::tag("goods_service_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 删除商品服务
     * @param array $condition
     */
    public function deleteService($condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_service')->delete($condition);
        Cache::tag("goods_service_" . $site_id)->clear();
        return $this->success($res);
    }


    /**
     * 获取商品服务列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getServiceList($condition = [], $field = 'id,site_id,service_name,desc,create_time', $order = 'create_time desc', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("goods_service_getList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_service')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_service_" . $site_id)->set("goods_service_getList_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品服务分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getServicePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc', $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("goods_service_getPageList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('goods_service')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("goods_service_" . $site_id)->set("goods_service_getPageList_" . $site_id . "_" . $data, $list);
        return $this->success($list);
    }

}