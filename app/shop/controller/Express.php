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

use app\model\express\ExpressCompany;
use app\model\express\ExpressCompanyTemplate;
use app\model\express\ExpressTemplate;
use app\model\system\Address as AddressModel;
use app\model\express\Kd100;
use app\model\express\Kdbird;

/**
 * 配送
 * Class Express
 * @package app\shop\controller
 */
class Express extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 物流公司
     * @return mixed
     */
    public function expressCompany()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $condition[] = [ 'site_id', '=', $this->site_id ];
            $condition[] = [ 'company_name', 'like', '%' . $search_text . '%' ];
            $order = 'is_electronicsheet desc,sort asc';
            $field = 'company_id,company_name,logo,sort,url,is_electronicsheet';

            $express_company_model = new ExpressCompanyTemplate();
            return $express_company_model->getExpressCompanyTemplatePageList($condition, $page, $page_size, $order, $field);
        } else {
            $this->forthMenu();
            return $this->fetch('express/express_company');
        }
    }

    /**
     * 添加物流公司
     */
    public function addCompany()
    {
        $template_model = new ExpressCompanyTemplate();
        if (request()->isAjax()) {
            $data = [
                'site_id' => $this->site_id,
                'company_name' => input('company_name', ''),//物流公司名称
                'sort' => input('sort', 0),//排序
                'logo' => input('logo', ''),//logo
                'url' => input('url', ''),//网址
                'express_no' => input('express_no', ''),//编码
                'express_no_kd100' => input('express_no_kd100', ''),//编码（快递100）
                'express_no_cainiao' => input('express_no_cainiao', ''),//编码（菜鸟）
                'content_json' => input('content_json', '[]'),//打印内容
                'background_image' => input('background_image', ''),//打印背景图
                'font_size' => input('font_size', 14),//打印字体大小 单位px
                'width' => input('width', 0),//显示尺寸宽度 px
                'height' => input('height', 0),//显示尺寸高度 px
                'scale' => input('scale', 1),//真实尺寸（mm）与显示尺寸（px）的比例
                'create_time' => time(),
                'is_electronicsheet' => input('is_electronicsheet', 0),//是否支持电子面单
                'print_style' => input('print_style', 0),//电子面单打印风格
            ];

            $res = $template_model->addExpressCompanyTemplate($data);
            if ($res[ 'code' ] >= 0) {
                $express_company_model = new ExpressCompany();
                $express_company_model->addExpressCompany([ 'site_id' => $this->site_id, 'company_id' => $res[ 'data' ] ]);
                $this->addLog("添加物流公司:" . $data[ 'company_name' ], $data);
            }
            return $res;
        } else {

            //打印项
            $print_item_list = $template_model->getPrintItemList();
            $this->assign('print_item_list', $print_item_list);

            return $this->fetch('express/add_company');
        }
    }

    /**
     * 物流公司编辑
     */
    public function editCompany()
    {
        $template_model = new ExpressCompanyTemplate();
        if (request()->isAjax()) {
            $data = [
                'site_id' => $this->site_id,
                'company_name' => input('company_name', ''),//物流公司名称
                'sort' => input('sort', 0),//排序
                'logo' => input('logo', ''),//logo
                'url' => input('url', ''),//网址
                'express_no' => input('express_no', ''),//编码
                'express_no_kd100' => input('express_no_kd100', ''),//编码（快递100）
                'express_no_cainiao' => input('express_no_cainiao', ''),//编码（菜鸟）
                'content_json' => input('content_json', '[]'),//打印内容
                'background_image' => input('background_image', ''),//打印背景图
                'font_size' => input('font_size', 14),//打印字体大小 单位mm
                'width' => input('width', 0),//显示尺寸宽度 px
                'height' => input('height', 0),//显示尺寸高度 px
                'scale' => input('scale', 1),//真实尺寸（mm）与显示尺寸（px）的比例
                'modify_time' => time(),
                'company_id' => input('company_id', 0),
                'is_electronicsheet' => input('is_electronicsheet', 0),//是否支持电子面单
                'print_style' => input('print_style', 0),//电子面单打印风格
            ];

            $res = $template_model->editExpressCompanyTemplate($data);
            if ($res[ 'code' ] == 0) {
                $express_company_model = new ExpressCompany();
                $express_company_model->editExpressCompany([
                    'content_json' => $data[ 'content_json' ],
                    'background_image' => $data[ 'background_image' ],
                    'font_size' => $data[ 'font_size' ],
                    'width' => $data[ 'width' ],
                    'height' => $data[ 'height' ]
                ], [ [ "site_id", "=", $this->site_id ], [ "company_id", "=", $data[ 'company_id' ] ] ]);
            }
            $this->addLog("编辑物流公司:" . $data[ 'company_name' ], $data);
            return $res;
        } else {
            //物流公司信息
            $company_id = input('company_id', 0);
            $company_info = $template_model->getExpressCompanyTemplateInfo([ [ 'company_id', '=', $company_id ] ]);
            $this->assign('company_info', $company_info);

            //打印项
            $print_item_list = $template_model->getPrintItemList();
            $this->assign('print_item_list', $print_item_list);

            return $this->fetch('express/edit_company');
        }
    }

    public function deleteCompany()
    {
        if (request()->isAjax()) {
            $company_ids = input('company_ids', '');
            $template_model = new ExpressCompanyTemplate();
            $this->addLog("删除物流公司:" . $company_ids);
            $res = $template_model->deleteExpressCompanyTemplate([ [ 'company_id', 'in', $company_ids ] ]);
            if ($res[ 'code' ] == 0) {
                $express_company_model = new ExpressCompany();
                $express_company_model->deleteExpressCompany([ [ "site_id", "=", $this->site_id ], [ "company_id", "in", $company_ids ] ]);
            }
            return $res;
        }
    }

    /**
     * 修改物流公司排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {
            $sort = input('sort', 0);
            $company_id = input('company_id', 0);
            $express_company_model = new ExpressCompanyTemplate();
            return $express_company_model->modifyExpressCompanyTemplateSort($sort, $company_id);
        }
    }

    /**
     * 运费模板
     * @return mixed
     */
    public function template()
    {
        if (request()->isAjax()) {
            $express_template_model = new ExpressTemplate();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $order = input("order", "create_time desc");
            $keyword = input("keyword", '');
            $condition = array (
                [ 'site_id', "=", $this->site_id ],
            );
            //关键字查询
            if (!empty($keyword)) {
                $condition[] = [ "template_name", "like", "%" . $keyword . "%" ];
            }
            $result = $express_template_model->getExpressTemplatePageList($condition, $page, $page_size, $order);
            return $result;
        } else {
            return $this->fetch("express/template");
        }
    }


    /**
     * 添加运费模板
     * @return mixed
     */
    public function addTemplate()
    {
        if (request()->isAjax()) {
            $express_template_model = new ExpressTemplate();
            $fee_type = input("fee_type", '');//运费计算方式1.重量2体积3按件
            $template_name = input("template_name", '');
            $json = input("json", "");
            $is_default = input('is_default', 0);
            $surplus_area_ids = input('surplus_area_ids', '');
            if (empty($json))
                return error(-1, "模板配置不能为空!");

            $data = array (
                "fee_type" => $fee_type,
                "template_name" => $template_name,
                "site_id" => $this->site_id,
                'is_default' => $is_default,
                'surplus_area_ids' => $surplus_area_ids,
            );
            $json_data = json_decode($json, true);
            $result = $express_template_model->addExpressTemplate($data, $json_data);
            return $result;
        } else {
            // 地区等级设置 将来从配置中查询数据
            $area_level = 4;
            // 计费方式
            $fee_type_obj = [
                '1' => [ 'name' => '按重量计费', 'snum' => '首重（Kg）', 'xnum' => '续重（Kg）' ],
                '2' => [ 'name' => '按体积计费', 'snum' => '首体积(m³)', 'xnum' => '续体积(m³)' ],
                '3' => [ 'name' => '按件计费', 'snum' => '首件（个）', 'xnum' => '续件（个）' ],
            ];
            $this->assign('fee_type_obj', $fee_type_obj);
            $this->assign('fee_type_json', json_encode($fee_type_obj));
            $this->assign('area_level', $area_level);//地址级别
            return $this->fetch("express/add_template");
        }
    }

    /**
     * 编辑运费模板
     * @return mixed
     */
    public function editTemplate()
    {
        $template_id = input("template_id", 0);
        $express_template_model = new ExpressTemplate();
        if (request()->isAjax()) {
            $fee_type = input("fee_type", '');//运费计算方式1.重量2体积3按件
            $template_name = input("template_name", '');
            $json = input("json", "");
            $is_default = input('is_default', 0);
            $surplus_area_ids = input('surplus_area_ids', '');
            if (empty($json))
                return error(-1, "模板配置不能为空!");

            $data = array (
                "fee_type" => $fee_type,
                "template_name" => $template_name,
                "site_id" => $this->site_id,
                "template_id" => $template_id,
                "is_default" => $is_default,
                'surplus_area_ids' => $surplus_area_ids,
            );
            $json_data = json_decode($json, true);
            $result = $express_template_model->editExpressTemplate($data, $json_data);
            return $result;
        } else {
            // 地区等级设置 将来从配置中查询数据
            $area_level = 4;
            // 计费方式
            $fee_type_obj = [
                '1' => [ 'name' => '按重量计费', 'snum' => '首重（Kg）', 'xnum' => '续重（Kg）' ],
                '2' => [ 'name' => '按体积计费', 'snum' => '首体积(m³)', 'xnum' => '续体积(m³)' ],
                '3' => [ 'name' => '按件计费', 'snum' => '首件（个）', 'xnum' => '续件（个）' ],
            ];
            $this->assign('fee_type_obj', $fee_type_obj);
            $this->assign('fee_type_json', json_encode($fee_type_obj));
            $this->assign('area_level', $area_level);//地址级别
            $info_result = $express_template_model->getExpressTemplateInfo($template_id, $this->site_id);
            $info = $info_result[ "data" ];
            $this->assign("info", $info);
            return $this->fetch("express/edit_template");
        }
    }

    /**
     * 删除运费模板
     * @return mixed
     */
    public function deleteTemplate()
    {
        if (request()->isAjax()) {
            $template_id = input("template_id", 0);
            $express_template_model = new ExpressTemplate();
            $result = $express_template_model->deleteExpressTemplate($template_id, $this->site_id);
            return $result;
        }
    }

    /**
     * 设置默认运费模板
     * @return mixed
     */
    public function defaultTemplate()
    {
        if (request()->isAjax()) {
            $template_id = input("template_id", 0);
            $express_template_model = new ExpressTemplate();
            $result = $express_template_model->updateDefaultExpressTemplate($template_id, 1, $this->site_id);
            return $result;
        }
    }

    /**
     * 通过ajax得到运费模板的地区数据
     */
    public function getAreaList()
    {
        if (request()->isAjax()) {
            $address_model = new AddressModel();
            $area_level = input('level', 4);
            $area_list = $address_model->getAddressTree($area_level)[ 'data' ];
            return $area_list;
        }
    }

    /**
     * 查询可用物流公司
     */
    public function getShopExpressCompanyList()
    {
        if (request()->isAjax()) {
            $express_company_model = new ExpressCompany();
            //店铺物流公司
            $result = $express_company_model->getExpressCompanyList([ [ "site_id", "=", $this->site_id ] ]);
            return $result;
        }
    }


    /**
     * 物流跟踪
     */
    public function trace()
    {
        $kd100_model = new Kd100();
        $kdbird_model = new Kdbird();
        if (request()->isAjax()) {

            $trace = input('traces_type', 'kd100');
            if ($trace == 'kd100') {
                $data = array (
                    "appkey" => input("appkey", ""),
                    "customer" => input("customer", ""),
                );
                $result = $kd100_model->setKd100Config($data, 1, $this->site_id);
            }
            if ($trace == 'kdbird') {
                $data = array (
                    "EBusinessID" => input("EBusinessID", ""),
                    "AppKey" => input("AppKey", ""),
                );
                $result = $kdbird_model->setKdbirdConfig($data, 1, $this->site_id);
            }
            return $result;
        } else {

            $kd100_config = $kd100_model->getKd100Config($this->site_id);
            $kdbird_config = $kdbird_model->getKdbirdConfig($this->site_id);
            $traces = [
                [
                    'name' => 'kd100',
                    'title' => '快递100',
                    'is_use' => $kd100_config[ 'data' ][ 'is_use' ]
                ],
                [
                    'name' => 'kdbird',
                    'title' => '快递鸟',
                    'is_use' => $kdbird_config[ 'data' ][ 'is_use' ]
                ]
            ];
            $this->assign('traces_type', $traces);
            $this->assign('kd100_config', $kd100_config[ "data" ]);
            $this->assign('kdbird_config', $kdbird_config[ "data" ]);

            $this->forthMenu();
            return $this->fetch('express/trace');
        }

    }
}