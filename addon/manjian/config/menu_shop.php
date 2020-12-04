<?php
// +----------------------------------------------------------------------
// | 平台端菜单设置
// +----------------------------------------------------------------------
return [
    [
        'name'           => 'PROMOTION_MANJIAN',
        'title'          => '满减送活动',
        'url'            => 'manjian://shop/manjian/lists',
        'parent'         => 'PROMOTION_CENTER',
        'is_show'        => 0,
        'is_control'     => 1,
        'is_icon'        => 0,
        'picture'        => '',
        'picture_select' => '',
        'sort'           => 100,
        'child_list'     => [
            [
                'name'    => 'PROMOTION_MANJIAN_DETAIL',
                'title'   => '活动详情',
                'url'     => 'manjian://shop/manjian/detail',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_MANJIAN_ADD',
                'title'   => '添加活动',
                'url'     => 'manjian://shop/manjian/add',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_MANJIAN_EDIT',
                'title'   => '编辑活动',
                'url'     => 'manjian://shop/manjian/edit',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_MANJIAN_CLOSE',
                'title'   => '关闭活动',
                'url'     => 'manjian://shop/manjian/close',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_MANJIAN_DELETE',
                'title'   => '删除活动',
                'url'     => 'manjian://shop/manjian/delete',
                'sort'    => 1,
                'is_show' => 0
            ],

        ]
    ],
];
