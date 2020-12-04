<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace app\api\controller;

use app\model\store\Store as StoreModel;

/**
 * 门店
 * @author Administrator
 *
 */
class Store extends BaseApi
{

    /**
     * 列表信息
     */
    public function page()
    {

//        $page = isset($this->params['page']) ? $this->params['page'] : 1;
//        $page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
        $latitude = isset($this->params[ 'latitude' ]) ? $this->params[ 'latitude' ] : null; // 纬度
        $longitude = isset($this->params[ 'longitude' ]) ? $this->params[ 'longitude' ] : null; // 经度
        $store_id = isset($this->params[ 'store_id' ]) ? $this->params[ 'store_id' ] : 0; // 默认门店
        $store_model = new StoreModel();
        $condition = [
            [ 'site_id', "=", $this->site_id ],
            [ 'status', '=', 1 ],
            [ 'is_frozen', '=', 0 ],
            [ 'is_pickup', '=', 1 ]
        ];

        $latlng = array (
            'lat' => $latitude,
            'lng' => $longitude,
        );
        $field = '*';
        $list_result = $store_model->getLocationStoreList($condition, $field, $latlng);

        $list = $list_result[ 'data' ];

        if (!empty($longitude) && !empty($latitude) && !empty($list)) {
            foreach ($list as $k => $item) {
                if ($item[ 'longitude' ] && $item[ 'latitude' ]) {
                    $distance = getDistance((float) $item[ 'longitude' ], (float) $item[ 'latitude' ], (float) $longitude, (float) $latitude);
                    $list[ $k ][ 'distance' ] = $distance / 1000;
                } else {
                    $list[ $k ][ 'distance' ] = 0;
                }
            }
            // 按距离就近排序
            array_multisort(array_column($list, 'distance'), SORT_ASC, $list);
        }
//        array_multisort(array_column($list, 'distance'), SORT_ASC, $list);
        $default_store_id = 0;
        if (!empty($list)) {
            $default_store_id = $list[ 0 ][ 'store_id' ];
        }
        return $this->response($this->success([ 'list' => $list, 'store_id' => $default_store_id ]));
    }

    /**
     * 基础信息
     * @return false|string
     */
    public function info()
    {
        $store_id = isset($this->params[ 'store_id' ]) ? $this->params[ 'store_id' ] : 0;
        $latitude = isset($this->params[ 'latitude' ]) ? $this->params[ 'latitude' ] : null; // 纬度
        $longitude = isset($this->params[ 'longitude' ]) ? $this->params[ 'longitude' ] : null; // 经度

        if (empty($store_id)) {
            return $this->response($this->error('', 'REQUEST_STORE_ID'));
        }
        $condition = [
            [ 'store_id', "=", $store_id ],
            [ 'site_id', "=", $this->site_id ],
            [ 'status', '=', 1 ]
        ];

        $latlng = array (
            'lat' => $latitude,
            'lng' => $longitude,
        );

        $store_model = new StoreModel();
        $field = 'store_id,store_name,telphone,store_image,site_id,address,full_address,longitude,latitude,open_date';
        if ($latlng[ 'lat' ] !== null && $latlng[ 'lng' ] !== null) {
            $field .= ',FORMAT(st_distance ( point ( ' . $latlng[ 'lng' ] . ', ' . $latlng[ 'lat' ] . ' ), point ( longitude, latitude ) ) * 111195 / 1000, 2) as distance';
        }
        $res = $store_model->getStoreInfo($condition, $field);
        return $this->response($res);
    }

}