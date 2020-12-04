<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace app\shop\controller;

use app\model\order\OrderImportFile as OrderImportFileModel;

use app\model\order\OrderCommon as OrderCommonModel;
use app\model\order\Order as OrderModel;
use addon\electronicsheet\model\ExpressElectronicsheet as ExpressElectronicsheetModel;
use app\model\express\ExpressCompany;
use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;

/**
 * 配送
 * Class Express
 * @package app\shop\controller
 */
class Orderimportfile extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }


    /**
     * 批量发货（订单导入）
     * @return array|mixed
     */
    public function lists()
    {
        //电子面单插件
        $addon_is_exit = addon_is_exit('electronicsheet', $this->site_id);

        if(request()->isAjax()){
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $model = new OrderImportFileModel();
            $list = $model->getOrderImportFilePageList([['site_id','=',$this->site_id]],$page_index,$page_size);
            return $list;
        }
        $this->assign('addon_is_exit',$addon_is_exit);
        return $this->fetch('orderimportfile/lists');
    }

    /**
     * 导出待发货订单
     */
    public function exportDeliveryOrder()
    {
        //电子面单插件
        $addon_is_exit = addon_is_exit('electronicsheet', $this->site_id);

        $order_model = new OrderModel();
        $order_status_list = $order_model->delivery_order_status;

        $condition = [
            ['order_status', 'in', array_keys($order_status_list)],
            ['order_type', '=', 1],
            ['site_id', '=', $this->site_id],
            ['is_delete', '=', 0]
        ];

        $order_common_model = new OrderCommonModel();
        $field = 'order_no,order_name';
        $list_result = $order_common_model->getOrderList($condition, $field, 'create_time desc');
        $list = $list_result['data'];

        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("待发货订单");
        $phpExcel->getProperties()->setSubject("待发货订单");
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);
        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(48);

        $phpExcel->getActiveSheet()->setCellValue('A1', '订单编号');
        $phpExcel->getActiveSheet()->setCellValue('B1', '订单内容');
        if($addon_is_exit == 1){
            $phpExcel->getActiveSheet()->setCellValue('C1', '发货方式（手动发货/电子面单）');
            $phpExcel->getActiveSheet()->setCellValue('D1', '物流公司名称（电子面单发货时为面单模板名称）');
            $phpExcel->getActiveSheet()->setCellValue('E1', '物流单号（手动发货无需物流和电子面单时为空）');
        }else{
            $phpExcel->getActiveSheet()->setCellValue('C1', '发货方式');
            $phpExcel->getActiveSheet()->setCellValue('D1', '物流公司名称');
            $phpExcel->getActiveSheet()->setCellValue('E1', '物流单号（无需物流时为空）');
        }

        foreach($list as $k=>$v){
            $start = $k + 2;
            $phpExcel->getActiveSheet()->setCellValue('A'. $start, $v['order_no'].' ');
            $phpExcel->getActiveSheet()->setCellValue('B'. $start, $v['order_name']."\t");
            $phpExcel->getActiveSheet()->setCellValue('C'. $start, ' ');
            $phpExcel->getActiveSheet()->setCellValue('D'. $start, '');
            $phpExcel->getActiveSheet()->setCellValue('E'. $start, '');
        }

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('待发货订单');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file = date('Y年m月d日-待发货订单', time()) . '.xlsx';
        $objWriter->save($file);

        header("Content-type:application/octet-stream");

        $filename = basename($file);
        header("Content-Disposition:attachment;filename = " . $filename);
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        readfile($file);
        unlink($file);
        exit;
    }

    /**
     * 导出物流公司和电子面单模板
     */
    public function exportExpressTemplate()
    {
        //电子面单插件
        $addon_is_exit = addon_is_exit('electronicsheet', $this->site_id);

        $express_company_model = new ExpressCompany();
        //店铺物流公司
        $result = $express_company_model->getExpressCompanyList([["site_id", "=", $this->site_id]]);
        $list = $result['data'];

        // 实例化excel
        $phpExcel = new \PHPExcel();

        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $phpExcel->getActiveSheet()->setCellValue('A1', '物流公司');
        $phpExcel->getActiveSheet()->setCellValue('B1', '物流公司编码');

        foreach($list as $k=>$v){
            $start = $k + 2;
            $phpExcel->getActiveSheet()->setCellValue('A'. $start, $v['company_name']."\t");
            $phpExcel->getActiveSheet()->setCellValue('B'. $start, $v['express_no']);
        }

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('物流公司');

        if($addon_is_exit == 1){
            //获取电子面单模板
            $electronicsheet_model = new ExpressElectronicsheetModel();
            $condition[] = ['site_id', '=', $this->site_id];
            $field = 'id,template_name,company_name';
            $electronicsheet_list_result = $electronicsheet_model->getExpressElectronicsheetList($condition, $field, 'is_default desc');
            $electronicsheet_list = $electronicsheet_list_result['data'];

            $phpExcel->createSheet();
            $phpExcel->setActivesheetindex(1);

            $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);

            $phpExcel->getActiveSheet()->setCellValue('A1', '电子面单模板名称');
            $phpExcel->getActiveSheet()->setCellValue('B1', '物流公司');
            foreach($electronicsheet_list as $k=>$v){
                $start = $k + 2;
                $phpExcel->getActiveSheet()->setCellValue('A'. $start, $v['template_name']."\t");
                $phpExcel->getActiveSheet()->setCellValue('B'. $start, $v['company_name']."\t");
            }

            $phpExcel->getActiveSheet()->setTitle('电子面单');
        }

        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);

        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        if($addon_is_exit == 1){
            $file = date('Y年m月d日-物流公司和电子面单对照表', time()) . '.xlsx';
        }else{
            $file = date('Y年m月d日-物流公司对照表', time()) . '.xlsx';
        }

        $objWriter->save($file);

        header("Content-type:application/octet-stream");

        $filename = basename($file);
        header("Content-Disposition:attachment;filename = " . $filename);
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        readfile($file);
        unlink($file);
        exit;
    }


    /**
     *  导入订单发货
     */
    public function importOrder()
    {
        if(request()->isAjax()){
            $filename = input('filename','');
            $path = input('path','');

            $order_model = new OrderModel();
            $res = $order_model->orderFileDelivery(['filename' => $filename,'path' => $path],$this->site_id);
            return $res;
        }
    }

    /**
     * 删除导入的订单文件记录
     */
    public function delete()
    {
        if(request()->isAjax()){

            $id = input('id','');

            $model = new OrderimportfileModel();
            $res = $model -> deleteOrderImportFile($id,$this->site_id);
            return $res;
        }
    }

    /**
     * 导入记录
     * @return array|mixed
     */
    public function detail()
    {
        $model = new OrderImportFileModel();

        $file_id = input('file_id',0);
        if(request()->isAjax()){
            $condition = [
                ['oif.site_id','=',$this->site_id],
                ['oif.file_id','=',$file_id]
            ];

            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $status = input('status','');
            if($status !== ''){
                $condition[] = ['oif.status','=',$status];
            }

            $field = 'oif.*, o.order_id';
            $alias = 'oif';
            $join = [
                ['order o','oif.order_no = o.order_no','left']
            ];

            $list = $model->getOrderImportFilePageLogList($condition,$page_index,$page_size, 'oif.id desc', $field, $alias, $join);
            return $list;
        }
        $this->assign('file_id',$file_id);

        $info = $model->getOrderImportFileInfo([['id','=',$file_id],['site_id','=',$this->site_id]]);
        $this->assign('info',$info['data']);
        return $this->fetch('orderimportfile/detail');
    }

}