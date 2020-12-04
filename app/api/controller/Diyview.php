<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * =========================================================
 */

namespace app\api\controller;

use app\model\web\DiyView as DiyViewModel;
use app\model\system\Config as ConfigModel;

/**
 * 自定义模板
 * @package app\api\controller
 */
class Diyview extends BaseApi
{

    /**
     * 基础信息
     */
    public function info()
    {
        $id = isset($this->params[ 'id' ]) ? $this->params[ 'id' ] : 0;
        $name = isset($this->params[ 'name' ]) ? $this->params[ 'name' ] : '';// 门店主页name格式：DIY_STORE_stroe_id

        if (empty($id) && empty($name)) {
            return $this->response($this->error('', 'REQUEST_DIY_ID_NAME'));
        }
        $diy_view = new DiyViewModel();
        $condition = [
            [ 'sdv.site_id', '=', $this->site_id ]
        ];
        if (!empty($id)) {
            $condition[] = [ 'sdv.id', '=', $id ];
            $diy_view->modifyClick([ [ 'id', '=', $id ] ], $this->site_id);
        }
        if (!empty($name)) {
            $condition[] = [ 'sdv.name', '=', $name ];
            $diy_view->modifyClick([ [ 'name', '=', $name ] ], $this->site_id);
        }

        $info = $diy_view->getSiteDiyViewDetail($condition);

        if (!empty($info[ 'data' ][ 'value' ])) {
            $json_data = json_decode($info[ 'data' ][ 'value' ], true);
            foreach ($json_data[ 'value' ] as $k => $v) {
                if (!empty($v[ 'addon_name' ])) {
                    $is_exit = addon_is_exit($v[ 'addon_name' ], $this->site_id);
                    // 检查插件是否存在
                    if ($is_exit == 0) {
                        unset($json_data[ 'value' ][ $k ]);
                    }
                }
            }
            $json_data[ 'value' ] = array_values($json_data[ 'value' ]);
            $info[ 'data' ][ 'value' ] = json_encode($json_data);
        }


        return $this->response($info);
    }

    /**
     * 平台端底部导航
     * @return string
     */
    public function bottomNav()
    {
        $site_id = $this->site_id;
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $diy_view = new DiyViewModel();
        $info = $diy_view->getBottomNavConfig($site_id);
        return $this->response($info);
    }

    /**
     * 风格
     */
    public function style()
    {
        $site_id = $this->site_id;
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $config_model = new ConfigModel();
        $res = $config_model->getConfig([ [ 'site_id', '=', $this->site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'SHOP_STYLE_CONFIG' ] ]);
        $style_theme = empty($res[ 'data' ][ 'value' ]) ? [ 'style_theme' => 'default' ] : $res[ 'data' ][ 'value' ];
        return $this->response($this->success($style_theme));
    }

    /**
     * 自定义会员中心配置
     * @return string
     */
    public function memberIndex()
    {
        $site_id = $this->site_id;
        if (empty($site_id)) {
            return $this->response($this->error('', 'REQUEST_SITE_ID'));
        }
        $diy_view = new DiyViewModel();
        $info = $diy_view->getMemberIndexDiyConfig($site_id);
        $info = $info[ 'data' ][ 'value' ];
        foreach ($info[ 'menuList' ] as $k => $v) {
            if ($v[ 'isShow' ] == 0) {
                unset($info[ 'menuList' ][ $k ]);
                continue;
            }

            if (isset($v[ 'tag' ]) && $v[ 'tag' ] != 'verifier') {

                $is_exit = addon_is_exit($v[ 'tag' ], $this->site_id);// 检查插件是否安装
                if ($is_exit == 0) {
                    unset($info[ 'menuList' ][ $k ]);
                    continue;
                }
            }

            $info[ 'menuList' ][ $k ][ 'url' ] = $info[ 'menuList' ][ $k ][ 'link' ][ 'wap_url' ];
            unset($info[ 'menuList' ][ $k ][ 'isShow' ]);
            unset($info[ 'menuList' ][ $k ][ 'isSystem' ]);
            unset($info[ 'menuList' ][ $k ][ 'link' ]);
            unset($info[ 'menuList' ][ $k ][ 'remark' ]);
        }
        $info[ 'menuList' ] = array_values($info[ 'menuList' ]);
        return $this->response($this->success($info));
    }
}