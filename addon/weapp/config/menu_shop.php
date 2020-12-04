<?php
// +----------------------------------------------------------------------
// | 平台端菜单设置
// +----------------------------------------------------------------------
return [
    [
        'name' => 'WEAPP_ROOT',
        'title' => '微信小程序',
        'url' => 'weapp://shop/weapp/setting',
        'parent' => 'CHANNEL_ROOT',
        'picture_select' => '',
        'picture' => 'addon/weapp/shop/view/public/img/menu_icon/wechat_app.png',
        'is_show' => 1,
        'sort' => 4,
        'child_list' => [
            [
                'name' => 'WEAPP_CONFIG',
                'title' => '小程序配置',
                'url' => 'weapp://shop/weapp/config',
                'is_show' => 0
            ],
            [
                'name' => 'WEAPP_PACKAGE',
                'title' => '小程序包管理',
                'url' => 'weapp://shop/weapp/package',
                'is_show' => 0
            ],
    ],

    ]
];
