<?php

/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use app\model\BaseModel;
use app\model\web\DiyViewLink;
use think\facade\Cache;
use think\facade\Db;
use app\model\system\Upgrade as UpgradeModel;


class AddonQuick extends BaseModel
{

    /**
     * 添加快捷方式
     * @param $data
     * @return array
     */
    public function addAddonQuickMode($data)
    {
        //判断是否已存在该插件
        $addon_count = model('addon_quick')->getCount([ [ 'name', '=', $data[ 'name' ] ] ]);
        if ($addon_count > 0) {
            return $this->error('', '该插件已添加快捷方式，请不要重复添加');
        }

        $data[ 'create_time' ] = time();
        $res = model('addon_quick')->add($data);
        return $this->success($res);
    }

    /**
     * 删除快捷方式
     * @param array $condition
     * @return array
     */
    public function deleteAddonQuickMode($condition = [])
    {
        $res = model('addon_quick')->delete($condition);
        return $this->success($res);
    }

    /**
     * 获取快捷方式信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getAddonQuickModeInfo($condition = [], $field = '*')
    {
        $info = model('addon_quick')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 获取快捷方式类表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getAddonQuickModeList($condition = [], $order = '', $field = '*')
    {
        $list = model('addon_quick')->getList($condition, $field, $order);
        return $this->success($list);
    }

    /**
     * 判断快捷方式插件是否已安装
     * @param $uninstall
     * @param $install
     * @return array
     */
    public function isInstallAddonQuick($uninstall, $install)
    {
        //未安装的插件
        $uninstall_name_arr = array_column($uninstall, 'name');
        //已安装的插件
        $install_name_arr = array_column($install, 'name');
        //获取快捷方式插件
        $addon_quick_list = $this->getAddonQuickModeList([], '', '*');

        if (empty($addon_quick_list[ 'data' ])) {
            return [
                'uninstall' => $uninstall,
                'install' => $install
            ];
        } else {

            foreach ($addon_quick_list[ 'data' ] as $k => $v) {

                //判断是否在已安装的插件中
                if (!in_array($v[ 'name' ], $install_name_arr)) {
                    //判断是否在未安装的插件中
                    if (empty($uninstall_name_arr) || !in_array($v[ 'name' ], $uninstall_name_arr)) {
                        $v[ 'is_quick' ] = 1;
                        $v[ 'download' ] = 1;
                        $uninstall[] = $v;
                    }
                }
            }

            return [
                'uninstall' => $uninstall,
                'install' => $install
            ];
        }
    }

    /**
     * 根据插件类型获取官网插件
     * @param $addon_list
     * @param $type
     * @return array
     */
    public function getAddonQuickByAddonType($addon_list, $type)
    {
        //获取官网所有插件
        $upgrade_model = new UpgradeModel();
        $website_addon_list = $upgrade_model->getPluginGoodsList();

        $arr = [];
        if (empty($website_addon_list)) {
            return $arr;
        } else {

            $addon_name_arr = array_column($addon_list, 'name');
            foreach ($website_addon_list as $k => $v) {

                if ($v[ 'type_mark' ] == $type) {

                    if (empty($addon_list)) {
                        $arr[] = $v;
                    } else {
                        //判断是否在插件中
                        if (!in_array($v[ 'addon_goods_key' ], $addon_name_arr)) {
                            $arr[] = $v;
                        }
                    }

                }
            }

            return $arr;
        }
    }
}
