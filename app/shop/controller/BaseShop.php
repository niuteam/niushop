<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\Controller;
use app\model\system\Addon;
use app\model\system\Group as GroupModel;
use app\model\system\Menu;
use app\model\system\User as UserModel;
use app\model\web\Config as ConfigModel;
use app\model\web\WebSite;
use app\model\system\Site;
use addon\weapp\model\Config as WeappConfigModel;

class BaseShop extends Controller
{
    protected $init_menu = [];
    protected $crumbs = [];
    protected $crumbs_array = [];

    protected $uid;
    protected $user_info;
    protected $url;
    protected $group_info;
    protected $menus;
    protected $site_id;
    protected $shop_info;
    protected $app_module = "shop";
    protected $addon = '';

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
        //检测基础登录
        $this->site_id = request()->siteid();
        $user_model = new UserModel();
        $this->uid = $user_model->uid($this->app_module, $this->site_id);
        if (empty($this->uid)) {
            $this->redirect(url("shop/login/login"));
        }
        $this->assign("shop_module", SHOP_MODULE);
        $this->url = request()->parseUrl();
        $this->addon = request()->addon() ? request()->addon() : '';
        $this->user_info = $user_model->userInfo($this->app_module, $this->site_id);
        $this->assign("user_info", $this->user_info);
        $this->checkLogin();
        //检测用户组
        $this->getGroupInfo();
        if (!$this->checkAuth()) {
            if (!request()->isAjax()) {
                $menu_info = $user_model->getRedirectUrl($this->url, $this->app_module, $this->group_info, $this->addon);
                if (empty($menu_info)) {
                    $this->error('权限不足');
                } else {
                    $this->redirect(addon_url($menu_info[ 'url' ]));
                }
            } else {
                echo json_encode(error(-1, '权限不足'));
                exit;
            }

        }
        //获取店铺信息
        $site_model = new Site();
        $shop_info = $site_model->getSiteInfo([ [ 'site_id', '=', $this->site_id ] ], 'site_name,logo,seo_keywords,seo_description, create_time');
        $this->shop_info = $shop_info[ 'data' ];

        $this->assign("shop_info", $shop_info[ 'data' ]);
        if (!request()->isAjax()) {
            //获取菜单
            $this->menus = $this->getMenuList();
            $this->initBaseInfo();
        }
    }

    /**
     * 加载基础信息
     */
    private function initBaseInfo()
    {
        //获取一级权限菜单
        $this->getTopMenu();
        $menu_model = new Menu();
        $info_result = $menu_model->getMenuInfoByUrl($this->url, $this->app_module, $this->addon);
        $info = [];
        if (!empty($info_result[ "data" ])) {
            $info = $info_result[ "data" ];
            $this->getParentMenuList($info[ 'name' ]);
        } elseif ($this->url == '/Index/index') {
            $info_result = $menu_model->getMenuInfoByUrl($this->app_module . $this->url, $this->app_module, $this->addon);
            if (!empty($info_result[ "data" ])) {
                $info = $info_result["data"];
                $this->getParentMenuList($info['name']);
            }
        }
        $this->assign("menu_info", $info);
        //加载菜单树
        $init_menu = $this->initMenu($this->menus, '');

        // 应用下的菜单特殊处理
        if (!empty($this->crumbs) && $this->crumbs[ 0 ][ 'name' ] == 'PROMOTION_ROOT') {

            //如果当前选择了【应用管理】，则只保留【应用管理】菜单
            if ($this->crumbs[ 1 ][ 'name' ] == 'PROMOTION_TOOL') {
                foreach ($init_menu as $k => $v) {
                    if ($v[ 'selected' ]) {
                        $init_menu[ $k ][ 'child_list' ] = [ $v[ 'child_list' ][ 'PROMOTION_CENTER' ], $v[ 'child_list' ][ 'PROMOTION_MEMBER' ], $v[ 'child_list' ][ 'PROMOTION_TOOL' ] ];
                        break;
                    }
                }
            } else {
                //选择了应用下的某个插件，则移除【应用管理】菜单，显示该插件下的菜单，并且标题名称改为插件名称
                $addon_model = new Addon();
                $addon_info = $addon_model->getAddonInfo([ [ 'name', '=', request()->addon() ] ], 'name,title');
                $addon_info = $addon_info[ 'data' ] ?? [ 'name' => '', 'title' => '' ];
                $promotion_menu_arr = [ 'PROMOTION_CENTER', 'PROMOTION_MEMBER', 'PROMOTION_TOOL' ];
                foreach ($init_menu as $k => $v) {
                    if ($v[ 'selected' ]) {
                        $this->crumbs[ 0 ][ 'title' ] = $addon_info[ 'title' ];
//                        unset($init_menu[ $k ][ 'child_list' ][ 'PROMOTION_TOOL' ]);
                        foreach ($init_menu[ $k ][ 'child_list' ] as $ck => $cv) {
                            if ($cv[ 'addon' ] != $addon_info[ 'name' ]) {
                                if (isset($this->crumbs[ 2 ]) && ( $this->crumbs[ 2 ][ 'parent' ] == 'PROMOTION_CENTER' || $this->crumbs[ 2 ][ 'parent' ] == 'PROMOTION_MEMBER' )) {
                                    if (!in_array($ck, $promotion_menu_arr)) {
                                        unset($init_menu[ $k ][ 'child_list' ][ $ck ]);
                                    }
                                } else {
                                    unset($init_menu[ $k ][ 'child_list' ][ $ck ]);
                                }
                            }
                        }
                        break;
                    }
                }
            }
        }
        $this->assign("url", $this->url);
        $this->assign("menu", $init_menu);
        $this->assign("crumbs", $this->crumbs);
        //加载版权信息
        $config_model = new ConfigModel();
        $copyright = $config_model->getCopyright();
        $this->assign('copyright', $copyright[ 'data' ][ 'value' ]);

        // 查询小程序配置信息
        $weapp_config_model = new WeappConfigModel();
        $weapp_config = $weapp_config_model->getWeappConfig($this->site_id);
        $weapp_config = $weapp_config[ 'data' ][ 'value' ];
        $this->assign('base_weapp_config', $weapp_config);
    }

    /**
     * layui化处理菜单数据
     */
    public function initMenu($menus_list, $parent = "")
    {
        $temp_list = [];
        if (!empty($menus_list)) {
            foreach ($menus_list as $menu_k => $menu_v) {

                if (in_array($menu_v[ 'name' ], $this->crumbs_array)) {
                    $selected = true;
                } else {
                    $selected = false;
                }

                if ($menu_v[ "parent" ] == $parent && $menu_v[ "is_show" ] == 1) {
                    $temp_item = array (
                        'addon' => $menu_v[ 'addon' ],
                        'selected' => $selected,
                        'url' => addon_url($menu_v[ 'url' ]),
                        'title' => $menu_v[ 'title' ],
                        'icon' => $menu_v[ 'picture' ],
                        'icon_selected' => $menu_v[ 'picture_select' ],
                        'target' => '',
                        'parent' => $menu_v[ 'parent' ]
                    );

                    $child = $this->initMenu($menus_list, $menu_v[ "name" ]);//获取下级的菜单
                    $temp_item[ "child_list" ] = $child;
                    $temp_list[ $menu_v[ "name" ] ] = $temp_item;
                }
            }
        }
        return $temp_list;
    }

    /**
     * 获取上级菜单列表
     * @param number $menu_id
     */
    private function getParentMenuList($name = '')
    {
        if (!empty($name)) {
            $menu_model = new Menu();
            $menu_info_result = $menu_model->getMenuInfo([ [ 'name', "=", $name ], [ 'app_module', '=', $this->app_module ] ]);
            $menu_info = $menu_info_result[ "data" ];
            if (!empty($menu_info)) {
                $this->getParentMenuList($menu_info[ 'parent' ]);
                $menu_info[ "url" ] = addon_url($menu_info[ "url" ]);
                $this->crumbs[] = $menu_info;
                $this->crumbs_array[] = $menu_info[ 'name' ];
            }
        }

    }

    /**
     * 获取当前用户的用户组
     */
    private function getGroupInfo()
    {
        $group_model = new GroupModel();
        $group_info_result = $group_model->getGroupInfo([ [ "group_id", "=", $this->user_info[ "group_id" ] ], [ "site_id", "=", $this->site_id ], [ "app_module", "=", $this->app_module ] ]);
        $this->group_info = $group_info_result[ "data" ];

    }

    /**
     * 验证登录
     */
    private function checkLogin()
    {
        //验证基础登录
        if (!$this->uid) {
            $this->redirect(url('shop/login/login'));
        }
    }

    /**
     * 检测权限
     */
    private function checkAuth()
    {
        $user_model = new UserModel();
        $res = $user_model->checkAuth($this->url, $this->app_module, $this->group_info, $this->addon);
        return $res;
    }

    /**
     * 获取菜单
     */
    private function getMenuList()
    {
        $menu_model = new Menu();
        //暂定全部权限，系统用户做完后放开
        if ($this->user_info[ 'is_admin' ] || $this->group_info[ 'is_system' ] == 1) {
            $menus = $menu_model->getMenuList([ [ 'app_module', "=", $this->app_module ], [ 'is_show', "=", 1 ] ], '*', 'sort asc');
        } else {
            $menus = $menu_model->getMenuList([ [ 'name', 'in', $this->group_info[ 'menu_array' ] ], [ 'is_show', "=", 1 ], [ 'app_module', "=", $this->app_module ] ], '*', 'sort asc');
            $control_menu = $menu_model->getMenuList([ [ 'is_control', '=', 0 ], [ 'is_show', "=", 1 ], [ 'app_module', "=", $this->app_module ] ], '*', 'sort asc');
            $menus[ 'data' ] = array_merge($control_menu[ 'data' ], $menus[ 'data' ]);
        }

        return $menus[ 'data' ];
    }

    /**
     * 获取顶级菜单
     */
    protected function getTopMenu()
    {
        $list = array_filter($this->menus, function($v) {
            return $v[ 'parent' ] == '0';
        });
        return $list;

    }

    /**
     * 四级菜单
     * @param unknown $params
     */
    protected function forthMenu($params = [])
    {
        $url = strtolower($this->url);
        $menu_model = new Menu();
        $menu_info = $menu_model->getMenuInfo([ [ 'url', "=", $url ], [ 'level', '=', 4 ] ], 'parent');
        if (!empty($menu_info[ 'data' ])) {
            $menus = $menu_model->getMenuList([ [ 'app_module', "=", $this->app_module ], [ 'is_show', "=", 1 ], [ 'parent', '=', $menu_info[ 'data' ][ 'parent' ] ] ], '*', 'sort asc');
            foreach ($menus[ 'data' ] as $k => $v) {
                $menus[ 'data' ][ $k ][ 'parse_url' ] = addon_url($menus[ 'data' ][ $k ][ 'url' ], $params);
                if ($menus[ 'data' ][ $k ][ 'url' ] == $url) {
                    $menus[ 'data' ][ $k ][ 'selected' ] = 1;
                } else {
                    $menus[ 'data' ][ $k ][ 'selected' ] = 0;
                }
            }
            $this->assign('forth_menu', $menus[ 'data' ]);
        }
    }

    /**
     * 五级菜单
     * @param unknown $params
     */
    protected function fiveMenu($params = [])
    {
        $url = strtolower($this->url);
        $menu_model = new Menu();
        $menu_info = $menu_model->getMenuInfo([ [ 'url', "=", $url ], [ 'level', '=', 5 ] ], 'parent');

        if (!empty($menu_info[ 'data' ])) {
            $menus = $menu_model->getMenuList([ [ 'app_module', "=", $this->app_module ], [ 'is_show', "=", 1 ], [ 'parent', '=', $menu_info[ 'data' ][ 'parent' ] ] ], '*', 'sort asc');
            foreach ($menus[ 'data' ] as $k => $v) {
                $menus[ 'data' ][ $k ][ 'parse_url' ] = addon_url($menus[ 'data' ][ $k ][ 'url' ], $params);
                if ($menus[ 'data' ][ $k ][ 'url' ] == $url) {
                    $menus[ 'data' ][ $k ][ 'selected' ] = 1;
                } else {
                    $menus[ 'data' ][ $k ][ 'selected' ] = 0;
                }
            }
            $this->assign('forth_menu', $menus[ 'data' ]);
        }
    }

    /**
     * 添加日志
     * @param unknown $action_name
     * @param unknown $data
     */
    protected function addLog($action_name, $data = [])
    {
        $user = new UserModel();
        $user->addUserLog($this->uid, $this->user_info[ 'username' ], $this->site_id, $action_name, $data);
    }

}