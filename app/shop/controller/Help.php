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
 * 网站帮助
 */
class Help extends BaseShop
{
    /**
     * 分类列表
     */
    public function classList()
    {
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');

            $condition   = [['site_id', '=', $this->site_id]];
            $condition[] = ['class_name', 'like', '%' . $search_text . '%'];
            $condition[] = ['app_module', '=', $this->app_module];
            $order       = 'sort asc,create_time desc';
            $field       = '*';

            $help_model = new HelpModel();
            return $help_model->getHelpClassPageList($condition, $page, $page_size, $order, $field);
        } else {
            $this->forthMenu();
            return $this->fetch('help/class_list');
        }
    }

    /**
     * 分类添加
     */
    public function addClass()
    {
        if (request()->isAjax()) {
            $data       = [
                'site_id'    => $this->site_id,
                'app_module' => $this->app_module,
                'class_name' => input('class_name', ''),
                'sort'       => input('sort', 0),
            ];
            $help_model = new HelpModel();
            return $help_model->addHelpClass($data);
        } else {
            return $this->fetch('help/add_class');
        }
    }

    /**
     * 分类编辑
     */
    public function editClass()
    {
        $help_model = new HelpModel();
        if (request()->isAjax()) {
            $data     = [
                'site_id'    => $this->site_id,
                'app_module' => $this->app_module,
                'class_name' => input('class_name', ''),
                'sort'       => input('sort', 0),
            ];
            $class_id = input('class_id', 0);

            return $help_model->editHelpClass($data, $class_id);
        } else {
            $class_id = input('class_id', 0);
            $this->assign('class_id', $class_id);

            //帮助详情
            $class_info = $help_model->getHelpClassInfo([['class_id', '=', $class_id], ['site_id', '=', $this->site_id], ['app_module', '=', $this->app_module]]);
            $this->assign('class_info', $class_info);

            return $this->fetch('help/edit_class');
        }
    }

    /**
     * 分类删除
     */
    public function deleteClass()
    {
        if (request()->isAjax()) {
            $class_id   = input('class_id', 0);
            $help_model = new HelpModel();
            return $help_model->deleteHelpClass([['class_id', '=', $class_id]]);
        }
    }

    /**
     * 修改分类排序
     */
    public function modifyClassSort()
    {
        if (request()->isAjax()) {
            $sort       = input('sort', 0);
            $class_id   = input('class_id', 0);
            $help_model = new HelpModel();
            return $help_model->modifyHelpClassSort($sort, $class_id);
        }
    }


    /**
     * 帮助列表
     */
    public function helpList()
    {
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');

            $condition   = [['site_id', '=', $this->site_id]];
            $condition[] = ['title', 'like', '%' . $search_text . '%'];
            $condition[] = ['app_module', '=', $this->app_module];
            $order       = 'sort asc,create_time desc';
            $field       = 'id,title,class_id,class_name,sort,create_time';

            $help_model = new HelpModel();
            return $help_model->getHelpPageList($condition, $page, $page_size, $order, $field);
        } else {
            $this->forthMenu();
            return $this->fetch('help/help_list');
        }
    }

    /**
     * 帮助添加
     */
    public function addHelp()
    {
        $help_model = new HelpModel();
        if (request()->isAjax()) {
            $data = [
                'site_id'      => $this->site_id,
                'app_module'   => $this->app_module,
                'title'        => input('title', ''),
                'link_address' => input('link_address', ''),
                'content'      => input('content', ''),
                'class_id'     => input('class_id', ''),
                'class_name'   => input('class_name', ''),
                'sort'         => input('sort', ''),
                'create_time'  => time(),
            ];

            return $help_model->addHelp($data);
        } else {
            //帮助分类
            $help_class_list = $help_model->getHelpClassList([['app_module', '=', $this->app_module], ['site_id', '=', $this->site_id]], 'class_id, class_name');
            $this->assign('help_class_list', $help_class_list['data']);

            return $this->fetch('help/add_help');
        }
    }

    /**
     * 帮助编辑
     */
    public function editHelp()
    {
        $id         = input('id', 0);
        $help_model = new HelpModel();
        if (request()->isAjax()) {
            $data = [
                'site_id'      => $this->site_id,
                'app_module'   => $this->app_module,
                'title'        => input('title', ''),
                'link_address' => input('link_address', ''),
                'content'      => input('content', ''),
                'class_id'     => input('class_id', ''),
                'class_name'   => input('class_name', ''),
                'sort'         => input('sort', ''),
                'modify_time'  => time(),
            ];

            return $help_model->editHelp($data, [['id', '=', $id]]);
        } else {
            $this->assign('id', $id);

            $help_info = $help_model->getHelpInfo($id);
            $this->assign('help_info', $help_info['data']);

            //帮助分类
            $help_class_list = $help_model->getHelpClassList([['app_module', '=', $this->app_module], ['site_id', '=', $this->site_id]], 'class_id, class_name');
            $this->assign('help_class_list', $help_class_list['data']);

            return $this->fetch('help/edit_help');
        }
    }

    /**
     * 帮助删除
     */
    public function deleteHelp()
    {
        if (request()->isAjax()) {
            $id         = input('id', 0);
            $help_model = new HelpModel();
            return $help_model->deleteHelp([['id', '=', $id]]);
        }
    }

    /**
     * 修改排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $sort       = input('sort', 0);
            $help_id    = input('help_id', 0);
            $help_model = new HelpModel();
            return $help_model->modifyHelpSort($sort, $help_id);
        }
    }

}