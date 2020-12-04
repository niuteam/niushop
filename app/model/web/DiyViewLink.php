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

class DiyViewLink extends BaseModel
{
    public $list = [];


    /**
     * 获取链接
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getLinkList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('link')->getList($condition, $field, $order, '', '', '', $limit);

        return $this->success($list);
    }

    /**
     *
     * @param unknown $tree
     * @param unknown $port
     */
    public function getViewLinkList($tree, $addon)
    {
        $list = [];
        foreach ($tree as $k => $v) {
            if (isset($v['parent'])) {
                if ($v['parent'] == '') {
                    $parent = '';
                    $level  = 1;
                } else {
                    $parent_menu_info = model('link')->getInfo([
                        ['name', "=", $v['parent']]
                    ]);
                    if ($parent_menu_info) {
                        $parent = $parent_menu_info['name'];
                        $level  = $parent_menu_info['level'] + 1;
                    } else {
                        $level = 1;
                    }
                }
            } else {
                $parent = '';
                $level  = 1;
            }

            $item = [
                'addon_name'       => isset($addon) ? $addon : '',
                'name'             => $v['name'],
                'title'            => $v['title'],
                'parent'           => $parent,
                'sort'             => isset($v['sort']) ? $v['sort'] : 100,
                'level'            => $level,
                'wap_url'          => isset($v['wap_url']) ? $v['wap_url'] : '',
                'web_url'          => isset($v['web_url']) ? $v['web_url'] : '',
                'icon'             => isset($v['icon']) ? $v['icon'] : '',
                'support_diy_view' => isset($v['support_diy_view']) ? $v['support_diy_view'] : '',
            ];

            array_push($list, $item);
            if (isset($v['child_list'])) {
                $this->list = [];
                $this->linkTreeToList($v['child_list'], $addon, $v['name'], $level + 1);
                $list = array_merge($list, $this->list);
            }
        }
        return $list;
    }

    /**
     * 菜单树转化为列表
     * @param unknown $tree
     * @param unknown $module
     * @param unknown $port
     * @param string $pid
     * @param number $level
     */
    private function linkTreeToList($tree, $addon = '', $parent = '', $level = 1)
    {
        if (is_array($tree)) {
            foreach ($tree as $key => $value) {
                $item  = [

                    'addon_name'       => $addon,
                    'name'             => $value['name'],
                    'title'            => $value['title'],
                    'parent'           => $parent,
                    'sort'             => isset($value['sort']) ? $value['sort'] : 100,
                    'level'            => $level,
                    'wap_url'          => isset($value['wap_url']) ? $value['wap_url'] : '',
                    'web_url'          => isset($value['web_url']) ? $value['web_url'] : '',
                    'icon'             => isset($value['icon']) ? $value['icon'] : '',
                    'support_diy_view' => isset($value['support_diy_view']) ? $value['support_diy_view'] : '',
                ];
                $refer = $value;
                if (isset($refer['child_list'])) {
                    unset($refer['child_list']);
                    array_push($this->list, $item);
                    $p_name = $refer['name'];
                    $this->linkTreeToList($value['child_list'], $addon, $p_name, $level + 1);
                } else {
                    array_push($this->list, $item);
                }
            }
        }
    }
}