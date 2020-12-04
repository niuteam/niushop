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


use app\model\express\Local as LocalModel;
use app\model\shop\Shop as ShopModel;
use app\model\system\Address as AddressModel;

/**
 * 配送
 * Class Express
 * @package app\shop\controller
 */
class Local extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     *  本地配送设置
     */
    public function local()
    {
        $shop_model       = new ShopModel();
        $shop_info_result = $shop_model->getShopInfo([['site_id', '=', $this->site_id]]);
        $shop_info        = $shop_info_result['data'];
        $local_model      = new LocalModel();
        if (request()->isAjax()) {
            if (empty($shop_info)) {
                return $local_model->error([], '店铺地址尚为配置');
            }

            $start_time = input('start_time', 0);
            $end_time   = input('end_time', 0);
            $time_is_open   = input('time_is_open', 0);
            $time_type   = input('time_type', 0);

            if (empty($time_is_open) || empty($time_type)) {
                $start_time = 0;
                $end_time = 0;
            }
            $data = [
                'type'            => input('type', 'default'),//配送方式  default 商家自配送  other 第三方配送
                'area_type'       => input('area_type', 1),//配送区域
                'local_area_json' => input('local_area_json', ''),//区域及业务集合json
                'time_is_open'    => input('time_is_open', 0),
                'time_type'       => input('time_type', 0),//时间选取类型 0 全天  1 自定义
                'time_week'       => input('time_week', ''),
                'start_time'      => $start_time,
                'end_time'        => $end_time,
                'update_time'     => time(),

                'is_open_step'             => input('is_open_step', 0),
                'start_distance'           => input('start_distance', 0),
                'start_delivery_money'     => input('start_delivery_money', 0),
                'continued_distance'       => input('continued_distance', 0),
                'continued_delivery_money' => input('continued_delivery_money', 0),
                'start_money'              => input('start_money', 0),
                'delivery_money'           => input('delivery_money', 0),
                'area_array'               => input('area_array', ''),//地域集合
            ];

            $condition = array(
                ['site_id', '=', $this->site_id]
            );
            return $local_model->editLocal($data, $condition);
        } else {
            if (empty($shop_info)) {
                $this->error('店铺地址尚为配置');
            }
            $this->assign('shop_detail', $shop_info);
            $local_result = $local_model->getLocalInfo([['site_id', '=', $this->site_id]]);

            $district_list = [];
            if ($shop_info['province'] > 0 && $shop_info['city'] > 0) {
                //查询省级数据列表
                $address_model = new AddressModel();
                $list          = $address_model->getAreaList([["pid", "=", $shop_info['city']], ["level", "=", 3]]);
                $district_list = $list["data"];
            }
            $this->assign('district_list', $district_list);
            $this->assign('local_info', $local_result['data']);
            return $this->fetch('local/local');
        }
    }
}