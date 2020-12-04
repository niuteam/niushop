<?php
// 事件定义文件
return [
    'bind' => [

    ],

    'listen' => [
        // 生成获取二维码
        'Qrcode'          => [
            'addon\weapp\event\Qrcode'
        ],
        // 开放数据解密
        'DecryptData'     => [
            'addon\weapp\event\DecryptData'
        ],
        // api配置变更
        'ApiConfigChange' => [
            'addon\weapp\event\ApiConfigChange'
        ],
    ],

    'subscribe' => [
    ],
];
