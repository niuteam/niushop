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

use app\model\express\Config as ConfigModel;
use app\model\express\ExpressPackage;
use app\model\order\OrderCommon as OrderCommonModel;
use app\model\order\Order as OrderModel;
use addon\electronicsheet\model\ExpressElectronicsheet as ExpressElectronicsheetModel;
use think\facade\Config;
use addon\electronicsheet\model\ElectronicsheetDelivery;
use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;

/**
 * 配送
 * Class Express
 * @package app\shop\controller
 */
class Delivery extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 发货列表
     */
    public function lists()
    {
        $order_label_list = array (
            'order_no' => '订单号',
            'out_trade_no' => '外部单号',
            'name' => '收货人姓名',
            'order_name' => '商品名称',
        );
        $order_model = new OrderModel();

        $order_status_list = $order_model->delivery_order_status;
        $order_status = input('order_status', '');//订单状态
        $order_name = input('order_name', '');
        $pay_type = input('pay_type', '');
        $order_from = input('order_from', '');
        $start_time = input('start_time', '');
        $end_time = input('end_time', '');
        $order_label = !empty($order_label_list[ input('order_label') ]) ? input('order_label') : '';
        $search_text = input('search', '');
        $promotion_type = input('promotion_type', '');//订单类型
        $order_type = input('order_type', 'all');//营销类型
        $order_common_model = new OrderCommonModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition = [
                [ 'order_type', '=', 1 ],
                [ 'site_id', '=', $this->site_id ],
                [ 'is_delete', '=', 0 ]
            ];
            //订单状态
            if ($order_status != "") {
                $condition[] = [ "order_status", "=", $order_status ];
            } else {
                $condition[] = [ 'order_status', 'in', array_keys($order_status_list) ];
            }
            //订单内容 模糊查询
            if ($order_name != "") {
                $condition[] = [ "order_name", 'like', "%$order_name%" ];
            }
            //订单来源
            if ($order_from != "") {
                $condition[] = [ "order_from", "=", $order_from ];
            }
            //订单支付
            if ($pay_type != "") {
                $condition[] = [ "pay_type", "=", $pay_type ];
            }
            //订单类型
            if ($order_type != 'all') {
                $condition[] = [ "order_type", "=", $order_type ];
            }
            //营销类型
            if ($promotion_type != "") {
                if ($promotion_type == 'empty') {
                    $condition[] = [ "promotion_type", "=", '' ];
                } else {
                    $condition[] = [ "promotion_type", "=", $promotion_type ];
                }
            }
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = [ "create_time", ">=", date_to_time($start_time) ];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = [ "create_time", "<=", date_to_time($end_time) ];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = [ 'create_time', 'between', [ date_to_time($start_time), date_to_time($end_time) ] ];
            }
            if ($search_text != "") {
                $condition[] = [ $order_label, 'like', "%$search_text%" ];
            }
            $list = $order_common_model->getOrderPageList($condition, $page_index, $page_size, 'create_time desc');
            return $list;
        } else {

            $this->assign('order_label_list', $order_label_list);

            //订单来源 (支持端口)
            $order_from = Config::get('app_type');
            $this->assign('order_from_list', $order_from);

            $pay_type = $order_common_model->getPayType();
            $this->assign('pay_type_list', $pay_type);

            $this->assign('http_type', get_http_type());


            $this->assign('delivery_order_status', $order_status_list);//订单状态

            return $this->fetch('delivery/lists');
        }
    }

    /**
     * 配送方式
     */
    public function express()
    {
        $config_model = new ConfigModel();
        $config_result = $config_model->getExpressConfig($this->site_id);
        $express_config = $config_result[ 'data' ];
        $this->assign('express_config', $express_config);
        $config_result = $config_model->getStoreConfig($this->site_id);
        $store_config = $config_result[ 'data' ];
        $this->assign('store_config', $store_config);
        $config_result = $config_model->getLocalDeliveryConfig($this->site_id);
        $local_delivery_config = $config_result[ 'data' ];
        $this->assign('local_delivery_config', $local_delivery_config);
        return $this->fetch('delivery/delivery');
    }

    /**
     * 物流开关配置
     * @return \multitype
     */
    public function modifyExpressStatus()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $is_use = input('is_use', 0);
            $data = array ();
            $result = $config_model->setExpressConfig($data, $is_use, $this->site_id);
            return $result;
        }
    }

    /**
     * 自提配置开关
     * @return \multitype
     */
    public function modifyStoreStatus()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $is_use = input('is_use', 0);
            $data = array ();
            $result = $config_model->setStoreConfig($data, $is_use, $this->site_id);
            return $result;
        }
    }

    /**
     * 外卖配送配置开关
     * @return \multitype
     */
    public function modifyLocalStatus()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $is_use = input('is_use', 0);
            $data = array ();
            $result = $config_model->setLocalDeliveryConfig($data, $is_use, $this->site_id);
            return $result;
        }
    }

    /**
     * 外卖配送
     */
    public function localConfig()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $is_use = input('is_use', 0);
            $data = array ();
            $result = $config_model->setLocalDeliveryConfig($data, $is_use, $this->site_id);
            return $result;
        } else {
            $config_result = $config_model->getLocalDeliveryConfig($this->site_id);
            $config = $config_result[ 'data' ];
            $this->assign('config', $config);
            return $this->fetch('delivery/local_config');
        }
    }


    /**
     * 获取电子面单模板列表
     */
    public function getExpressElectronicsheetList()
    {
        //电子面单插件
        $addon_is_exit = addon_is_exit('electronicsheet', $this->site_id);
        if ($addon_is_exit == 1) {

            //获取电子面单模板
            $electronicsheet_model = new ExpressElectronicsheetModel();
            $condition[] = [ 'site_id', '=', $this->site_id ];

            $electronicsheet_list = $electronicsheet_model->getExpressElectronicsheetList($condition, '', 'is_default desc');
            return $electronicsheet_list;

        } else {
            return success(0, 'success', []);
        }
    }


    /**
     * 批量发货
     */
    public function batchDelivery()
    {
        if (request()->isAjax()) {

            $order_model = new OrderModel();
            $data = array (
                'type' => input('type', 'manual'),//发货方式（手动发货、电子面单）
                'express_company_id' => input('express_company_id', 0),//物流公司
                'delivery_type' => input('delivery_type', 0),//是否需要物流
                'site_id' => $this->site_id,
                'template_id' => input('template_id', 0),//电子面单模板id
            );

            $order_list = input('order_list', '');

            $result = $order_model->orderBatchDelivery($data, $order_list);
            return $result;
        }
    }


    /**
     * 打印电子面单
     */
    public function printElectronicsheet()
    {
        if (request()->isAjax()) {

            $addon_is_exit = addon_is_exit('electronicsheet', $this->site_id);
            if ($addon_is_exit != 1) {
                return [
                    'code' => -1001,
                    'message' => '电子面单插件不存在',
                    'data' => ''
                ];
            }

            $order_model = new OrderModel();
            $data = array (
                'type' => 'electronicsheet',//电子面单
                'express_company_id' => 0,//物流公司
                'delivery_type' => 1,
                'site_id' => $this->site_id,
                'template_id' => input('template_id', 0),//电子面单模板id
                'is_delivery' => input('is_delivery', 0),//是否发货
                'order_id' => input('order_id'),//订单id
                'order_goods_ids' => '',
                'delivery_no' => ''
            );

            $electronicsheet_model = new ElectronicsheetDelivery();
            $result = $electronicsheet_model->delivery($data);
            if ($result[ 'code' ] >= 0) {

                if ($data[ 'is_delivery' ] == 1) {//发货

                    $data[ 'delivery_no' ] = $result[ 'data' ][ 'Order' ][ 'LogisticCode' ];

                    $res = $order_model->orderGoodsDelivery($data, 2);
                    if ($res[ 'code' ] < 0) {
                        return $res;
                    }
                }
            }
            return $result;
        }
    }


    /**
     * 获取单个订单的物流信息（电子面单的除外）
     */
    public function getOrderDelivery()
    {
        if (request()->isAjax()) {

            $order_id = input('order_id', '');

            $condition = [
                [ 'order_id', '=', $order_id ],
                [ 'site_id', '=', $this->site_id ],
                [ 'type', '=', 'manual' ]
            ];

            $express_package_model = new ExpressPackage();

            $list = $express_package_model->getExpressDeliveryPackageList($condition);
            return $list;
        }
    }

    /**
     * 修改单个订单的物流信息（电子面单的除外）
     */
    public function editOrderDelivery()
    {
        if (request()->isAjax()) {

            $delivery_json = array (
                'site_id' => $this->site_id,
                'order_id' => input('order_id', ''),//订单id
                'package_id' => input('package_id', 0),//包裹id
                'delivery_type' => input('delivery_type', 0),//是否需要物流
                'express_company_id' => input('express_company_id', 0),//物流公司
                'delivery_no' => input('delivery_no', ''),//物流单号
            );
            $express_package_model = new ExpressPackage();
            $res = $express_package_model->editOrderExpressDeliveryPackage($delivery_json);
            return $res;
        }
    }


}