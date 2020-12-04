<?php
// +----------------------------------------------------------------------
// | 平台端菜单设置
// +----------------------------------------------------------------------
return [
    [
        'name' => 'MEMBER_SIGNIN',
        'title' => '会员签到',
        'url' => 'membersignin://shop/config/index',
        'parent' => 'PROMOTION_MEMBER',
        'is_show' => 0,
        'is_control' => 1,
        'is_icon' => 0,
        'picture' => '',
        'picture_select' => '',
        'sort' => 100,
        'child_list' => []
    ],
];
