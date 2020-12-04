<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\web\DiyView as DiyViewModel;


/**
 * 增加默认自定义数据：网站主页、商品分类、底部导航
 */
class AddSiteDiyView
{

    public function handle($param)
    {
        if (!empty($param[ 'site_id' ])) {

            $diy_view_model = new DiyViewModel();

            // 添加自定义主页装修
            $value = json_encode([
                "global" => [
                    "title" => "网站主页",
                    "openBottomNav" => true,
                    "bgColor" => "#f8f8f8",
                    "bgUrl" => "",
                    "moreLink" => [],
                    "mpCollect" => false,
                    "navStyle" => 1,
                    "popWindow" => [
                        "imageUrl" => "",
                        "count" => -1,
                        "link" => [
                            "name" => ""
                        ],
                        "imgWidth" => "",
                        "imgHeight" => ""
                    ],
                    "textImgPosLink" => "left",
                    "textImgStyleLink" => "1",
                    "textNavColor" => "#303133",
                    "topNavColor" => "#ffffff",
                    "topNavImg" => "",
                    "topNavbg" => false
                ],
                "value" => [
                    [
                        "style" => "3",
                        "styleName" => "风格三",
                        "backgroundColor" => "",
                        "textColor" => "#303133",
                        "defaultTextColor" => "#333333",
                        "addon_name" => "store",
                        "type" => "STORE_CHANGE",
                        "name" => "门店展示",
                        "controller" => "StoreShow",
                        "is_delete" => "0"
                    ],
                    [
                        "selectedTemplate" => "carousel-posters",
                        "imageClearance" => 0,
                        "imageRadius" => "fillet",
                        "carouselChangeStyle" => "circle",
                        "marginTop" => 0,
                        "padding" => 0,
                        "height" => 0,
                        "list" => [
                            [
                                "imageUrl" => "public/diy_view/style2/img/posters_1.png",
                                "title" => "",
                                "link" => [],
                                "imgWidth" => "750",
                                "imgHeight" => "350"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/posters_2.png",
                                "title" => "",
                                "link" => [],
                                "imgWidth" => "750",
                                "imgHeight" => "350"
                            ]
                        ],
                        "addon_name" => "",
                        "type" => "IMAGE_ADS",
                        "name" => "图片广告",
                        "controller" => "ImageAds",
                        "is_delete" => "0"
                    ],
                    [
                        "textColor" => "#303133",
                        "defaultTextColor" => "#666666",
                        "backgroundColor" => "#ffffff",
                        "selectedTemplate" => "imageNavigation",
                        "showType" => 5,
                        "scrollSetting" => "fixed",
                        "padding" => 20,
                        "marginTop" => 10,
                        "list" => [
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon1.png",
                                "title" => "拼团",
                                "link" => [
                                    "id" => 11539,
                                    "addon_name" => "pintuan",
                                    "name" => "PINTUAN_PREFECTURE",
                                    "title" => "拼团专区",
                                    "parent" => "PINTUAN",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/pintuan/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon2.png",
                                "title" => "团购",
                                "link" => [
                                    "id" => 11536,
                                    "addon_name" => "groupbuy",
                                    "name" => "GROUPBUY_PREFECTURE",
                                    "title" => "团购专区",
                                    "parent" => "GROUPBUY",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/groupbuy/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon3.png",
                                "title" => "秒杀",
                                "link" => [
                                    "id" => 11543,
                                    "addon_name" => "seckill",
                                    "name" => "SECKILL_PREFECTURE",
                                    "title" => "秒杀专区",
                                    "parent" => "SECKILL",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/seckill/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon4.png",
                                "title" => "积分商城",
                                "link" => [
                                    "id" => 3541,
                                    "addon_name" => "pointexchange",
                                    "name" => "INTEGRAL_STORE",
                                    "title" => "积分商城",
                                    "parent" => "INTEGRAL",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/point/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon5.png",
                                "title" => "专题活动",
                                "link" => [
                                    "id" => 3532,
                                    "addon_name" => "topic",
                                    "name" => "THEMATIC_ACTIVITIES_LIST",
                                    "title" => "专题活动列表",
                                    "parent" => "THEMATIC_ACTIVITIES",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/topics/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon6.png",
                                "title" => "砍价",
                                "link" => [
                                    "id" => 11532,
                                    "addon_name" => "bargain",
                                    "name" => "BARGAIN_PREFECTURE",
                                    "title" => "砍价专区",
                                    "parent" => "BARGAIN",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/promotionpages/bargain/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon7.png",
                                "title" => "直播",
                                "link" => [
                                    "id" => 11556,
                                    "addon_name" => "live",
                                    "name" => "LIVE_LIST",
                                    "title" => "直播",
                                    "parent" => "LIVE",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/otherpages/live/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon8.png",
                                "title" => "领券",
                                "link" => [
                                    "id" => 11545,
                                    "addon_name" => "coupon",
                                    "name" => "COUPON_PREFECTURE",
                                    "title" => "优惠券专区",
                                    "parent" => "COUPON_LIST",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/otherpages/goods/coupon/coupon",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "parents" => "MARKETING_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon9.png",
                                "title" => "公告",
                                "link" => [
                                    "id" => 11504,
                                    "addon_name" => "",
                                    "name" => "SHOPPING_NOTICE",
                                    "title" => "公告",
                                    "parent" => "BASICS_LINK",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/otherpages/notice/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "selected" => false,
                                    "parents" => "MALL_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/icon10.png",
                                "title" => "帮助",
                                "link" => [
                                    "id" => 11505,
                                    "addon_name" => "",
                                    "name" => "SHOPPING_HELP",
                                    "title" => "帮助",
                                    "parent" => "BASICS_LINK",
                                    "sort" => 0,
                                    "level" => 4,
                                    "web_url" => "",
                                    "wap_url" => "/otherpages/help/list/list",
                                    "icon" => "",
                                    "support_diy_view" => "",
                                    "selected" => false,
                                    "parents" => "MALL_LINK"
                                ],
                                "imgWidth" => "70",
                                "imgHeight" => "70"
                            ]
                        ],
                        "addon_name" => "",
                        "type" => "GRAPHIC_NAV",
                        "name" => "图文导航",
                        "navRadius" => "fillet",
                        "controller" => "GraphicNav",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "backgroundColor" => "#ffffff",
                        "marginTop" => 10,
                        "style" => 1,
                        "isEdit" => 1,
                        "styleName" => "风格一",
                        "textColor" => "#606266",
                        "defaultTextColor" => "#333333",
                        "fontSize" => 14,
                        "list" => [
                            [
                                "title" => "单商户V4.0.4更新啦！",
                                "link" => []
                            ]
                        ],
                        "noticeIds" => [],
                        "addon_name" => "",
                        "type" => "NOTICE",
                        "name" => "公告",
                        "controller" => "Notice",
                        "is_delete" => "0"
                    ],
                    [
                        "marginTop" => 10,
                        "isShowAnchorInfo" => "1",
                        "isShowLiveGood" => "1",
                        "addon_name" => "live",
                        "type" => "WEAPP_LIVE",
                        "name" => "小程序直播",
                        "controller" => "LiveInfo",
                        "is_delete" => "0"
                    ],
                    [
                        "height" => 10,
                        "backgroundColor" => "",
                        "marginLeftRight" => 0,
                        "addon_name" => "",
                        "type" => "HORZ_BLANK",
                        "name" => "辅助空白",
                        "controller" => "HorzBlank",
                        "is_delete" => "0"
                    ],
                    [
                        "selectedTemplate" => "row1-lt-of2-rt",
                        "backgroundColor" => "",
                        "list" => [
                            [
                                "imageUrl" => "public/diy_view/style2/img/adv1.png",
                                "link" => []
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/adv2.png",
                                "link" => []
                            ],
                            [
                                "imageUrl" => "public/diy_view/style2/img/adv3.png",
                                "link" => []
                            ]
                        ],
                        "selectedRubikCubeArray" => [],
                        "diyHtml" => "",
                        "customRubikCube" => 4,
                        "heightArray" => [
                            "74.25px",
                            "59px",
                            "48.83px",
                            "41.56px"
                        ],
                        "imageGap" => 10,
                        "addon_name" => "",
                        "type" => "RUBIK_CUBE",
                        "name" => "魔方",
                        "controller" => "RubikCube",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "style" => 1,
                        "couponCount" => "6",
                        "styleName" => "风格一",
                        "backgroundColor" => "",
                        "marginTop" => 10,
                        "status" => 1,
                        "couponIds" => [],
                        "addon_name" => "coupon",
                        "type" => "COUPON",
                        "name" => "优惠券",
                        "controller" => "Coupon",
                        "is_delete" => "0"
                    ],
                    [
                        "style" => 1,
                        "backgroundColor" => "",
                        "marginTop" => 10,
                        "styleName" => "风格一",
                        "bgSelect" => "red",
                        "changeType" => 1,
                        "paddingLeftRight" => 0,
                        "isShowGoodsName" => 1,
                        "isShowGoodsDesc" => 0,
                        "isShowGoodsPrice" => 1,
                        "isShowGoodsPrimary" => 1,
                        "isShowGoodsStock" => 0,
                        "list" => [
                            "imageUrl" => "public/diy_view/style2/img/title1.png",
                            "title" => "秒杀专区"
                        ],
                        "listMore" => [
                            "imageUrl" => "",
                            "title" => "更多秒杀"
                        ],
                        "titleTextColor" => "#000",
                        "defaultTitleTextColor" => "#000",
                        "moreTextColor" => "#858585",
                        "defaultMoreTextColor" => "#858585",
                        "addon_name" => "seckill",
                        "type" => "SECKILL_LIST",
                        "name" => "秒杀",
                        "controller" => "Seckill",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "categoryId" => 0,
                        "goodsCount" => "6",
                        "goodsId" => [],
                        "style" => 1,
                        "styleName" => "风格一",
                        "changeType" => 1,
                        "backgroundColor" => "",
                        "bgSelect" => "blue",
                        "marginTop" => 10,
                        "list" => [
                            "imageUrl" => "public/diy_view/style2/img/title2.png",
                            "title" => "爱拼才会赢"
                        ],
                        "listMore" => [
                            "imageUrl" => "",
                            "title" => "好友都在拼"
                        ],
                        "titleTextColor" => "#000",
                        "defaultTitleTextColor" => "#000",
                        "moreTextColor" => "#858585",
                        "defaultMoreTextColor" => "#858585",
                        "addon_name" => "pintuan",
                        "type" => "PINTUAN_LIST",
                        "name" => "拼团",
                        "controller" => "Pintuan",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "categoryId" => 0,
                        "goodsCount" => "6",
                        "goodsId" => [],
                        "style" => 1,
                        "styleName" => "风格一",
                        "changeType" => 1,
                        "backgroundColor" => "",
                        "bgSelect" => "yellow",
                        "marginTop" => 10,
                        "list" => [
                            "imageUrl" => "public/diy_view/style2/img/title3.png",
                            "title" => "一起团才更实惠"
                        ],
                        "listMore" => [
                            "imageUrl" => "",
                            "title" => "查看更多"
                        ],
                        "titleTextColor" => "#000",
                        "defaultTitleTextColor" => "#000",
                        "moreTextColor" => "#858585",
                        "defaultMoreTextColor" => "#858585",
                        "addon_name" => "groupbuy",
                        "type" => "GROUPBUY_LIST",
                        "name" => "团购",
                        "controller" => "Groupbuy",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "categoryId" => 0,
                        "goodsCount" => "6",
                        "styleName" => "风格一",
                        "goodsId" => [],
                        "style" => 1,
                        "changeType" => 1,
                        "backgroundColor" => "",
                        "bgSelect" => "violet",
                        "marginTop" => 10,
                        "list" => [
                            "imageUrl" => "public/diy_view/style2/img/title4.png",
                            "title" => "低价一目了然"
                        ],
                        "listMore" => [
                            "imageUrl" => "",
                            "title" => "更多"
                        ],
                        "titleTextColor" => "#000",
                        "defaultTitleTextColor" => "#000",
                        "moreTextColor" => "#858585",
                        "defaultMoreTextColor" => "#858585",
                        "addon_name" => "bargain",
                        "type" => "BARGAIN_LIST",
                        "name" => "砍价",
                        "controller" => "Bargain",
                        "is_delete" => "0"
                    ],
                    [
                        "selectedTemplate" => "single-graph",
                        "imageClearance" => 0,
                        "imageRadius" => "right-angle",
                        "carouselChangeStyle" => "circle",
                        "marginTop" => 25,
                        "padding" => 0,
                        "height" => 0,
                        "list" => [
                            [
                                "imageUrl" => "public/diy_view/style2/img/title.png",
                                "title" => "",
                                "link" => [],
                                "imgWidth" => "690",
                                "imgHeight" => "65"
                            ]
                        ],
                        "addon_name" => "",
                        "type" => "IMAGE_ADS",
                        "name" => "图片广告",
                        "controller" => "ImageAds",
                        "is_delete" => "0"
                    ],
                    [
                        "sources" => "default",
                        "categoryId" => 0,
                        "categoryName" => "请选择",
                        "goodsCount" => "6",
                        "goodsId" => [],
                        "style" => "2",
                        "backgroundColor" => "",
                        "marginTop" => 10,
                        "paddingLeftRight" => 0,
                        "isShowCart" => 0,
                        "cartStyle" => 1,
                        "isShowGoodName" => 1,
                        "isShowMarketPrice" => 1,
                        "isShowGoodSaleNum" => 1,
                        "isShowGoodSubTitle" => 0,
                        "goodsTag" => "default",
                        "tagImg" => [
                            "imageUrl" => ""
                        ],
                        "addon_name" => "",
                        "type" => "GOODS_LIST",
                        "name" => "商品列表",
                        "controller" => "GoodsList",
                        "is_delete" => "0"
                    ]
                ]
            ]);

            // 网站主页
            $data = [
                [
                    'site_id' => $param[ 'site_id' ],
                    'title' => '网站主页',
                    'name' => 'DIYVIEW_INDEX',
                    'type' => 'shop',
                    'value' => $value
                ],
                [
                    'site_id' => $param[ 'site_id' ],
                    'title' => '商品分类',
                    'name' => "DIYVIEW_GOODS_CATEGORY",
                    'type' => "shop",
                    'value' => json_encode([
                        "global" => [
                            "title" => "商品分类",
                            "openBottomNav" => false,
                            "bgColor" => "#ffffff",
                            "bgUrl" => ""
                        ],
                        "value" => [
                            [
                                "addon_name" => "",
                                "type" => "GOODS_CATEGORY",
                                "name" => "商品分类",
                                "controller" => "GoodsCategory",
                                "level" => 3,
                                "template" => 2
                            ]
                        ]
                    ])
                ]
            ];

            $res = $diy_view_model->addSiteDiyViewList($data);

            $diy_view_bottom_nav = [
                "type" => 1,
                "backgroundColor" => "#ffffff",
                "textColor" => "#000000",
                "textHoverColor" => "#fa0036",
                "bulge" => true,
                "list" => [
                    [
                        "iconPath" => "upload/default/diy_view/bottom/index.png",
                        "selectedIconPath" => "upload/default/diy_view/bottom/index_selected.png",
                        "text" => "首页",
                        "link" => [
                            "addon_name" => "",
                            "addon_title" => null,
                            "name" => "INDEX",
                            "title" => "主页",
                            "web_url" => "",
                            "wap_url" => "/pages/index/index/index",
                            "icon" => "",
                            "addon_icon" => null,
                            "selected" => false,
                            "type" => 0
                        ]
                    ],
                    [
                        "iconPath" => "upload/default/diy_view/bottom/category.png",
                        "selectedIconPath" => "upload/default/diy_view/bottom/category_selected.png",
                        "text" => "分类",
                        "link" => [
                            "addon_name" => "",
                            "addon_title" => null,
                            "name" => "GOODS_CATEGORY",
                            "title" => "商品分类",
                            "web_url" => "",
                            "wap_url" => "/pages/goods/category/category",
                            "icon" => "",
                            "addon_icon" => null,
                            "selected" => false
                        ]
                    ],
                    [ "iconPath" => "upload/default/diy_view/bottom/cart.png",
                        "selectedIconPath" => "upload/default/diy_view/bottom/cart_selected.png",
                        "text" => "购物车",
                        "link" => [
                            "addon_name" => "",
                            "addon_title" => null,
                            "name" => "GOODS_CART",
                            "title" => "购物车",
                            "web_url" => "",
                            "wap_url" => "/pages/goods/cart/cart",
                            "icon" => "",
                            "addon_icon" => null,
                            "selected" => false
                        ],
                    ],
                    [ "iconPath" => "upload/default/diy_view/bottom/member_index.png",
                        "selectedIconPath" => "upload/default/diy_view/bottom/member_index_selected.png",
                        "text" => "我的",
                        "link" => [
                            "addon_name" => "",
                            "addon_title" => null,
                            "name" => "MEMBER_INDEX",
                            "title" => "会员中心",
                            "web_url" => "",
                            "wap_url" => "/pages/member/index/index",
                            "icon" => "",
                            "addon_icon" => null,
                            "selected" => false
                        ]
                    ]
                ]

            ];

            //底部导航
            $result = $diy_view_model->setBottomNavConfig(json_encode($diy_view_bottom_nav), $param[ 'site_id' ]);

            return $res;

        }

    }

}