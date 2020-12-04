<?php
// 事件定义文件
return [
    'bind' => [

    ],

    'listen' => [
        //短信方式
        'SmsType' => [
            'addon\niusms\event\SmsType'
        ],
        'DoEditSmsMessage' => [
            'addon\niusms\event\DoEditSmsMessage'
        ],
        'SendSms' => [
            'addon\niusms\event\SendSms'
        ],
        'SmsTemplateInfo' => [
            'addon\niusms\event\SmsTemplateInfo'
        ],
        //启用回调，使用这个短信，就要关闭其他短信插件
        'EnableCallBack' => [
            'addon\niusms\event\EnableCallBack'
        ],
        //查询启用的短信插件
        'EnableSms' => [
            'addon\niusms\event\EnableSms'
        ],
        //关闭短信充值订单
        'CloseSmsPayment'  => [
            'addon\niusms\event\CloseSmsPayment',
        ],
    ],

    'subscribe' => [
    ],
];
