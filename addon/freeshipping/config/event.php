<?php
// 事件定义文件
return [
    'bind' => [

    ],

    'listen' => [
        //展示活动
        'ShowPromotion' => [
            'addon\freeshipping\event\ShowPromotion',
        ],

        'PromotionType' => [
            'addon\freeshipping\event\PromotionType',
        ],

    ],

    'subscribe' => [
    ],
];
