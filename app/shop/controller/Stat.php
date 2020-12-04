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

use app\model\system\Stat as StatModel;


/**
 * 数据统计
 * Class Stat
 * @package app\shop\controller
 */
class Stat extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 店铺统计
     * @return mixed
     */
    public function shop()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 0);

            if ($date_type == 0) {
                $start_time = strtotime("today");
                $time_range = date('Y-m-d', $start_time);
            } else if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            }

            $stat_model = new StatModel();

            $shop_stat_sum = $stat_model->getShopStatSum($this->site_id, $start_time);

            $shop_stat_sum['data']['time_range'] = $time_range;

            return $shop_stat_sum;
        } else {
            return $this->fetch("stat/shop");
        }
    }

    /**
     * 店铺统计报表
     * */
    public function getShopStatList()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 1);

            if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 6;
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 29;
            }

            $stat_model = new StatModel();

            $stat_list = $stat_model->getShopStatList($this->site_id, $start_time);

            //将时间戳作为列表的主键
            $shop_stat_list = array_column($stat_list['data'], null, 'day_time');

            $data = array();

            for ($i = 0; $i <= $day; $i++) {
                $time             = strtotime(date('Y-m-d', strtotime("-" . ($day - $i) . " day")));
                $data['time'][$i] = date('Y-m-d', $time);
                if (array_key_exists($time, $shop_stat_list)) {
                    $data['order_total'][$i]     = $shop_stat_list[$time]['order_total'];
                    $data['shipping_total'][$i]  = $shop_stat_list[$time]['shipping_total'];
                    $data['refund_total'][$i]    = $shop_stat_list[$time]['refund_total'];
                    $data['order_pay_count'][$i] = $shop_stat_list[$time]['order_pay_count'];
                    $data['goods_pay_count'][$i] = $shop_stat_list[$time]['goods_pay_count'];
                    $data['shop_money'][$i]      = $shop_stat_list[$time]['shop_money'];
                    $data['platform_money'][$i]  = $shop_stat_list[$time]['platform_money'];
                    $data['collect_shop'][$i]    = $shop_stat_list[$time]['collect_shop'];
                    $data['collect_goods'][$i]   = $shop_stat_list[$time]['collect_goods'];
                    $data['visit_count'][$i]     = $shop_stat_list[$time]['visit_count'];
                    $data['order_count'][$i]     = $shop_stat_list[$time]['order_count'];
                    $data['goods_count'][$i]     = $shop_stat_list[$time]['goods_count'];
                    $data['add_goods_count'][$i] = $shop_stat_list[$time]['add_goods_count'];
                    $data['member_count'][$i]    = $shop_stat_list[$time]['member_count'];
                } else {
                    $data['order_total'][$i]     = 0.00;
                    $data['shipping_total'][$i]  = 0.00;
                    $data['refund_total'][$i]    = 0.00;
                    $data['order_pay_count'][$i] = 0;
                    $data['goods_pay_count'][$i] = 0;
                    $data['shop_money'][$i]      = 0.00;
                    $data['platform_money'][$i]  = 0.00;
                    $data['collect_shop'][$i]    = 0;
                    $data['collect_goods'][$i]   = 0;
                    $data['visit_count'][$i]     = 0;
                    $data['order_count'][$i]     = 0;
                    $data['goods_count'][$i]     = 0;
                    $data['add_goods_count'][$i] = 0;
                    $data['member_count'][$i]    = 0;
                }
            }

            $data['time_range'] = $time_range;

            return $data;
        }
    }

    /**
     * 商品统计
     * @return mixed
     */
    public function goods()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 0);

            if ($date_type == 0) {
                $start_time = strtotime("today");
                $time_range = date('Y-m-d', $start_time);
            } else if ($date_type == 1) {
                $start_time = strtotime("-6 day");
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            } else if ($date_type == 2) {
                $start_time = strtotime("-29 day");
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            }

            $stat_model = new StatModel();

            $shop_stat_sum = $stat_model->getShopStatSum($this->site_id, $start_time);

            $shop_stat_sum['data']['time_range'] = $time_range;

            return $shop_stat_sum;
        } else {
            return $this->fetch("stat/goods");
        }
    }

    /**
     * 商品统计报表
     * */
    public function getGoodsStatList()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 1);

            if ($date_type == 1) {
                $start_time = strtotime("-6 day");
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 6;
            } else if ($date_type == 2) {
                $start_time = strtotime("-29 day");
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 29;
            }

            $stat_model = new StatModel();

            $stat_list = $stat_model->getShopStatList($this->site_id, $start_time);

            //将时间戳作为列表的主键
            $shop_stat_list = array_column($stat_list['data'], null, 'day_time');

            $data = array();

            for ($i = 0; $i <= $day; $i++) {
                $time             = strtotime(date('Y-m-d', strtotime("-" . ($day - $i) . " day")));
                $data['time'][$i] = date('Y-m-d', $time);
                if (array_key_exists($time, $shop_stat_list)) {
                    $data['order_total'][$i]     = $shop_stat_list[$time]['order_total'];
                    $data['shipping_total'][$i]  = $shop_stat_list[$time]['shipping_total'];
                    $data['refund_total'][$i]    = $shop_stat_list[$time]['refund_total'];
                    $data['order_pay_count'][$i] = $shop_stat_list[$time]['order_pay_count'];
                    $data['goods_pay_count'][$i] = $shop_stat_list[$time]['goods_pay_count'];
                    $data['shop_money'][$i]      = $shop_stat_list[$time]['shop_money'];
                    $data['platform_money'][$i]  = $shop_stat_list[$time]['platform_money'];
                    $data['collect_shop'][$i]    = $shop_stat_list[$time]['collect_shop'];
                    $data['collect_goods'][$i]   = $shop_stat_list[$time]['collect_goods'];
                    $data['visit_count'][$i]     = $shop_stat_list[$time]['visit_count'];
                    $data['order_count'][$i]     = $shop_stat_list[$time]['order_count'];
                    $data['goods_count'][$i]     = $shop_stat_list[$time]['goods_count'];
                    $data['add_goods_count'][$i] = $shop_stat_list[$time]['add_goods_count'];
                    $data['member_count'][$i]    = $shop_stat_list[$time]['member_count'];
                } else {
                    $data['order_total'][$i]     = 0.00;
                    $data['shipping_total'][$i]  = 0.00;
                    $data['refund_total'][$i]    = 0.00;
                    $data['order_pay_count'][$i] = 0;
                    $data['goods_pay_count'][$i] = 0;
                    $data['shop_money'][$i]      = 0.00;
                    $data['platform_money'][$i]  = 0.00;
                    $data['collect_shop'][$i]    = 0;
                    $data['collect_goods'][$i]   = 0;
                    $data['visit_count'][$i]     = 0;
                    $data['order_count'][$i]     = 0;
                    $data['goods_count'][$i]     = 0;
                    $data['add_goods_count'][$i] = 0;
                    $data['member_count'][$i]    = 0;
                }
            }

            $data['time_range'] = $time_range;

            return $data;
        }
    }

    /**
     * 交易统计
     * @return mixed
     */
    public function order()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 0);

            if ($date_type == 0) {
                $start_time = strtotime("today");
                $time_range = date('Y-m-d', $start_time);
            } else if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            }

            $stat_model = new StatModel();

            $shop_stat_sum = $stat_model->getShopStatSum($this->site_id, $start_time);

            $shop_stat_sum['data']['time_range'] = $time_range;

            return $shop_stat_sum;
        } else {
            return $this->fetch("stat/order");
        }
    }

    /**
     * 交易统计报表
     * */
    public function getOrderStatList()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 1);

            if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 6;
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 29;
            }

            $stat_model = new StatModel();

            $stat_list = $stat_model->getShopStatList($this->site_id, $start_time);

            //将时间戳作为列表的主键
            $shop_stat_list = array_column($stat_list['data'], null, 'day_time');

            $data = array();

            for ($i = 0; $i <= $day; $i++) {
                $time             = strtotime(date('Y-m-d', strtotime("-" . ($day - $i) . " day")));
                $data['time'][$i] = date('Y-m-d', $time);
                if (array_key_exists($time, $shop_stat_list)) {
                    $data['order_total'][$i]     = $shop_stat_list[$time]['order_total'];
                    $data['shipping_total'][$i]  = $shop_stat_list[$time]['shipping_total'];
                    $data['refund_total'][$i]    = $shop_stat_list[$time]['refund_total'];
                    $data['order_pay_count'][$i] = $shop_stat_list[$time]['order_pay_count'];
                    $data['goods_pay_count'][$i] = $shop_stat_list[$time]['goods_pay_count'];
                    $data['shop_money'][$i]      = $shop_stat_list[$time]['shop_money'];
                    $data['platform_money'][$i]  = $shop_stat_list[$time]['platform_money'];
                    $data['collect_shop'][$i]    = $shop_stat_list[$time]['collect_shop'];
                    $data['collect_goods'][$i]   = $shop_stat_list[$time]['collect_goods'];
                    $data['visit_count'][$i]     = $shop_stat_list[$time]['visit_count'];
                    $data['order_count'][$i]     = $shop_stat_list[$time]['order_count'];
                    $data['goods_count'][$i]     = $shop_stat_list[$time]['goods_count'];
                    $data['add_goods_count'][$i] = $shop_stat_list[$time]['add_goods_count'];
                } else {
                    $data['order_total'][$i]     = 0.00;
                    $data['shipping_total'][$i]  = 0.00;
                    $data['refund_total'][$i]    = 0.00;
                    $data['order_pay_count'][$i] = 0;
                    $data['goods_pay_count'][$i] = 0;
                    $data['shop_money'][$i]      = 0.00;
                    $data['platform_money'][$i]  = 0.00;
                    $data['collect_shop'][$i]    = 0;
                    $data['collect_goods'][$i]   = 0;
                    $data['visit_count'][$i]     = 0;
                    $data['order_count'][$i]     = 0;
                    $data['goods_count'][$i]     = 0;
                    $data['add_goods_count'][$i] = 0;
                }
            }

            $data['time_range'] = $time_range;

            return $data;
        }
    }

    /**
     * 访问统计
     * @return mixed
     */
    public function visit()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 0);

            if ($date_type == 0) {
                $start_time = strtotime("today");
                $time_range = date('Y-m-d', $start_time);
            } else if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
            }

            $stat_model = new StatModel();

            $shop_stat_sum = $stat_model->getShopStatSum($this->site_id, $start_time);

            $shop_stat_sum['data']['time_range'] = $time_range;

            return $shop_stat_sum;
        } else {
            return $this->fetch("stat/visit");
        }
    }

    /**
     * 访问统计报表
     * */
    public function getVisitStatList()
    {
        if (request()->isAjax()) {
            $date_type = input('date_type', 1);

            if ($date_type == 1) {
                $start_time = strtotime(date('Y-m-d', strtotime("-6 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 6;
            } else if ($date_type == 2) {
                $start_time = strtotime(date('Y-m-d', strtotime("-29 day")));
                $time_range = date('Y-m-d', $start_time) . ' 至 ' . date('Y-m-d', strtotime("today"));
                $day        = 29;
            }

            $stat_model = new StatModel();

            $stat_list = $stat_model->getShopStatList($this->site_id, $start_time);

            //将时间戳作为列表的主键
            $shop_stat_list = array_column($stat_list['data'], null, 'day_time');

            $data = array();

            for ($i = 0; $i <= $day; $i++) {
                $time             = strtotime(date('Y-m-d', strtotime("-" . ($day - $i) . " day")));
                $data['time'][$i] = date('Y-m-d', $time);
                if (array_key_exists($time, $shop_stat_list)) {
                    $data['order_total'][$i]     = $shop_stat_list[$time]['order_total'];
                    $data['shipping_total'][$i]  = $shop_stat_list[$time]['shipping_total'];
                    $data['refund_total'][$i]    = $shop_stat_list[$time]['refund_total'];
                    $data['order_pay_count'][$i] = $shop_stat_list[$time]['order_pay_count'];
                    $data['goods_pay_count'][$i] = $shop_stat_list[$time]['goods_pay_count'];
                    $data['shop_money'][$i]      = $shop_stat_list[$time]['shop_money'];
                    $data['platform_money'][$i]  = $shop_stat_list[$time]['platform_money'];
                    $data['collect_shop'][$i]    = $shop_stat_list[$time]['collect_shop'];
                    $data['collect_goods'][$i]   = $shop_stat_list[$time]['collect_goods'];
                    $data['visit_count'][$i]     = $shop_stat_list[$time]['visit_count'];
                    $data['order_count'][$i]     = $shop_stat_list[$time]['order_count'];
                    $data['goods_count'][$i]     = $shop_stat_list[$time]['goods_count'];
                    $data['add_goods_count'][$i] = $shop_stat_list[$time]['add_goods_count'];
                } else {
                    $data['order_total'][$i]     = 0.00;
                    $data['shipping_total'][$i]  = 0.00;
                    $data['refund_total'][$i]    = 0.00;
                    $data['order_pay_count'][$i] = 0;
                    $data['goods_pay_count'][$i] = 0;
                    $data['shop_money'][$i]      = 0.00;
                    $data['platform_money'][$i]  = 0.00;
                    $data['collect_shop'][$i]    = 0;
                    $data['collect_goods'][$i]   = 0;
                    $data['visit_count'][$i]     = 0;
                    $data['order_count'][$i]     = 0;
                    $data['goods_count'][$i]     = 0;
                    $data['add_goods_count'][$i] = 0;
                }
            }

            $data['time_range'] = $time_range;

            return $data;
        }
    }
}