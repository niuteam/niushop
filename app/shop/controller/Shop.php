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

use app\model\shop\Shop as ShopModel;
use app\model\system\Address as AddressModel;
use app\model\system\Site;
use app\model\web\Config as ConfigModel;

/**
 * 店铺
 * Class Shop
 * @package app\shop\controller
 */
class Shop extends BaseShop
{


    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 店铺设置
     * @return mixed
     */
    public function config()
    {
        $shop_model = new ShopModel();
        $site_model = new Site();
        $condition = array (
            [ "site_id", "=", $this->site_id ]
        );
        if (request()->isAjax()) {
            $site_name = input('site_name', '');
            $logo = input("logo", '');//店铺logo
            $avatar = input("avatar", '');//店铺头像（大图）
            $banner = input("banner", '');//店铺条幅
            $seo_keywords = input("seo_keywords", '');//店铺关键字
            $seo_description = input("seo_description", '');//店铺简介
            $qq = input("qq", '');//qq
            $ww = input("ww", '');//ww
            $telephone = input("telephone", '');//联系电话
            $shop_status = input('shop_status',1);//商城状态

            $data_site = array (
                "site_name" => $site_name,
                "logo" => $logo,
                "seo_keywords" => $seo_keywords,
                "seo_description" => $seo_description
            );

            $work_week = input("work_week", '');//工作日  例如 : 1,2,3,4,5,6,7
            $start_time = input("start_time", 0);//开始时间
            $end_time = input("end_time", 0);//结束时间

            $data_shop = array (
                "avatar" => $avatar,
                "banner" => $banner,
                "qq" => $qq,
                "ww" => $ww,
                "telephone" => $telephone,
                "work_week" => $work_week,
                "start_time" => $start_time,
                "end_time" => $end_time,
            );
            $site_model->editSite($data_site, $condition);
            $res = $shop_model->editShop($data_shop, $condition);
            if($res['code'] >= 0){

                $shop_model->setShopStatus(['shop_status'=> $shop_status],$this->site_id,$this->app_module);
            }
            return $res;
        } else {

            $shop_info_result = $shop_model->getShopInfo($condition);
            $site_info = $site_model->getSiteInfo($condition);

            //商城状态
            $shop_status_result = $shop_model->getShopStatus($this->site_id,$this->app_module);
            $shop_status = $shop_status_result['data']['value'];
            $this->assign('shop_status',$shop_status['shop_status']);

            $config_model = new ConfigModel();
            $info = $config_model->geth5DomainName();
            $this->assign('domain_name_h5', $info[ 'data' ][ 'value' ][ 'domain_name_h5' ]);

            $shop_info = array_merge($shop_info_result[ "data" ], $site_info[ 'data' ]);
            $this->assign("shop_info", $shop_info);
            return $this->fetch("shop/config");
        }

    }

    /**
     * 联系方式
     * @return mixed
     */
    public function contact()
    {
        $shop_model = new ShopModel();
        $condition = array (
            [ "site_id", "=", $this->site_id ]
        );
        if (request()->isAjax()) {
            $province = input("province", 0);//省级地址
            $province_name = input("province_name", '');//省级地址
            $city = input("city");//市级地址
            $city_name = input("city_name", '');//市级地址
            $district = input("district", 0);//县级地址
            $district_name = input("district_name", '');//县级地址
            $community = input("community", 0);//乡镇地址
            $community_name = input("community_name", '');//乡镇地址
            $address = input("address", 0);//详细地址
            $full_address = input("full_address", 0);//完整地址
            $longitude = input("longitude", '');//经度
            $latitude = input("latitude", '');//纬度

            $qq = input("qq", '');//qq号
            $ww = input("ww", '');//阿里旺旺
            $email = input("email", '');//邮箱
            $telephone = input("telephone", '');//联系电话
            $name = input("name", '');//联系人姓名
            $mobile = input("mobile", '');//联系人手机号

            $data = array (
                "province" => $province,
                "province_name" => $province_name,
                "city" => $city,
                "city_name" => $city_name,
                "district" => $district,
                "district_name" => $district_name,
                "community" => $community,
                "community_name" => $community_name,
                "address" => $address,
                "full_address" => $full_address,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "qq" => $qq,
                "ww" => $ww,
                "email" => $email,
                "telephone" => $telephone,
                "name" => $name,
                "mobile" => $mobile
            );
            $res = $shop_model->editShop($data, $condition);
            return $res;
        } else {
            $shop_info_result = $shop_model->getShopInfo($condition);
            $shop_info = $shop_info_result[ "data" ];
            $this->assign("info", $shop_info);

            //查询省级数据列表
            $address_model = new AddressModel();
            $list = $address_model->getAreaList([ [ "pid", "=", 0 ], [ "level", "=", 1 ] ]);
            $this->assign("province_list", $list[ "data" ]);
            $this->assign("http_type", get_http_type());
            return $this->fetch("shop/contact");
        }

    }

    /**
     * 店铺推广
     * return
     */
    public function shopUrl()
    {
        //获取商品sku_id
        $shop_model = new ShopModel();
        $res = $shop_model->qrcode($this->site_id);
        // dump($res);exit;
        return $res;
    }

}