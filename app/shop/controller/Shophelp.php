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

use app\model\web\Help as HelpModel;

/**
 * 商家帮助
 */
class Shophelp extends BaseShop
{

    /**
     * 帮助列表
     */
    public function helpList()
    {
        $help_model = new HelpModel();
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $class_id    = input('class_id', '');
            $condition   = [
                ['app_module', '=', 'shop']
            ];
            if (!empty($class_id)) {
                $condition[] = ['class_id', '=', $class_id];
            }
            $condition[] = ['title', 'like', '%' . $search_text . '%'];
            $order       = 'create_time desc';
            $field       = 'id,title,class_id,class_name,sort,create_time';

            return $help_model->getHelpPageList($condition, $page, $page_size, $order, $field);
        } else {
            $class_list = $help_model->getHelpClassList();
            $this->assign("class_list", $class_list);
            $this->assign('menu_info', ['title' => '商家帮助']);
            return $this->fetch('shophelp/help_list');
        }
    }

    /**
     * 帮助列表
     */
    public function helpDetail()
    {
        $help_id    = input('help_id', 1);
        $help_model = new HelpModel();
        $help_info  = $help_model->getHelpInfo($help_id);
        $this->assign("help_info", $help_info['data']);
        $this->assign('menu_info', ['title' => $help_info['data']['title']]);
        return $this->fetch('shophelp/help_detail');
    }

}