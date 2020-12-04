<?php
// +----------------------------------------------------------------------
// | 店铺端菜单设置
// +----------------------------------------------------------------------
return [
    [
        'name' => 'PROMOTION_MEMBERCANCEL',
        'title' => '会员注销',
        'url' => 'membercancel://shop/membercancel/lists',
        'parent' => 'PROMOTION_ROOT',
        'picture' => 'addon/membercancel/shop/view/public/img/distribution.png',
        'is_show' => 1,
        'sort' => 1,
        'child_list' => [
            [
                'name' => 'MEMBER_CANCEL',
                'title' => '会员注销',
                'url' => 'membercancel://shop/membercancel/lists',
                'is_show' => 1,
                'sort' => 1,
                'child_list' => [

                ]
            ],
            [
                'name' => 'LOGIN_CANCEL_CONFIG',
                'title' => '注销设置',
                'url' => 'membercancel://shop/membercancel/cancelconfig',
                'is_show' => 1,
                'sort' => 2,
            ],
            [
                'name' => 'LOGIN_CANCEL_AGREEMENT',
                'title' => '注销协议',
                'url' => 'membercancel://shop/membercancel/cancelagreement',
                'is_show' => 1,
                'sort' => 3,
            ]
        ]
    ],
];