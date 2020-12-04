<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\coupon\event;

/**
 * 店铺活动
 */
class ShowPromotion
{

    /**
     * 活动展示
     *
     * @return multitype:number unknown
     */
    public function handle()
    {
        $data = [
            'shop' => [
                [
                    //插件名称
                    'name'        => 'coupon',
                    //展示分类（根据平台端设置，admin（平台营销），shop：店铺营销，member:会员营销, tool:应用工具）
                    'show_type'   => 'shop',
                    //展示主题
                    'title'       => '优惠券',
                    //展示介绍
                    'description' => '会员优惠券功能',
                    //展示图标
                    'icon'        => 'addon/coupon/icon.png',
                    //跳转链接
                    'url'         => 'coupon://shop/coupon/lists',
                ]
            ]

        ];
        return $data;
    }
}