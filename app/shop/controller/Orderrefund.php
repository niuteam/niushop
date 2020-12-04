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

use app\model\order\OrderCommon;
use app\model\order\OrderRefund as OrderRefundModel;
use app\model\order\OrderExport;
use app\model\member\Member;

/**
 * 订单维权
 * Class Orderrefund
 * @package app\shop\controller
 */
class Orderrefund extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 维权订单列表
     * @return mixed
     */
    public function lists()
    {

        $refund_status   = input("refund_status", "");//退款状态
        $sku_name        = input("sku_name", '');//商品名称
        $refund_type     = input("refund_type", '');//退款方式
        $start_time      = input("start_time", '');//开始时间
        $end_time        = input("end_time", '');//结束时间
        $order_no        = input("order_no", '');//订单编号
        $delivery_status = input("delivery_status", '');//物流状态
        $refund_no       = input("refund_no", '');//退款编号

        $delivery_no        = input("delivery_no", '');//物流编号
        $refund_delivery_no = input("refund_delivery_no", '');//退款物流编号
        $order_refund_model = new OrderRefundModel();
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size  = input('page_size', PAGE_LIST_ROWS);
            $condition  = [
                ["nop.site_id", "=", $this->site_id]
            ];
            //退款状态
            if ($refund_status != "") {
                $condition[] = ["nop.refund_status", "=", $refund_status];
            } else {
                $condition[] = ["nop.refund_status", "<>", 0];
            }
            //物流状态
            if ($delivery_status != "") {
                $condition[] = ["nop.delivery_status", "=", $delivery_status];
            }
            //商品名称
            if ($sku_name != "") {
                $condition[] = ["nop.sku_name", "like", "%$sku_name%"];
            }
            //退款方式
            if ($refund_type != "") {
                $condition[] = ["nop.refund_type", "=", $refund_type];
            }
            //退款编号
            if ($refund_no != "") {
                $condition[] = ["nop.refund_no", "like", "%$refund_no%"];
            }
            //订单编号
            if ($order_no != "") {
                $condition[] = ["nop.order_no", "like", "%$order_no%"];
            }
            //物流编号
            if ($delivery_no != "") {
                $condition[] = ["nop.delivery_no", "like", "%$delivery_no%"];
            }
            //退款物流编号
            if ($refund_delivery_no != "") {
                $condition[] = ["nop.refund_delivery_no", "like", "%$refund_delivery_no%"];
            }

            if (!empty($start_time) && empty($end_time)) {
                $condition[] = ["nop.refund_action_time", ">=", date_to_time($start_time)];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = ["nop.refund_action_time", "<=", date_to_time($end_time)];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = ['nop.refund_action_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
            }
            $list = $order_refund_model->getRefundOrderGoodsPageList($condition, $page_index, $page_size, "nop.refund_action_time desc");
            return $list;
        } else {
            $refund_status_list = $order_refund_model->order_refund_status;
            $this->assign("refund_status_list", $refund_status_list);//退款状态
            $this->assign("refund_type_list", $order_refund_model->refund_type);//退款方式
            return $this->fetch("orderrefund/lists");
        }
    }

    /**
     * 维权订单详情
     * @return mixed
     */
    public function detail()
    {
        $order_goods_id = input("order_goods_id", 0);
        //维权订单项信息
        $order_refund_model = new OrderRefundModel();
        $detail_result      = $order_refund_model->getRefundDetail($order_goods_id);
        $detail             = $detail_result["data"];
        if (empty($detail))
            $this->error("操作失败!请重试");

        $order_common_model = new OrderCommon();
        $order_info_result  = $order_common_model->getOrderInfo([["order_id", "=", $detail["order_id"]]]);
        $order_info         = $order_info_result["data"];
        if (empty($order_info))
            $this->error("操作失败!请重试");

        //添加会员昵称
        $member = new Member();
        $member_info = $member->getMemberInfo([ ["member_id",'=', $order_info['member_id']] ],'nickname');
        $order_info['nickname'] = $member_info['data']['nickname'];
        $this->assign("detail", $detail);
        $this->assign("order_info", $order_info);
        return $this->fetch("orderrefund/detail");
    }

    /**
     * 维权拒绝
     * @return mixed
     */
    public function refuse()
    {
        $order_goods_id       = input("order_goods_id", 0);
        $refund_refuse_reason = input("refund_refuse_reason", '');
        $order_refund_model   = new OrderRefundModel();
        $data                 = array(
            "order_goods_id"       => $order_goods_id,
            "refund_refuse_reason" => $refund_refuse_reason
        );
        $res                  = $order_refund_model->orderRefundRefuse($data, $this->user_info, $refund_refuse_reason);
        return $res;
    }

    /**
     * 维权同意
     * @return mixed
     */
    public function agree()
    {
        $order_goods_id     = input("order_goods_id", 0);
        $order_refund_model = new OrderRefundModel();
        $data               = array(
            "order_goods_id" => $order_goods_id
        );
        $res                = $order_refund_model->orderRefundConfirm($data, $this->user_info);
        return $res;
    }

    /**
     * 维权收货
     * @return mixed
     */
    public function receive()
    {
        $order_goods_id  = input("order_goods_id", 0);
        $is_refund_stock = input("is_refund_stock", 0);//是否入库

        $order_refund_model = new OrderRefundModel();
        $data               = array(
            "order_goods_id"  => $order_goods_id,
            "is_refund_stock" => $is_refund_stock
        );
        $res                = $order_refund_model->orderRefundTakeDelivery($data, $this->user_info);
        return $res;
    }

    /**
     * 维权通过
     * @return mixed
     */
    public function complete()
    {
        $order_goods_id     = input("order_goods_id", 0);
        $order_refund_model = new OrderRefundModel();
        $data               = array(
            "order_goods_id" => $order_goods_id
        );
        $res                = $order_refund_model->orderRefundFinish($data, $this->user_info);
        return $res;
    }


    /**
     * 订单导出（维权订单）
     */
    public function exportRefundOrder()
    {
        $refund_status = input("refund_status", "");//退款状态
        $sku_name = input("sku_name", '');//商品名称
        $refund_type = input("refund_type", '');//退款方式
        $start_time = input("start_time", '');//开始时间
        $end_time = input("end_time", '');//结束时间
        $order_no = input("order_no", '');//订单编号
        $delivery_status = input("delivery_status", '');//物流状态
        $refund_no = input("refund_no", '');//退款编号

        $order_refund_model = new OrderRefundModel();
        $delivery_no = input("delivery_no", '');//物流编号
        $refund_delivery_no = input("refund_delivery_no", '');//退款物流编号
        $condition_desc = [];

        $condition[] = ['og.site_id', '=', $this->site_id];
        //退款状态
        $refund_status_list = $order_refund_model->order_refund_status;
        $refund_status_name = '全部';
        if ($refund_status != "") {
            $condition[] = ["og.refund_status", "=", $refund_status];
            $refund_status_name = $refund_status_list[$refund_status]['name'] ?? '';
        } else {
            $condition[] = ["og.refund_status", "<>", 0];
        }
        $condition_desc[] = ['name' => '维权状态', 'value' => $refund_status_name];

        //物流状态
        if ($delivery_status != "") {
            $condition[] = ["og.delivery_status", "=", $delivery_status];
        }

        //商品名称
        $sku_name_value = '';
        if ($sku_name != "") {
            $condition[] = ["og.sku_name", "like", "%$sku_name%"];
            $sku_name_value = $sku_name;
        }
        $condition_desc[] = ['name' => '商品名称', 'value' => $sku_name_value];

        //退款方式
        $refund_type_name = '全部';
        if ($refund_type != "") {
            $condition[] = ["og.refund_type", "=", $refund_type];
            $refund_type_name = $order_refund_model->refund_type[$refund_type];
        }
        $condition_desc[] = ['name' => '退款方式', 'value' => $refund_type_name];

        //退款编号
        if ($refund_no != "") {
            $condition[] = ["og.refund_no", "like", "%$refund_no%"];
        }
        $condition_desc[] = ['name' => '退款编号', 'value' => $refund_no];

        //订单编号
        if ($order_no != "") {
            $condition[] = ["og.order_no", "like", "%$order_no%"];
        }
        $condition_desc[] = ['name' => '订单编号', 'value' => $order_no];

        //物流编号
        if ($delivery_no != "") {
            $condition[] = ["og.delivery_no", "like", "%$delivery_no%"];
        }
        //退款物流编号
        if ($refund_delivery_no != "") {
            $condition[] = ["og.refund_delivery_no", "like", "%$refund_delivery_no%"];
        }
        $time_name = '';
        if (!empty($start_time) && empty($end_time)) {
            $condition[] = ["og.refund_action_time", ">=", date_to_time($start_time)];
            $time_name = $start_time . '起';
        } elseif (empty($start_time) && !empty($end_time)) {
            $condition[] = ["og.refund_action_time", "<=", date_to_time($end_time)];
            $time_name = '至' . $end_time;
        } elseif (!empty($start_time) && !empty($end_time)) {
            $condition[] = ['og.refund_action_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
            $time_name = $start_time . ' 至 ' . $end_time;
        }
        $condition_desc[] = ['name' => '申请时间', 'value' => $time_name];

        $order_export_model = new OrderExport();
        $result = $order_export_model->orderRefundExport($condition, $condition_desc, $this->site_id);
        dump($result);die;
        return $result;
    }

    /**
     * 订单导出记录
     * @return mixed
     */
    public function export()
    {
        if (request()->isAjax()) {
            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $export_model = new OrderExport();
            $condition = array(
                ['site_id', '=', $this->site_id]
            );
            $result = $export_model->getRefundExportPageList($condition, $page_index, $page_size, 'create_time desc', '*');
            return $result;
        } else {
            return $this->fetch("orderrefund/export");

        }
    }

    /**
     * 删除订单导出记录
     */
    public function deleteExport(){

        if (request()->isAjax()) {
            $export_ids = input('export_ids', '');

            $export_model = new OrderExport();
            $condition = array (
                [ 'site_id', '=', $this->site_id ],
                ['export_id', 'in', (string)$export_ids]
            );
            $result = $export_model->deleteRefundExport($condition);
            return $result;
        }
    }

    /**
     * 关闭维权
     * @return \app\model\order\multitype
     */
    public function close(){
        if (request()->isAjax()) {
            $order_goods_id     = input("order_goods_id", 0);
            $order_refund_model = new OrderRefundModel();
            $res = $order_refund_model->orderRefundClose($order_goods_id, $this->site_id, $this->user_info);
            return $res;
        }
    }
}