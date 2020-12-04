<?php

return [
    //基础返回值
    'SUCCESS' => '操作成功' ,
    'FAIL' => '操作失败' ,
    'SAVE_SUCCESS' => '保存成功' ,
    'SAVE_FAIL' => '保存失败' ,
    'REQUEST_SUCCESS' => '请求成功' ,
    'REQUEST_FAIL' => '请求失败' ,
    'DELETE_SUCCESS' => '删除成功' ,
    'DELETE_FAIL' => '删除失败' ,
    'UNKNOW_ERROR' => '未知错误' ,
    'PARAMETER_ERROR' => '参数错误' ,
    'REQUEST_SITE_ID' => '缺少必须参数站点id' ,
    'REQUEST_APP_MODULE' => '缺少必须参数应用模块' ,

    //运费
    'TEMPLATE_TO_LONG' => '每个站点最多添加10条运费模板' ,
    'TEMPLATE_EMPTY' => '为设置完善配送方式' ,
    'TEMPLATE_AREA_EXIST' => '当前收货地址不支持配送' ,
    //商品
    'REQUEST_GOODS_ATTRIBUTE_ID' => '缺少必须参数商品类型id' ,
    //会员相关
    'MEMBER_NOT_EXIST' => '会员不存在' ,
    'MEMBER_IS_LOCKED' => '会员被锁定' ,
    'USERNAME_EXISTED' => '用户名已存在' ,
    'MOBILE_EXISTED' => '手机号已存在' ,
    'EMAIL_EXISTED' => '邮箱已存在' ,
    'REGISTER_REFUND' => '未开放注册' ,
    'USERNAME_OR_PASSWORD_ERROR' => '用户名或密码错误' ,
    //消息管理
    'REQUEST_KEYWORDS' => '缺少必须消息关键字' ,
    'EMPTY_SMS_TYPE' => '没有可用的短信发送方式' ,
    'SMS_FAIL' => '短信发送失败' ,
    'SMS_SUCCESS' => '短信发送成功' ,
    'EMAIL_FAIL' => '邮件发送失败' ,
    'EMAIL_SUCCESS' => '邮件发送成功' ,
    //订单
    "COUPON_ERROR" => '优惠券不存在或者已经使用' ,
    "ORDER_DELIVERY_CODE_ERROR" => '订单提货码错误' ,
    "ORDER_EMPTY" => '订单不存在' ,
    "ORDER_LOCK" => '订单已被锁定' ,
    "ORDER_GOODS_IS_REFUND" => '存在已退款的订单项' ,
    "ORDER_GOODS_EMPTY" => '订单项不存在' ,
    "ORDER_GOODS_IS_DELIVERYED" => '订单项已发货' ,
    //店铺
    "MEMBER_SHOP_BIND_EXISTED" => '会员已经申请店铺或者已入驻' ,
    "APPLY_EXISTED" => '商家申请已存在' ,
    "SHOP_EXISTED" => '店铺已存在' ,
    "NOT_SUPPORT_SHOP_WITHDRAW" => '系统不支持手动转账' ,
    "SHOP_APPLY_MONEY_NOT_ENOUGH" => '申请金额超过了账户金额' ,
    //基础系统
    'REQUEST_CONFIG_KEY' => '缺少必须参数config key' ,
    'REQUEST_DOCUMENT_KEY' => '缺少必须参数document key' ,
    'CONFIG_NOT_EXIST' => '配置不存在,无法开启' ,
    //插件安装与卸载
    'ADDON_NOT_EXIST' => '插件不存在' ,
    'ADDON_IS_EXIST' => '插件已经存在' ,
    'ADDON_INFO_ERROR' => '插件信息有误，请检查信息缺失或插件标识重复' ,
    'ADDON_INSTALL_MENU_FAIL_EXISTED' => '安装菜单失败：菜单已存在' ,
    'ADDON_INSTALL_MENU_FAIL' => '安装菜单失败' ,
    'ADDON_INSTALL_FAIL' => '安装插件失败' ,
    'ADDON_ADD_FAIL' => '安装插件失败：写入插件数据失败' ,
    'ADDON_UNINSTALL_FAIL' => '执行卸载失败' ,
    'ADDON_UNINSTALL_MENU_FAIL' => '执行卸载失败' ,
    //数据库
    'DABASE_REPAIR_FAIL' => '数据库修复失败' ,
    'DATABASE_OPTIMIZE_FAIL' => '数据表优化失败' ,
    'REQUEST_DATABASE_TABLE' => '请指定要选择的数据表' ,
    //用户
    'USER_EXISTED' => '用户已存在' ,
    'USER_NOT_EXIST' => '用户不存在' ,
    'USER_IS_LOCKED' => '用户已被锁定' ,
    'PASSWORD_ERROR' => '用户密码错误' ,
    'PERMISSION_DENIED' => '当前用户没有权限' ,
    'USER_GROUP_NOT_ALL_DELETE' => '用户组不能批量删除' ,
    'USER_GROUP_USED' => '存在使用当前用户组的用户,不可删除!' ,
    'USER_LOGIN_ERROR' => '账号或密码错误' ,

    'CAPTCHA_FAILURE' => '验证码已失效' ,
    'CAPTCHA_ERROR' => '验证码不正确' ,
    //上传
    'UPLOAD_SUCCESS' => '上传成功' ,
    'ALBUM_DELETE_FAIL_BY_PIC' => '当前删除相册中存在图片,不可删除!' ,
    'ALBUM_DELETE_FAIL_BY_DEFAULT' => '当前删除相册中存在默认相册,默认相册不可删除!' ,
    'SIGNED_IN' => '您已签到' ,
    'PAY_PASSWORD_ERROR' => '支付密码错误' ,
    'OLD_PAY_PASSWORD_ERROR' => '原支付密码错误' ,
    'RESULT_ERROR' => '返回结果错误' ,
    'UPLOAD_TYPE_ERROR' => '上传格式有误' ,

    //核销
    'VERIFIER_FAIL' => '当前核销员没有核销权限' ,
    'IS_VERIFYED' => '核销码已被使用' ,

    // 消息通知
    'NOT_SET_SMS_TEMPLATE' => '商家未配置该模板' ,
    'SMS_AMOUNT' => '短信余额不足，请联系店家' ,
    'MESSAGE_FAIL' => '消息发送失败',

    // 营销活动
    'GOODS_EXIST_MANJIAN' => '有商品已存在满减活动',

    // 小程序发布
    'RELEASE_SUCCESS' => '发布成功',
    'CANCEL_SUCCESS' => '审核撤回成功',

    //会员账户
    'ACCOUNT_EMPTY' => '账户余额不足',
    'MOBILE_EXISTS' => '该手机号已存在'
];