<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\web;

use app\model\BaseModel;
use app\model\system\Config as ConfigModel;
use app\model\web\WebSite as WebsiteModel;
use think\Exception;
use think\facade\Cache;

/**
 * 自定义模板
 */
class DiyView extends BaseModel
{
    /**
     * 系统页面，格式：端口，页面，关键词
     * @var array
     */
    private $page = [
        'shop' => [
            'port' => 'shop',
            'index' => [
                'name' => 'DIYVIEW_INDEX',
            ],
            'goods_category' => [
                'name' => 'DIYVIEW_GOODS_CATEGORY'
            ]
        ],
    ];

    /**
     * 获取系统页面
     * @return array
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * 获取自定义模板组件集合
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return array
     */
    public function getDiyViewUtilList($condition = [], $field = 'id,name,title,type,controller,value,addon_name,support_diy_view,max_count,is_delete,icon,icon_selected', $order = 'sort asc', $limit = null)
    {
        $res = model('diy_view_util')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($res);
    }

    /**
     * 获取自定义模板链接集合
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return array
     */
    public function getDiyLinkList($condition = [], $field = 'lk.id,lk.addon_name,nsa.title as addon_title,lk.name,lk.title,lk.web_url,lk.wap_url,lk.icon,nsa.icon as addon_icon', $order = 'nsa.id asc', $alias = 'lk', $join = [ [ 'addon nsa', 'lk.addon_name=nsa.name', 'left' ] ], $group = '', $limit = null)
    {
        $res = model('link')->getList($condition, $field, $order, $alias, $join, $group, $limit);
        return $this->success($res);
    }

    /**
     * 添加自定义模板
     * @param array $data
     */
    public function addSiteDiyView($data)
    {
        $res = model('site_diy_view')->add($data);
        if ($res) {
            Cache::tag("site_diy_view")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 添加自定义模板
     * @param array $data
     */
    public function addSiteDiyViewByTemplate($data)
    {
        $diy_view_info = model('site_diy_view')->getInfo([ [ 'site_id', '=', $data[ 'site_id' ] ], [ 'name', '=', $data[ 'name' ] ] ], 'id');
        if (empty($diy_view_info)) {
            $res = model('site_diy_view')->add($data);
            if ($res) {
                Cache::tag("site_diy_view")->clear();
                return $this->success($res);
            } else {
                return $this->error($res);
            }
        } else {
            try {
                model('site_diy_view')->startTrans();
                model('site_diy_view')->update([ 'name' => 'DIY_VIEW_RANDOM_' . time(), 'create_time' => time() ], [ [ 'name', '=', 'DIYVIEW_INDEX' ] ]);
                model('site_diy_view')->add($data);
                Cache::tag("site_diy_view")->clear();
                model('site_diy_view')->commit();
                return $this->success();
            } catch (\Exception $e) {
                model('site_diy_view')->rollback();
                return $this->error($e->getMessage());
            }
        }
    }

    /**
     * 添加多条自定义模板数据
     * @param $data
     * @return array
     */
    public function addSiteDiyViewList($data)
    {
        $res = model('site_diy_view')->addList($data);
        if ($res) {
            Cache::tag("site_diy_view")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 修改自定义模板
     * @param array $data
     * @param array $condition
     * @return array
     */
    public function editSiteDiyView($data, $condition)
    {
        $res = model('site_diy_view')->update($data, $condition);
        if ($res) {
            Cache::tag("site_diy_view")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 删除站点微页面
     * @param array $condition
     * @return array
     */
    public function deleteSiteDiyView($condition = [])
    {
        $res = model('site_diy_view')->delete($condition);
        if ($res) {
            Cache::tag("site_diy_view")->clear();
            return $this->success($res);
        } else {
            return $this->error($res);
        }
    }

    /**
     * 获取自定义模板分页数据集合
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getSiteDiyViewPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'sdv.*,ndva.addon_name as addon_name_temp')
    {
        $alias = "sdv";
        $join = [
            [
                'diy_view_temp ndva',
                'sdv.name=ndva.name',
                'left'
            ]
        ];

        $res = model('site_diy_view')->rawPageList($condition, $field, $order, $page, $page_size, $alias, $join);
        return $this->success($res);
    }

    /**
     * 获取自定义模板信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getSiteDiyViewInfo($condition = [], $field = 'id,site_id,name,title,value,type')
    {
        $data = json_encode($condition);
        $cache = Cache::get("site_diy_view_getSiteDiyViewInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $info = model('site_diy_view')->getInfo($condition, $field);

        Cache::tag("site_diy_view")->set("diy_view_getSiteDiyViewInfo_" . $data, $info);
        return $this->success($info);
    }

    /**
     * 获取自定义模板详细信息
     * @param array $condition
     * @return array
     */
    public function getSiteDiyViewDetail($condition = [])
    {
        $data = json_encode($condition);
        $cache = Cache::get("site_diy_view_getSiteDiyViewDetail_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $alias = 'sdv';
        $join = [
            [
                'diy_view_temp dvt',
                'sdv.name=dvt.name',
                'left'
            ]
        ];
        $field = 'sdv.id,sdv.site_id,sdv.name,sdv.title,sdv.value,sdv.type,dvt.addon_name';

        $info = model('site_diy_view')->getInfo($condition, $field, $alias, $join);

        Cache::tag("site_diy_view")->set("diy_view_getSiteDiyViewDetail_" . $data, $info);
        return $this->success($info);
    }

    /**
     * 组件分类
     * @param $type
     * @return mixed
     */
    public function getTypeName($type)
    {
        $arr = [
            'SYSTEM' => '基础组件', // 排序：10000~11000
            'ADDON' => '营销插件', // 排序：12000~13000
            'OTHER' => '其他插件', // 排序：14000~15000
        ];
        return $arr[ $type ];
    }

    /**
     * 获取平台端的底部导航配置
     * @param $site_id
     * @return array|array
     */
    public function getBottomNavConfig($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DIY_VIEW_SHOP_BOTTOM_NAV_CONFIG_SHOP_' . $site_id ] ]);
        return $res;
    }

    /**
     * 设置平台端的底部导航配置
     * @param $data
     * @param $site_id
     * @return array
     */
    public function setBottomNavConfig($data, $site_id)
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '店铺端自定义底部导航', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DIY_VIEW_SHOP_BOTTOM_NAV_CONFIG_SHOP_' . $site_id ] ]);
        return $res;
    }

    /**
     * 推广二维码
     * @param $condition
     * @param string $type
     * @return array
     */
    public function qrcode($condition, $type = "create")
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : 0;

        $diy_view_info = $this->getSiteDiyViewInfo($condition, 'site_id,name');
        $page = $this->getPage();
        $diy_view_info = $diy_view_info[ 'data' ];
        $data = [
            'app_type' => "all", // all为全部
            'type' => $type, // 类型 create创建 get获取
            'site_id' => $site_id,
            'data' => [
                "name" => $diy_view_info[ 'name' ]
            ],
            'page' => '/otherpages/diy/diy/diy',
            'qrcode_path' => 'upload/qrcode/diy',
            'qrcode_name' => "diy_qrcode_" . $diy_view_info[ 'name' ] . '_' . $site_id,
        ];

        // 网站主页
        if ($diy_view_info[ 'name' ] == $page[ 'shop' ][ 'index' ][ 'name' ]) {
            $data[ 'page' ] = '/pages/index/index/index';
        }

        event('Qrcode', $data, true);
        $app_type_list = config('app_type');

        $path = [];

        $config = new ConfigModel();

        foreach ($app_type_list as $k => $v) {
            switch ( $k ) {
                case 'h5':
                    $wap_domain = getH5Domain();
                    $path[ $k ][ 'status' ] = 1;
                    if ($diy_view_info[ 'name' ] == $page[ 'shop' ][ 'index' ]) {
                        // 网站主页
                        $path[ $k ][ 'url' ] = $wap_domain . $data[ 'page' ];
                    } else {
                        //自定义
                        $path[ $k ][ 'url' ] = $wap_domain . $data[ 'page' ] . '?name=' . $diy_view_info[ 'name' ];
                    }
                    $path[ $k ][ 'img' ] = "upload/qrcode/diy/diy_qrcode_" . $diy_view_info[ 'name' ] . '_' . $site_id . "_" . $k . ".png";
                    break;
                case 'weapp' :
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WEAPP_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信小程序';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }

                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信小程序';
                    }
                    break;

                case 'wechat' :
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WECHAT_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信公众号';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }
                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信公众号';
                    }
                    break;
            }

        }

        $return = [
            'path' => $path
        ];

        return $this->success($return);
    }

    /**
     * 获取列表
     */
    public function getTemplate()
    {
        $dirs = array_map('basename', glob('public/diy_view/*', GLOB_ONLYDIR));
        $list = [];
        foreach ($dirs as $key => $value) {
            $config_json = file_get_contents('public/diy_view/' . $value . '/config.json');
            $list[] = json_decode($config_json, true);

        }
        return $this->success($list);
    }

    /**
     * 设置为系统页面
     * @param $port
     * @param $type
     * @param $id
     * @param $site_id
     * @return array
     */
    public function setPage($port, $type, $id, $site_id)
    {
        model('site_diy_view')->startTrans();
        try {
            $name = $this->page[ $port ][ $type ][ 'name' ];
            model('site_diy_view')->update([ 'name' => 'DIY_VIEW_RANDOM_' . time(), 'create_time' => time() ], [ [ 'name', '=', $name ], [ 'site_id', '=', $site_id ] ]);
            model('site_diy_view')->update([ 'name' => $name ], [ [ 'id', '=', $id ], [ 'site_id', '=', $site_id ] ]);
            Cache::tag("site_diy_view")->clear();
            model('site_diy_view')->commit();
            return $this->success();
        } catch (\Exception $e) {
            model('site_diy_view')->rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * 获取自定义会员中心配置
     * @param $site_id
     * @return array|array
     */
    public function getMemberIndexDiyConfig($site_id)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DIY_MEMBER_INDEX_CONFIG_SHOP_' . $site_id ] ]);

        $membersignin_addon_is_exit = addon_is_exit('membersignin', $site_id);// 签到插件
        $memberwithdraw_addon_is_exit = addon_is_exit('memberwithdraw', $site_id);// 会员提现插件
        $coupon_addon_is_exit = addon_is_exit('coupon', $site_id);// 优惠券插件
        $pintuan_addon_is_exit = addon_is_exit('pintuan', $site_id);// 拼团插件
        $pointexchange_addon_is_exit = addon_is_exit('pointexchange', $site_id);// 积分兑换插件
        $fenxiao_addon_is_exit = addon_is_exit('fenxiao', $site_id);// 分销插件
        $bargain_addon_is_exit = addon_is_exit('bargain', $site_id);// 砍价插件

        if (empty($res[ 'data' ][ 'value' ])) {
            $menuList = [];
            if ($membersignin_addon_is_exit) {
                $menuList[] =
                    [
                        'tag' => 'membersignin',
                        "text" => "签到",
                        "img" => "upload/uniapp/member/index/menu/default_sign.png",
                        "link" => [
                            "name" => "SIGN_IN",
                            "title" => "签到",
                            "wap_url" => "/otherpages/member/signin/signin"
                        ],
                        "isShow" => "1",
                        "isSystem" => "1"
                    ];
            }

            $menuList[] = [
                "text" => "个人资料",
                "img" => "upload/uniapp/member/index/menu/default_person.png",
                "link" => [
                    "name" => "MEMBER_INFO",
                    "title" => "个人资料",
                    "wap_url" => "/pages/member/info/info"
                ],
                "isShow" => "1",
                "isSystem" => "1"
            ];
            $menuList[] = [
                "text" => "收货地址",
                "img" => "upload/uniapp/member/index/menu/default_address.png",
                "link" => [
                    "name" => "SHIPPING_ADDRESS",
                    "title" => "收货地址",
                    "wap_url" => "/otherpages/member/address/address"
                ],
                "isShow" => "1",
                "isSystem" => "1"
            ];

            if ($memberwithdraw_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'memberwithdraw',
                    "text" => "账户列表",
                    "img" => "upload/uniapp/member/index/menu/default_cash.png",
                    "link" => [
                        "name" => "ACCOUNT",
                        "title" => "账户列表",
                        "wap_url" => "/otherpages/member/account/account"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($coupon_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'coupon',
                    "text" => "优惠券",
                    "img" => "upload/uniapp/member/index/menu/default_discount.png",
                    "link" => [
                        "name" => "COUPON",
                        "title" => "优惠券",
                        "wap_url" => "/otherpages/member/coupon/coupon"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($pintuan_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'pintuan',
                    "text" => "我的拼单",
                    "img" => "upload/uniapp/member/index/menu/default_store.png",
                    "link" => [
                        "name" => "MY_PINTUAN",
                        "title" => "我的拼团",
                        "wap_url" => "/promotionpages/pintuan/my_spell/my_spell"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            $menuList[] = [
                "text" => "我的关注",
                "img" => "upload/uniapp/member/index/menu/default_like.png",
                "link" => [
                    "name" => "ATTENTION",
                    "title" => "我的关注",
                    "wap_url" => "/otherpages/member/collection/collection"
                ],
                "isShow" => "1",
                "isSystem" => "1"
            ];
            $menuList[] = [
                "text" => "我的足迹",
                "img" => "upload/uniapp/member/index/menu/default_toot.png",
                "link" => [
                    "name" => "FOOTPRINT",
                    "title" => "我的足迹",
                    "wap_url" => "/otherpages/member/footprint/footprint"
                ],
                "isShow" => "1",
                "isSystem" => "1"
            ];

            if ($pointexchange_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'pointexchange',
                    "text" => "积分兑换",
                    "img" => "upload/uniapp/member/index/menu/default_point_recond.png",
                    "link" => [
                        "name" => "INTEGRAL_CONVERSION",
                        "title" => "积分兑换",
                        "wap_url" => "/promotionpages/point/order_list/order_list"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            $menuList[] = [
                'tag' => 'verifier',
                "text" => "核销台",
                "img" => "upload/uniapp/member/index/menu/default_verification.png",
                "link" => [
                    "name" => "VERIFICATION_PLATFORM",
                    "title" => "核销台",
                    "wap_url" => "/otherpages/verification/index/index"
                ],
                "isShow" => "1",
                "isSystem" => "1",
                "remark" => "成为核销员时显示"
            ];

            if ($fenxiao_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'fenxiao',
                    "text" => "分销中心",
                    "img" => "upload/uniapp/member/index/menu/default_fenxiao.png",
                    "link" => [
                        "name" => "DISTRIBUTION_CENTRE",
                        "title" => "分销中心",
                        "wap_url" => "/otherpages/fenxiao/index/index"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($bargain_addon_is_exit) {
                $menuList[] = [
                    'tag' => 'bargain',
                    "text" => "我的砍价",
                    "img" => "upload/uniapp/member/index/menu/default_bargain.png",
                    "link" => [
                        "name" => "MY_BARGAIN",
                        "title" => "我的砍价",
                        "wap_url" => "/promotionpages/bargain/my_bargain/my_bargain"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            $res[ 'data' ][ 'value' ] = [
                "textColor" => "#ffffff",
                "bgImg" => "upload/uniapp/member/index/member_bg.png",
                "bgColor" => "#ff454f",
                "topStyle" => "default",
                "menuStyle" => "palace",
                "insertGap" => "0",
                "menuList" => $menuList
            ];
        } else {

            $menuList = $res[ 'data' ][ 'value' ][ 'menuList' ];

            $membersignin_key = array_search('membersignin', array_column($menuList, 'tag'));
            $memberwithdraw_key = array_search('memberwithdraw', array_column($menuList, 'tag'));
            $coupon_key = array_search('coupon', array_column($menuList, 'tag'));
            $pintuan_key = array_search('pintuan', array_column($menuList, 'tag'));
            $pointexchange_key = array_search('pointexchange', array_column($menuList, 'tag'));
            $fenxiao_key = array_search('fenxiao', array_column($menuList, 'tag'));
            $bargain_key = array_search('bargain', array_column($menuList, 'tag'));

            if ($membersignin_key !== false && $membersignin_addon_is_exit == 0) {
                // 插件卸载后，移除【签到】菜单
                array_splice($menuList, $membersignin_key, 1);
            } elseif ($membersignin_key === false && $membersignin_addon_is_exit == 1) {
                // 插件安装后，如果没有【签到】菜单，则添加
                $menuList[] =
                    [
                        'tag' => 'membersignin',
                        "text" => "签到",
                        "img" => "upload/uniapp/member/index/menu/default_sign.png",
                        "link" => [
                            "name" => "SIGN_IN",
                            "title" => "签到",
                            "wap_url" => "/otherpages/member/signin/signin"
                        ],
                        "isShow" => "1",
                        "isSystem" => "1"
                    ];
            }

            if ($memberwithdraw_key !== false && $memberwithdraw_addon_is_exit == 0) {
                // 插件卸载后，移除【账户列表】菜单
                array_splice($menuList, $memberwithdraw_key, 1);
            } elseif ($memberwithdraw_key === false && $memberwithdraw_addon_is_exit == 1) {
                // 插件安装后，如果没有【账户列表】菜单，则添加
                $menuList[] = [
                    'tag' => 'memberwithdraw',
                    "text" => "账户列表",
                    "img" => "upload/uniapp/member/index/menu/default_cash.png",
                    "link" => [
                        "name" => "ACCOUNT",
                        "title" => "账户列表",
                        "wap_url" => "/otherpages/member/account/account"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($coupon_key !== false && $coupon_addon_is_exit == 0) {
                // 插件卸载后，移除【优惠券】菜单
                array_splice($menuList, $coupon_key, 1);
            } elseif ($coupon_key === false && $coupon_addon_is_exit == 1) {
                // 插件安装后，如果没有【优惠券】菜单，则添加
                $menuList[] = [
                    'tag' => 'coupon',
                    "text" => "优惠券",
                    "img" => "upload/uniapp/member/index/menu/default_discount.png",
                    "link" => [
                        "name" => "COUPON",
                        "title" => "优惠券",
                        "wap_url" => "/otherpages/member/coupon/coupon"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($pintuan_key !== false && $pintuan_addon_is_exit == 0) {
                // 插件卸载后，移除【我的拼单】菜单
                array_splice($menuList, $pintuan_key, 1);
            } elseif ($pintuan_key === false && $pintuan_addon_is_exit == 1) {
                // 插件安装后，如果没有【我的拼单】菜单，则添加
                $menuList[] = [
                    'tag' => 'pintuan',
                    "text" => "我的拼单",
                    "img" => "upload/uniapp/member/index/menu/default_store.png",
                    "link" => [
                        "name" => "MY_PINTUAN",
                        "title" => "我的拼团",
                        "wap_url" => "/promotionpages/pintuan/my_spell/my_spell"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($pointexchange_key !== false && $pointexchange_addon_is_exit == 0) {
                // 插件卸载后，移除【积分兑换】菜单
                array_splice($menuList, $pointexchange_key, 1);
            } elseif ($pointexchange_key === false && $pointexchange_addon_is_exit == 1) {
                // 插件安装后，如果没有【积分兑换】菜单，则添加
                $menuList[] = [
                    'tag' => 'pointexchange',
                    "text" => "积分兑换",
                    "img" => "upload/uniapp/member/index/menu/default_point_recond.png",
                    "link" => [
                        "name" => "INTEGRAL_CONVERSION",
                        "title" => "积分兑换",
                        "wap_url" => "/promotionpages/point/order_list/order_list"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($fenxiao_key !== false && $fenxiao_addon_is_exit == 0) {
                // 插件卸载后，移除【分销中心】菜单
                array_splice($menuList, $fenxiao_key, 1);
            } elseif ($fenxiao_key === false && $fenxiao_addon_is_exit == 1) {
                // 插件安装后，如果没有【分销中心】菜单，则添加
                $menuList[] = [
                    'tag' => 'fenxiao',
                    "text" => "分销中心",
                    "img" => "upload/uniapp/member/index/menu/default_fenxiao.png",
                    "link" => [
                        "name" => "DISTRIBUTION_CENTRE",
                        "title" => "分销中心",
                        "wap_url" => "/otherpages/fenxiao/index/index"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            if ($bargain_key !== false && $bargain_addon_is_exit == 0) {
                // 插件卸载后，移除【我的砍价】菜单
                array_splice($menuList, $bargain_key, 1);
            } elseif ($bargain_key === false && $bargain_addon_is_exit == 1) {
                // 插件安装后，如果没有【我的砍价】菜单，则添加
                $menuList[] = [
                    'tag' => 'bargain',
                    "text" => "我的砍价",
                    "img" => "upload/uniapp/member/index/menu/default_bargain.png",
                    "link" => [
                        "name" => "MY_BARGAIN",
                        "title" => "我的砍价",
                        "wap_url" => "/promotionpages/bargain/my_bargain/my_bargain"
                    ],
                    "isShow" => "1",
                    "isSystem" => "1"
                ];
            }

            $res[ 'data' ][ 'value' ][ 'menuList' ] = $menuList;
        }

        return $res;
    }

    /**
     * 设置自定义会员中心配置
     * @param $data
     * @param $site_id
     * @return array
     */
    public function setMemberIndexDiyConfig($data, $site_id)
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '自定义会员中心', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'DIY_MEMBER_INDEX_CONFIG_SHOP_' . $site_id ] ]);
        return $res;
    }

    /**
     * 修改微页面排序
     * @param int $sort
     * @param int $label_id
     */
    public function modifyDiyViewSort($sort, $id)
    {
        $res = model('site_diy_view')->update([ 'sort' => $sort ], [ [ 'id', '=', $id ] ]);
        Cache::tag("site_diy_view")->clear();
        return $this->success($res);
    }

    /**
     * 修改微页面点击量
     * @param $sku_id
     * @param $site_id
     */
    public function modifyClick($condition, $site_id)
    {
        model("site_diy_view")->setInc($condition, 'click_num', 1);
        return $this->success(1);
    }
}