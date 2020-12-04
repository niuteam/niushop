<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\bundling\shop\controller;

use app\shop\controller\BaseShop;
use addon\bundling\model\Bundling as BundlingModel;

/**
 * 优惠套餐
 * @author Administrator
 *
 */
class Bundling extends BaseShop
{
    /**
     * 添加优惠套餐
     */
    public function add()
    {
        if (request()->isAjax()) {
            $data           = [
                'site_id'           => $this->site_id,
                'bl_name'           => input('bl_name', ''),//组合名称
                'bl_price'          => input('bl_price', ''),//商品组合价格
                'shipping_fee_type' => input('shipping_fee_type', ''),//运费承担方式 1卖家承担运费 2买家承担运费
                'status'            => input('status', ''),//是否上下架
            ];
            $sku_ids        = input("sku_ids", "");
            $bundling_model = new BundlingModel();
            $res            = $bundling_model->addBundling($data, $sku_ids);
            return $res;
        } else {
            return $this->fetch("bundling/add");
        }
    }

    /**
     * 编辑优惠套餐
     */
    public function edit()
    {
        $bl_id          = input('bl_id', 0);
        $bundling_model = new BundlingModel();
        if (request()->isAjax()) {
            $data      = [
                'bl_name'           => input('bl_name', ''),//组合名称
                'bl_price'          => input('bl_price', ''),//商品组合价格
                'shipping_fee_type' => input('shipping_fee_type', ''),//运费承担方式 1卖家承担运费 2买家承担运费
                'status'            => input('status', ''),//最大领取数量
            ];
            $sku_ids   = input("sku_ids", "");
            $condition = array(
                ["bl_id", "=", $bl_id],
                ["site_id", "=", $this->site_id]
            );
            $res       = $bundling_model->editBundling($data, $sku_ids, $condition);
            return $res;
        } else {
            $condition   = [['bl_id', '=', $bl_id], ['site_id', '=', $this->site_id]];
            $info_result = $bundling_model->getBundlingDetail($condition);
            $info        = $info_result["data"];
            $this->assign("info", $info);
            $this->assign("bl_id", $bl_id);
            return $this->fetch("bundling/edit");
        }
    }

    /**
     * 优惠套餐详情
     */
    public function detail()
    {
        $bundling_id    = input('bl_id', '');
        $bundling_model = new BundlingModel();
        $condition      = [['bl_id', '=', $bundling_id], ['site_id', '=', $this->site_id]];
        $info           = $bundling_model->getBundlingDetail($condition);
        $this->assign('info', $info);
        return $this->fetch("bundling/detail");
    }

    /**
     * 优惠套餐列表
     */
    public function lists()
    {
        if (request()->isAjax()) {
            $page      = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $bl_name   = input('bl_name', '');
            $status    = input('status', '');

            $condition = [];
            if ($status !== '') {
                $condition[] = ['status', '=', $status];
            }
            $condition[] = ['site_id', '=', $this->site_id];
            $condition[] = ['bl_name', 'like', '%' . $bl_name . '%'];
            $order       = 'update_time desc';
            $field       = '*';

            $bundling_model = new BundlingModel();
            $res            = $bundling_model->getBundlingPageList($condition, $page, $page_size, $order, $field);
            return $res;
        } else {
            return $this->fetch("bundling/lists");
        }
    }

    /**
     * 删除优惠套餐
     */
    public function delete()
    {
        if (request()->isAjax()) {
            $bl_id          = input('bl_id', 0);
            $bundling_model = new BundlingModel();
            $res            = $bundling_model->deleteBundling($bl_id, $this->site_id);
            return $res;
        }
    }

}