<?php
// 事件定义文件
return [
    'bind' => [

    ],

    'listen' => [
        'OrderComplete'     => [
            'addon\memberconsume\event\OrderComplete',
        ],
        //订单消费奖励操作
        'OrderTakeDelivery' => [
            'addon\memberconsume\event\OrderTakeDelivery',
        ],
        'OrderPay'          => [
            'addon\memberconsume\event\OrderPay',
        ],
        //会员行为事件
        'MemberAction'      => [
            'addon\memberconsume\event\MemberAction',
        ],
        //展示活动
        'ShowPromotion'     => [
            'addon\memberconsume\event\ShowPromotion',
        ],

        'MemberAccountFromType' => [
            'addon\memberconsume\event\MemberAccountFromType',
        ],

        'MemberAccountRule' => [
            'addon\memberconsume\event\MemberAccountRule',
        ],
    ],

    'subscribe' => [
    ],
];
