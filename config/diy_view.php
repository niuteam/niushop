<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */
return [
    'template' => [
//		[
//			'name' => 'DIYVIEW_INDEX',
//			'title' => '网站主页',
//			'value' => '',
//			'type' => 'SHOP',
//			'icon' => ''
//		],
    ],
    'util' => [
        [
            'name' => 'TEXT',
            'title' => '文本',
            'type' => 'SYSTEM',
            'controller' => 'Text',
            'value' => '{ title : "『文本』", textColor : "#333333", "defaultTextColor": "#333333", "alignStyle": "center", subTitle : "副标题", "marginTop": 0, "padding": 0, backgroundColor : "", "link" : {}, "fontSize" : 16, "fontSizeSub" : 14, "colorSub": "#999", "defaultColorSub": "#999", "style": 1, "sub": 0, "styleName": "模板一", "isShowMore": 0, "fontWeight": 600, "moreText": "查看更多", "moreLink" : {}, "btnColor": "#999", "defaultBtnColor": "#999" }',
            'sort' => '10000',
            'support_diy_view' => '',
            'max_count' => 0,
            'is_delete' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/text.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/text_selected.png'
        ],
        /* [
            'name' => 'TEXT_NAV',
            'title' => '文本导航',
            'type' => 'SYSTEM',
            'controller' => 'TextNav',
            'value' => '{ fontSize : 14, textColor : "#333333", "defaultTextColor" : "#333333", textAlign : "left", backgroundColor : "", arrangement : "vertical", list : [{ text : "『文本导航』",secondText : "","link" : {}}] }',
            'sort' => '10001',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/text_nav.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/text_nav_selected.png'
        ], */
        [
            'name' => 'NOTICE',
            'title' => '公告',
            'type' => 'SYSTEM',
            'controller' => 'Notice',
            'value' => '{ "sources": "default","backgroundColor": "", "marginTop": 0, "style": 1, "isEdit": 1, "styleName": "风格一", "textColor": "#333333", "defaultTextColor": "#333333", "fontSize": 14,"list": [{"title": "公告","link": {}}], "noticeIds": []}',
            'sort' => '10002',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/notice.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/notice_selected.png'
        ],
        [
            'name' => 'GRAPHIC_NAV',
            'title' => '图文导航',
            'type' => 'SYSTEM',
            'controller' => 'GraphicNav',
            'value' => '{ "textColor": "#666666","defaultTextColor": "#666666", "navRadius": "fillet", "backgroundColor": "","selectedTemplate": "imageNavigation", "showType": 4, "scrollSetting": "fixed", padding : 20, "marginTop": 0, "list": [{"imageUrl": "","title": "","link": {}, "imgWidth": 0, "imgHeight": 0},{"imageUrl": "","title": "","link": {}, "imgWidth": 0, "imgHeight": 0},{"imageUrl": "","title": "","link": {}, "imgWidth": 0, "imgHeight": 0},{"imageUrl": "","title": "","link": {}, "imgWidth": 0, "imgHeight": 0}]}',
            'sort' => '10003',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/graphic_nav.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/graphic_nav_selected.png'
        ],
        [
            'name' => 'IMAGE_ADS',
            'title' => '图片广告',
            'type' => 'SYSTEM',
            'controller' => 'ImageAds',
            'value' => '{ selectedTemplate : "carousel-posters", imageClearance : 0, "imageRadius": "right-angle", "carouselChangeStyle": "circle", "marginTop": 0, padding : 0, height : 0, list : [ { imageUrl : "", title : "", "link" : {}, "imgWidth": 0, "imgHeight": 0} ] }',
            'sort' => '10004',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/image_ads.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/image_ads_selected.png'
        ],
        [
            'name' => 'SEARCH',
            'title' => '商品搜索',
            'type' => 'SYSTEM',
            'controller' => 'Search',
            'value' => '{ title : "搜索", "textColor": "#999999", "textAlign" : "left", "backgroundColor" : "#ffffff", "bgColor": "#e8e8e8", "defaultTextColor": "#999999", "borderType": 2 ,searchType:1,searchImg:"",searchStyle:1}',
            'sort' => '10005',
            'support_diy_view' => '',
            'max_count' => 1,
            'icon' => 'public/static/ext/diyview/img/icon/search.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/search_selected.png'
        ],
//        [
//            'name' => 'TITLE',
//            'title' => '顶部标题',
//            'type' => 'SYSTEM',
//            'controller' => 'Title',
//            'value' => '{ "title": "『顶部标题』","backgroundColor": "","textColor": "#000000","defaultTextColor": "#000000","isOpenOperation" : false,"leftLink" : {},"rightLink" : {},"operationName" : "操作","fontSize" : 16}',
//            'sort' => '10006',
//            'support_diy_view' => '',
//            'max_count' => 1,
//            'icon' => 'public/static/ext/diyview/img/icon/title.png',
//            'icon_selected' => 'public/static/ext/diyview/img/icon/title_selected.png'
//        ],
        [
            'name' => 'RICH_TEXT',
            'title' => '富文本',
            'type' => 'SYSTEM',
            'controller' => 'RichText',
            'value' => '{ "backgroundColor": "","padding": 10,"html" : "", "marginTop": 0}',
            'sort' => '10007',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/rich_text.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/rich_text_selected.png'
        ],
        [
            'name' => 'RUBIK_CUBE',
            'title' => '魔方',
            'type' => 'SYSTEM',
            'controller' => 'RubikCube',
            'value' => '{ "selectedTemplate": "row1-of2","backgroundColor": "","list": [{ imageUrl : "", link : {} },{ imageUrl : "", link : {} }], "selectedRubikCubeArray" : [] ,"diyHtml": "","customRubikCube": 4,"heightArray": ["74.25px","59px","48.83px","41.56px"],"imageGap": 0}',
            'sort' => '10008',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/rubik_cube.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/rubik_cube_selected.png'
        ],
//		[
//			'name' => 'CUSTOM_MODULE',
//			'title' => '自定义模块',
//			'type' => 'SYSTEM',
//			'controller' => '',
//			'value' => '',
//			'sort' => '10009',
//			'support_diy_view' => '',
//			'max_count' => 0
//		],
        [
            'name' => 'HORZ_LINE',
            'title' => '辅助线',
            'type' => 'SYSTEM',
            'controller' => 'HorzLine',
            'value' => '{ "color" : "#000000", "defaultColor" : "#000000", "margin" : 0, "borderStyle": "solid", "padding": 0 }',
            'sort' => '10011',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/horz_line.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/horz_line_selected.png'
        ],
        [
            'name' => 'HORZ_BLANK',
            'title' => '辅助空白',
            'type' => 'SYSTEM',
            'controller' => 'HorzBlank',
            'value' => '{ height : 10, backgroundColor : "", "marginLeftRight": 0 }',
            'sort' => '10012',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/horz_blank.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/horz_blank_selected.png'
        ],
//		[
//			'name' => 'VIDEO',
//			'title' => '视频',
//			'type' => 'SYSTEM',
//			'controller' => '',
//			'value' => '',
//			'sort' => '10013',
//			'support_diy_view' => '',
//			'max_count' => 0
//		],
//		[
//			'name' => 'VOICE',
//			'title' => '语音',
//			'type' => 'SYSTEM',
//			'controller' => '',
//			'value' => '',
//			'sort' => '10014',
//			'support_diy_view' => '',
//			'max_count' => 0
//		],
        [
            'name' => 'GOODS_LIST',
            'title' => '商品列表',
            'type' => 'SYSTEM',
            'controller' => 'GoodsList',
            'value' => '{ "sources" : "default", "categoryId" : 0, "categoryName": "请选择", "goodsCount" : "6", "goodsId": [], "style": 1, "backgroundColor": "", "marginTop": 0, "paddingLeftRight": 0, "isShowCart": 0, "cartStyle": 1, "isShowGoodName": 1, "isShowMarketPrice": 1, "isShowGoodSaleNum": 1, "isShowGoodSubTitle": 0, "goodsTag": "default", "tagImg": {"imageUrl": ""} }',
            'sort' => '10016',
            'support_diy_view' => '',
            'max_count' => 0,
            'icon' => 'public/static/ext/diyview/img/icon/goods_list.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/goods_list_selected.png'
        ],
        [
            'name' => 'GOODS_CATEGORY',
            'title' => '商品分类',
            'type' => 'SYSTEM',
            'controller' => 'GoodsCategory',
            'value' => '{"level":"1","template":"1"}',
            'sort' => '10021',
            'support_diy_view' => '',
            'max_count' => 1,
            'icon' => 'public/static/ext/diyview/img/icon/goods_category.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/goods_category_selected.png'
        ],
        [
            'name' => 'FLOAT_BTN',
            'title' => '浮动按钮',
            'type' => 'SYSTEM',
            'controller' => 'FloatBtn',
            'value' => '{ "textColor": "#ffffff", "backgroundColor": "",baseBtnBottom:0,"btnBottom":"0","bottomPosition": "4", subTitle : "", "list": [{"imageUrl": "","title": "","link": {}}]}',
            'sort' => '10022',
            'support_diy_view' => '',
            'max_count' => 1,
            'icon' => 'public/static/ext/diyview/img/icon/float_btn.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/float_btn_selected.png'
        ],
        [
            'name' => 'TOP_CATEGORY',
            'title' => '分类导航',
            'type' => 'SYSTEM',
            'controller' => 'TopCategory',
            'value' => '{"title":"首页","selectColor":"#FF4544","nsSelectColor":"#333333",backgroundColor : "",styleType:"line"}',
            'sort' => '10023',
            'support_diy_view' => '',
            'max_count' => 1,
            'icon' => 'public/static/ext/diyview/img/icon/top_category.png',
            'icon_selected' => 'public/static/ext/diyview/img/icon/top_category_selected.png'
        ],
    ],
    'link' => [
        [
            'name' => 'MALL_PAGE',
            'title' => '商城页面',
            'parent' => '',
            'wap_url' => '',
            'web_url' => '',
            'sort' => 1,
            'child_list' => [
                [
                    'name' => 'MALL_LINK',
                    'title' => '商城链接',
                    'parent' => '',
                    'wap_url' => '',
                    'web_url' => '',
                    'sort' => 0,
                    'child_list' => [
                        [
                            'name' => 'BASICS_LINK',
                            'title' => '基础链接',
                            'parent' => '',
                            'wap_url' => '',
                            'web_url' => '',
                            'sort' => 0,
                            'child_list' => [
                                [
                                    'name' => 'INDEX',
                                    'title' => '主页',
                                    'parent' => '',
                                    'wap_url' => '/pages/index/index/index',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SHOP_CATEGORY',
                                    'title' => '商品分类',
                                    'parent' => '',
                                    'wap_url' => '/pages/goods/category/category',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SHOPPING_TROLLEY',
                                    'title' => '购物车',
                                    'parent' => '',
                                    'wap_url' => '/pages/goods/cart/cart',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SHOPPING_NOTICE',
                                    'title' => '公告',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/notice/list/list',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SHOPPING_HELP',
                                    'title' => '帮助',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/help/list/list',
                                    'web_url' => '',
                                    'sort' => 0
                                ]
                            ]
                        ],
                        [
                            'name' => 'MEMBER',
                            'title' => '会员中心',
                            'parent' => '',
                            'wap_url' => '',
                            'web_url' => '',
                            'sort' => 1,
                            'child_list' => [
                                [
                                    'name' => 'MEMBER_CENTER',
                                    'title' => '会员中心',
                                    'parent' => '',
                                    'wap_url' => '/pages/member/index/index',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'OBLIGATION_ORDER',
                                    'title' => '待付款订单',
                                    'parent' => '',
                                    'wap_url' => '/pages/order/list/list?status=waitpay',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'DELIVER_ORDER',
                                    'title' => '待发货订单',
                                    'parent' => '',
                                    'wap_url' => '/pages/order/list/list?status=waitsend',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'TAKE_DELIVER_ORDER',
                                    'title' => '待收货订单',
                                    'parent' => '',
                                    'wap_url' => '/pages/order/list/list?status=waitconfirm',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'EVALUATE_ORDER',
                                    'title' => '待评价订单',
                                    'parent' => '',
                                    'wap_url' => '/pages/order/list/list?status=waitrate',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'REFUND_ORDER',
                                    'title' => '退款订单',
                                    'parent' => '',
                                    'wap_url' => '/pages/order/activist/activist',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'MEMBER_INFO',
                                    'title' => '个人资料',
                                    'parent' => '',
                                    'wap_url' => '/pages/member/info/info',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SHIPPING_ADDRESS',
                                    'title' => '收货地址',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/address/address',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'BALANCE',
                                    'title' => '我的余额',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/balance/balance',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'MEMBER_INTEGRAL',
                                    'title' => '我的积分',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/point/point',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'SIGN_IN',
                                    'title' => '签到',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/signin/signin',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'MEMBER_LEVEL',
                                    'title' => '会员等级',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/level/level',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'FOOTPRINT',
                                    'title' => '我的足迹',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/footprint/footprint',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'ATTENTION',
                                    'title' => '我的关注',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/collection/collection',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'ACCOUNT',
                                    'title' => '账户列表',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/account/account',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'COUPON',
                                    'title' => '优惠券',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/member/coupon/coupon',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                                [
                                    'name' => 'VERIFICATION_PLATFORM',
                                    'title' => '核销台',
                                    'parent' => '',
                                    'wap_url' => '/otherpages/verification/index/index',
                                    'web_url' => '',
                                    'sort' => 0
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'MIC_PAGE',
                    'title' => '微页面',
                    'parent' => '',
                    'wap_url' => '/pages/index/index/index',
                    'web_url' => '',
                    'sort' => 1,
                    'child_list' => []
                ],
                [
                    'name' => 'MARKETING_LINK',
                    'title' => '营销链接',
                    'parent' => '',
                    'wap_url' => '/pages/index/index/index',
                    'web_url' => '',
                    'sort' => 2,
                    'child_list' => []
                ],
                [
                    'name' => 'GOODS_CATEGORY',
                    'title' => '商品分类',
                    'parent' => '',
                    'wap_url' => '',
                    'web_url' => '',
                    'sort' => 3,
                    'child_list' => []
                ]
            ]
        ],
        [
            'name' => 'COMMODITY',
            'title' => '商品',
            'parent' => '',
            'wap_url' => '',
            'web_url' => '',
            'sort' => 2,
            'child_list' => [
                [
                    'name' => 'ALL_GOODS',
                    'title' => '全部商品',
                    'parent' => '',
                    'wap_url' => '',
                    'web_url' => '',
                    'child_list' => [],
                    'sort' => 1,
                ]
            ]
        ],
        [
            'name' => 'CUSTOM_LINK',
            'title' => '自定义链接',
            'parent' => '',
            'wap_url' => '',
            'web_url' => '',
            'sort' => 3,
            'child_list' => []
        ],
        [
            'name' => 'GAME',
            'title' => '小游戏',
            'parent' => '',
            'wap_url' => '',
            'web_url' => '',
            'sort' => 4,
            'child_list' => []
        ]
    ]
];