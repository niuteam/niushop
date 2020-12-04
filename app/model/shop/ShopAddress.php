<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\shop;

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 店铺地址库
 */
class ShopAddress extends BaseModel
{
    /**
     * 添加店铺地址库
     * @param array $data
     */
    public function addAddress($data)
    {
        $data["update_time"] = time();
        $res                 = model('shop_address')->add($data);
        Cache::tag("shop_address")->clear();
        return $this->success($res);
    }

    /**
     * 修改店铺地址库
     * @param array $data
     */
    public function editAddress($data, $condition)
    {
        $res = model('shop_address')->update($data, $condition);
        //修改对应店铺
        Cache::tag("shop_address")->clear();
        return $this->success($res);
    }

    /**
     * 删除店铺地址库
     * @param unknown $condition
     */
    public function deleteAddress($condition)
    {
        $res = model('shop_address')->delete($condition);
        Cache::tag("shop_address")->clear();
        return $this->success($res);
    }

    /**
     * 获取店铺地址库信息
     * @param unknown $condition
     * @param string $field
     */
    public function getAddressInfo($condition, $field = 'id, site_id, contact_name, mobile, postcode, province_id, city_id, district_id, community_id, address, full_address, is_return, is_return_default, is_delivery, update_time')
    {
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("shop_address_getAddressInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('shop_address')->getInfo($condition, $field);
        Cache::tag("shop_address")->set("shop_address_getAddressInfo_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取店铺地址库列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getAddressList($condition = [], $field = 'id, site_id, contact_name, mobile, postcode, province_id, city_id, district_id, community_id, address, full_address, is_return, is_return_default, is_delivery, update_time', $order = '', $limit = null)
    {

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("shop_address_getAddressList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('shop_address')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("shop_address")->set("shop_address_getAddressList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取店铺地址库分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getAddressPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'id, site_id, contact_name, mobile, postcode, province_id, city_id, district_id, community_id, address, full_address, is_return, is_return_default, is_delivery, update_time')
    {
        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("shop_address_getAddressPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('shop_address')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("shop_address")->set("shop_address_getAddressPageList_" . $data, $list);
        return $this->success($list);
    }
}