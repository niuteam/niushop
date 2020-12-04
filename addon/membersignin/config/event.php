<?php
// 事件定义文件
return [
    'bind' => [

    ],

    'listen' => [
        //会员行为事件
        'MemberAction'      => [
            'addon\memberregister\event\MemberAction',
        ],
        //展示活动
        'ShowPromotion'     => [
            'addon\membersignin\event\ShowPromotion',
        ],
        //会员签到奖励规则
        'MemberSigninAward' => [
            'addon\membersignin\event\MemberSigninAward',
        ],
        //会员签到
        'MemberSignin'      => [
            'addon\membersignin\event\MemberSignin',
        ],

        'MemberAccountFromType' => [
            'addon\membersignin\event\MemberAccountFromType',
        ],

        'MemberAccountRule' => [
            'addon\membersignin\event\MemberAccountRule',
        ],
    ],

    'subscribe' => [
    ],
];
