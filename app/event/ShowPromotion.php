<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

/**
 * 平台推广营销类展示
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
            'admin' => [

            ],
            'shop'  => [
                /*                 [
                                    //插件名称
                                    'name' => 'lucky',
                                    //店铺端展示分类  shop:营销活动   member:互动营销
                                    'show_type' => 'member',
                                    //展示主题
                                    'title' => '刮刮卡',
                                    //展示介绍
                                    'description' => '刮刮卡奖励',
                                    //展示图标
                                    'icon' => 'public/static/img/lucky.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'draw',
                                    //店铺端展示分类  shop:营销活动   member:互动营销
                                    'show_type' => 'member',
                                    //展示主题
                                    'title' => '大转盘',
                                    //展示介绍
                                    'description' => '大转盘奖励',
                                    //展示图标
                                    'icon' => 'public/static/img/draw.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'crazyguess',
                                    //店铺端展示分类  shop:营销活动   member:互动营销
                                    'show_type' => 'member',
                                    //展示主题
                                    'title' => '疯狂猜',
                                    //展示介绍
                                    'description' => '疯狂猜',
                                    //展示图标
                                    'icon' => 'public/static/img/crazyguess.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'coupon_code',
                                    //展示分类（根据平台端设置，admin（平台营销），shop：店铺营销，member:会员营销, tool:应用工具）
                                    'show_type' => 'shop',
                                    //展示主题
                                    'title' => '优惠码',
                                    //展示介绍
                                    'description' => '向客户发放优惠码',
                                    //展示图标
                                    'icon' => 'public/static/img/coupon_code.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'cashier',
                                    //展示分类（根据平台端设置，admin（平台营销），shop：店铺营销，member:会员营销, tool:应用工具）
                                    'show_type' => 'tool',
                                    //展示主题
                                    'title' => '扫码收款',
                                    //展示介绍
                                    'description' => '扫码收款',
                                    //展示图标
                                    'icon' => 'public/static/img/cashier.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'appointment',
                                    //展示分类（根据平台端设置，admin（平台营销），shop：店铺营销，member:会员营销, tool:应用工具）
                                    'show_type' => 'tool',
                                    //展示主题
                                    'title' => '店铺预约',
                                    //展示介绍
                                    'description' => '店铺预约',
                                    //展示图标
                                    'icon' => 'public/static/img/appointment.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ],
                                [
                                    //插件名称
                                    'name' => 'missioncenter',
                                    //展示分类（根据平台端设置，admin（平台营销），shop：店铺营销，member:会员营销, tool:应用工具）
                                    'show_type' => 'tool',
                                    //展示主题
                                    'title' => '任务管理',
                                    //展示介绍
                                    'description' => '会员完成任务奖励',
                                    //展示图标
                                    'icon' => 'public/static/img/missioncenter.png',
                                    //跳转链接
                                    'url' => '',
                                    //是否开发中仅展示
                                    'is_developing' => 1
                                ], */

            ]

        ];
        return $data;
    }
}