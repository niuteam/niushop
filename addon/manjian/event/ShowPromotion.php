<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\manjian\event;

/**
 * 活动展示
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
                    'name'        => 'manjian',
                    //店铺端展示分类  shop:营销活动   member:互动营销
                    'show_type'   => 'shop',
                    //展示主题
                    'title'       => '满减活动',
                    //展示介绍
                    'description' => '满减送活动',
                    //展示图标
                    'icon'        => 'addon/manjian/icon.png',
                    //跳转链接
                    'url'         => 'manjian://shop/manjian/lists',
                ]
            ]

        ];
        return $data;
    }
}