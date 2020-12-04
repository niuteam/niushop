<?php
// +----------------------------------------------------------------------
// | 平台端菜单设置
// +----------------------------------------------------------------------
return [
    [
        'name'           => 'PROMOTION_DISCOUNT',
        'title'          => '限时折扣',
        'url'            => 'discount://shop/discount/lists',
        'parent'         => 'PROMOTION_CENTER',
        'is_show'        => 0,
        'is_control'     => 1,
        'is_icon'        => 0,
        'picture'        => '',
        'picture_select' => '',
        'sort'           => 100,
        'child_list'     => [
            [
                'name'    => 'PROMOTION_DISCOUNT_DETAIL',
                'title'   => '活动详情',
                'url'     => 'discount://shop/discount/detail',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_ADD',
                'title'   => '添加活动',
                'url'     => 'discount://shop/discount/add',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_EDIT',
                'title'   => '编辑活动',
                'url'     => 'discount://shop/discount/edit',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_CLOSE',
                'title'   => '关闭活动',
                'url'     => 'discount://shop/discount/close',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_DELETE',
                'title'   => '删除活动',
                'url'     => 'discount://shop/discount/delete',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_MANAGE',
                'title'   => '商品管理',
                'url'     => 'discount://shop/discount/manage',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_GOODS_SELECT',
                'title'   => '商品选择',
                'url'     => 'discount://shop/discount/selectgoods',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_GOODS_ADD',
                'title'   => '商品添加',
                'url'     => 'discount://shop/discount/addgoods',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_GOODS_UPDATE',
                'title'   => '商品修改',
                'url'     => 'discount://shop/discount/updategoods',
                'sort'    => 1,
                'is_show' => 0
            ],
            [
                'name'    => 'PROMOTION_DISCOUNT_GOODS_DELETE',
                'title'   => '商品删除',
                'url'     => 'discount://shop/discount/deletegoods',
                'sort'    => 1,
                'is_show' => 0
            ],
        ]
    ],
];
