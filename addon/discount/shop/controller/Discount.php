<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\discount\shop\controller;

use app\shop\controller\BaseShop;
use addon\discount\model\Discount as DiscountModel;

/**
 * 限时折扣控制器
 */
class Discount extends BaseShop
{
    /**
     * 添加活动
     */
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'discount_name' => input('discount_name', ''),
                'remark'        => input('remark', ''),
                'start_time'    => strtotime(input('start_time', '')),
                'end_time'      => strtotime(input('end_time', '')),
                'site_id'       => $this->site_id,
                'goods_data'    => input('goods_data', '')
            ];

            $discount_model = new DiscountModel();
            return $discount_model->addDiscount($data);
        } else {
            return $this->fetch("discount/add");
        }
    }

    /**
     * 编辑活动
     */
    public function edit()
    {
        $discount_model = new DiscountModel();
        if (request()->isAjax()) {
            $data = [
                'discount_name' => input('discount_name', ''),
                'remark'        => input('remark', ''),
                'start_time'    => strtotime(input('start_time', '')),
                'end_time'      => strtotime(input('end_time', '')),
                'discount_id'   => input('discount_id', 0),
                'goods_id'   => input('goods_id', 0),
                'site_id'       => $this->site_id,
                'sku_list'      => input('sku_list', ''),
            ];

            return $discount_model->editDiscount($data);

        } else {
            $discount_id = input('discount_id', 0);
            $this->assign('discount_id', $discount_id);

            $discount_info = $discount_model->getDiscountDetail($discount_id, $this->site_id);
            $this->assign('discount_info', $discount_info['data']);

            return $this->fetch("discount/edit");
        }

    }

    /**
     * 限时折扣详情
     */
    public function detail()
    {
        $discount_model = new DiscountModel();
        if (request()->isAjax()) {
            //活动商品
            $discount_id = input('discount_id', 0);
            $list        = $discount_model->getDiscountGoods($discount_id);
            foreach ($list['data'] as $key => $val) {
                if ($val['price'] != 0) {
                    $discount_rate = floor($val['discount_price'] / $val['price'] * 100);
                } else {
                    $discount_rate = 100;
                }
                $list['data'][$key]['discount_rate'] = $discount_rate;
            }
            return $list;
        } else {
            $discount_id = input('discount_id', 0);
            $site_id     = $this->site_id;
            $this->assign('discount_id', $discount_id);

            //活动详情
            $discount_info = $discount_model->getDiscountInfo($discount_id, $site_id);
            $this->assign('discount_info', $discount_info['data']);

            return $this->fetch("discount/detail");
        }
    }

    /**
     * 活动列表
     */
    public function lists()
    {
        $discount_model = new DiscountModel();
        if (request()->isAjax()) {
            $page          = input('page', 1);
            $page_size     = input('page_size', PAGE_LIST_ROWS);
            $goods_name    = input('goods_name', '');
            $status        = input('status', '');

            $condition = [];
            if ($status !== "") {
                $condition[] = ['d.status', '=', $status];
            }
            $condition[] = ['d.site_id', '=', $this->site_id];
            $condition[] = ['g.goods_name', 'like', '%' . $goods_name . '%'];
            $order       = 'd.create_time desc';
            $field       = 'd.*,g.goods_name,g.goods_image';

            $discount_status_arr = $discount_model->getDiscountStatus();

            $alias = 'd';
            $join = [
                ['goods g', 'd.goods_id = g.goods_id', 'inner']
            ];

            $res                 = $discount_model->getDiscountPageList($condition, $page, $page_size, $order, $field, $alias, $join);
            foreach ($res['data']['list'] as $key => $val) {
                $res['data']['list'][$key]['status_name'] = $discount_status_arr[$val['status']];
            }
            return $res;

        } else {
            //限时折扣状态
            $discount_status_arr = $discount_model->getDiscountStatus();
            $this->assign('discount_status_arr', $discount_status_arr);

            return $this->fetch("discount/lists");
        }
    }

    /**
     * 关闭活动
     */
    public function close()
    {
        if (request()->isAjax()) {
            $discount_id    = input('discount_id', 0);
            $discount_model = new DiscountModel();
            return $discount_model->closeDiscount($discount_id, $this->site_id);
        }
    }

    /**
     * 删除活动
     */
    public function delete()
    {
        if (request()->isAjax()) {
            $discount_id    = input('discount_id', 0);
            $discount_model = new DiscountModel();
            return $discount_model->deleteDiscount($discount_id, $this->site_id);
        }
    }



    /**
     * 获取商品列表
     * @return array
     */
    public function getSkuList()
    {
        if(request()->isAjax()){
            $discount_model = new DiscountModel();

            $discount_id = input('discount_id', '');

            $goods_list = $discount_model->getDiscountGoodsList($discount_id);
            return $goods_list;
        }
    }
}