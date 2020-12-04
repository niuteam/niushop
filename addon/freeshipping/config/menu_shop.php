<?php
// +----------------------------------------------------------------------
// | 店铺端菜单设置
// +----------------------------------------------------------------------
return [

    [
        'name'       => 'PROMOTION_FREESHIPPING',
        'title'      => '满额包邮',
        'url'        => 'freeshipping://shop/freeshipping/lists',
        'parent'     => 'PROMOTION_CENTER',
        'is_show'    => 0,
        'sort'       => 100,
        'child_list' => [
            [
                'name'       => 'PROMOTION_FREESHIPPING_LIST',
                'title'      => '满额包邮列表',
                'url'        => 'freeshipping://shop/freeshipping/lists',
                'parent'     => 'PROMOTION_FREESHIPPING',
                'is_show'    => 1,
                'child_list' => [
                    [
                        'name'    => 'PROMOTION_FREESHIPPING_ADD',
                        'title'   => '添加活动',
                        'url'     => 'freeshipping://shop/freeshipping/add',
                        'sort'    => 1,
                        'is_show' => 0
                    ],
                    [
                        'name'    => 'PROMOTION_FREESHIPPING_EDIT',
                        'title'   => '编辑活动',
                        'url'     => 'freeshipping://shop/freeshipping/edit',
                        'sort'    => 1,
                        'is_show' => 0
                    ],
                    [
                        'name'    => 'PROMOTION_FREESHIPPING_DELETE',
                        'title'   => '删除活动',
                        'url'     => 'freeshipping://shop/freeshipping/delete',
                        'sort'    => 1,
                        'is_show' => 0
                    ]

                ]

            ],
        ]
    ],

];