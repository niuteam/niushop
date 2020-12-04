<?php
// 事件定义文件
return [
    'bind' => [
    ],

    'listen' => [

        //展示活动
        'ShowPromotion'      => [
            'addon\bundling\event\ShowPromotion',
        ],
        'PromotionType'      => [
            'addon\bundling\event\PromotionType',
        ],
        // 订单营销活动类型
        'OrderPromotionType' => [
            'addon\bundling\event\OrderPromotionType',
        ],
        // 删除商品（需判断套餐是否存在该商品，存在活动关闭）
        'DeleteGoods' => [
            'addon\bundling\event\DeleteGoods',
        ],
    ],

    'subscribe' => [
    ],
];
