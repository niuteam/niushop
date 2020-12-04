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

use app\model\system\Config as ConfigModel;
use app\model\system\DiyTemplate;
use app\model\web\DiyView as DiyViewModel;

/**
 * 网站装修控制器
 */
class Diy extends BaseShop
{
    /**
     * 网站主页
     */
    public function index()
    {
        $diy_view = new DiyViewModel();
        $page = $diy_view->getPage();

        // 查询公共组件和支持的页面
        $condition = [
            [ 'support_diy_view', 'like', [ $page[ 'shop' ][ 'index' ][ 'name' ], '%' . $page[ 'shop' ][ 'index' ][ 'name' ] . ',%', '%' . $page[ 'shop' ][ 'index' ][ 'name' ], '%,' . $page[ 'shop' ][ 'index' ][ 'name' ] . ',%', 'DIY_VIEW_SHOP', '' ], 'or' ]
        ];

        $data = [
            'app_module' => $this->app_module,
            'site_id' => $this->site_id,
            'name' => $page[ 'shop' ][ 'index' ][ 'name' ],
            'condition' => $condition
        ];
        $edit_view = event('DiyViewEdit', $data, true);
        return $edit_view;
    }

    /**
     * 商品分类页面
     */
    public function goodsCategory()
    {
        $diy_view = new DiyViewModel();
        $page = $diy_view->getPage();
        // 查询公共组件和支持的页面
        $condition = [
            [ 'name', '=', 'GOODS_CATEGORY' ]
        ];

        $data = [
            'app_module' => $this->app_module,
            'site_id' => $this->site_id,
            'name' => $page[ 'shop' ][ 'goods_category' ][ 'name' ],
            'condition' => $condition,
            'disabled_page_set' => 1
        ];
        $edit_view = event('DiyViewEdit', $data, true);
        return $edit_view;
    }

    /**
     * 会员中心
     */
    public function memberIndex()
    {
        $diy_view = new DiyViewModel();
        if (request()->isAjax()) {
            $data = input("data", '');
            $res = $diy_view->setMemberIndexDiyConfig($data, $this->site_id);
            return $res;
        } else {
            $info = $diy_view->getMemberIndexDiyConfig($this->site_id);
            $info = $info[ 'data' ][ 'value' ];
            $this->assign("info", json_encode($info));
            $this->assign("app_module", $this->app_module);
            return $this->fetch('diy/member_index');
        }
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if (request()->isAjax()) {
            $res = 0;
            $data = array ();
            $id = input("id", 0);
            $name = input("name", "");
            $title = input("title", "");
            $value = input("value", "");
            if (!empty($name) && !empty($title) && !empty($value)) {
                $diy_view = new DiyViewModel();
                $page = $diy_view->getPage();
                $data[ 'site_id' ] = $this->site_id;
                $data[ 'name' ] = $name;
                $data[ 'title' ] = $title;
                $data[ 'type' ] = $page[ 'shop' ][ 'port' ];
                $data[ 'value' ] = $value;
                if ($id == 0 && $name != 'DIYVIEW_INDEX') {
                    $data[ 'create_time' ] = time();
                    $res = $diy_view->addSiteDiyView($data);
                } else {
                    $data[ 'update_time' ] = time();
                    $res = $diy_view->editSiteDiyView($data, [
                        [ 'id', '=', $id ]
                    ]);
                }
            }

            return $res;
        } else {

            $id = input("id", 0);
            //查询公共系统组件
            $condition = [
                [ 'support_diy_view', 'like', [ '', 'DIY_VIEW_SHOP' ], 'or' ]
            ];
            $data = [
                'app_module' => $this->app_module,
                'site_id' => $this->site_id,
                'id' => $id,
                'condition' => $condition
            ];
            $edit_view = event('DiyViewEdit', $data, true);
            return $edit_view;
        }
    }

    /**
     * 微页面
     */
    public function lists()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $diy_view = new DiyViewModel();
            $page = $diy_view->getPage();
            $condition = array (
                [ 'sdv.site_id', '=', $this->site_id ],
                [ 'sdv.type', '=', $page[ 'shop' ][ 'port' ] ],
                [ 'sdv.name', 'like', '%DIY_VIEW_RANDOM_%' ]
            );
            $list = $diy_view->getSiteDiyViewPageList($condition, $page_index, $page_size, "INSTR('DIYVIEW_INDEX', sdv.name) desc, sdv.create_time desc");
            return $list;
        } else {
            return $this->fetch('diy/lists');
        }
    }

    /**
     * 链接选择
     */
    public function link()
    {
        $data = [
            'app_module' => $this->app_module,
            'site_id' => $this->site_id,
        ];
        $diy_link = event('DiyLink', $data, true);
        return $diy_link;
    }

    public function childLink()
    {
        $diy_child_link = event('DiyChildLink', [ 'site_id' => $this->site_id ], true);
        return $diy_child_link;
    }

    /**
     * 删除自定义模板页面
     */
    public function deleteSiteDiyView()
    {
        if (request()->isAjax()) {
            $diy_view = new DiyViewModel();
            $id_array = input("id", 0);
            $condition = [
                [ 'id', 'in', $id_array ]
            ];
            $res = $diy_view->deleteSiteDiyView($condition);
            return $res;
        }
    }

    /**
     * 底部导航
     */
    public function bottomNavDesign()
    {
        $diy_view = new DiyViewModel();
        if (request()->isAjax()) {
            $value = input("value", "");
            $res = $diy_view->setBottomNavConfig($value, $this->site_id);
            return $res;
        } else {
            $bottom_nav_info = $diy_view->getBottomNavConfig($this->site_id);
            $this->assign("bottom_nav_info", $bottom_nav_info[ 'data' ][ 'value' ]);
            return $this->fetch('diy/bottom_nav_design');
        }

    }

    /**
     * 推广链接
     */
    public function promote()
    {
        if (request()->isAjax()) {
            $id = input("id", 0);
            $diy_view = new DiyViewModel();
            $res = $diy_view->qrcode([
                [ 'site_id', '=', $this->site_id ],
                [ 'id', '=', $id ]
            ]);
            return $res;
        }
    }

    /**
     * 店铺风格
     */
    public function style()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $data = [
                'style_theme' => input('style_theme', '')
            ];

            $res = $config_model->setConfig($data, '店铺风格设置', '1', [ [ 'site_id', '=', $this->site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'SHOP_STYLE_CONFIG' ] ]);
            return $res;
        }

        $res = $config_model->getConfig([ [ 'site_id', '=', $this->site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'SHOP_STYLE_CONFIG' ] ]);
        $style_theme = empty($res[ 'data' ][ 'value' ]) ? [] : $res[ 'data' ][ 'value' ];
        $this->assign('style_theme', $style_theme);
        return $this->fetch('diy/style');
    }

    public function template()
    {
        $diy_view = new DiyViewModel();
        $page = $diy_view->getPage();

        if (request()->isAjax()) {
            $diy_view = new DiyTemplate();
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition = [
                [ 'type', '=', $page[ 'shop' ][ 'index' ][ 'name' ] ]
            ];
            $data = $diy_view->getTemplatePageList($condition, '*', 'id asc', $page_index, $page_size);
            return $data;
        } else {
            return $this->fetch('diy/template');
        }
    }

    /**
     * 创建
     */
    public function create()
    {
        if (request()->isAjax()) {
            $res = 0;
            $name = input("name", "");
            $title = input("title", "");
            $value = input("value", "");
            if (!empty($name) && !empty($title) && !empty($value)) {
                $diy_view = new DiyViewModel();
                $page = $diy_view->getPage();
                $data = [
                    'site_id' => $this->site_id,
                    'name' => $name,
                    'title' => $title,
                    'type' => $page[ 'shop' ][ 'port' ],
                    'value' => $value,
                    'create_time' => time()
                ];
                $res = $diy_view->addSiteDiyViewByTemplate($data);
            }
            return $res;
        } else {
            $template_id = input('id', 0);
            $data = [
                'app_module' => $this->app_module,
                'site_id' => $this->site_id,
                'template_id' => $template_id
            ];
            $edit_view = event('DiyViewCreate', $data, true);
            return $edit_view;
        }
    }

    /**
     * 设为主页
     */
    public function homePage()
    {
        if (request()->isAjax()) {
            $diy_view = new DiyViewModel();
            $id = input('id', 0);
            $res = $diy_view->setPage('shop', 'index', $id, $this->site_id);
            return $res;
        }
    }

    /**
     * 修改排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $sort = input('sort', 0);
            $id = input('id', 0);
            $diy_view = new DiyViewModel();
            return $diy_view->modifyDiyViewSort($sort, $id);
        }
    }
}