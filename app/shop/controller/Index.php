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

use app\model\goods\Goods as GoodsModel;
use app\model\member\Member as MemberModel;
use app\model\system\Promotion as PrmotionModel;
use app\model\system\Stat;
use Carbon\Carbon;

class Index extends BaseShop
{

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $shop_info = $this->shop_info;
        $time = time();
        $this->assign('shop_status', 1);

        //基础统计信息
        $stat_shop_model = new Stat();
        $today = Carbon::now();
        $yesterday = Carbon::yesterday();
        $stat_today = $stat_shop_model->getStatShop($this->site_id, $today->year, $today->month, $today->day);
        $stat_yesterday = $stat_shop_model->getStatShop($this->site_id, $yesterday->year, $yesterday->month, $yesterday->day);
        $this->assign("stat_day", $stat_today[ 'data' ]);
        $this->assign("stat_yesterday", $stat_yesterday[ 'data' ]);
        $this->assign("today", $today);

        //获取总数
        $shop_stat_sum = $stat_shop_model->getShopStatSum($this->site_id);
        $goods_model = new GoodsModel();
        $goods_sum = $goods_model->getGoodsTotalCount([ [ 'site_id', '=', $this->site_id ], [ 'is_delete', '=', 0 ] ]);
        $shop_stat_sum[ 'data' ][ 'goods_count' ] = $goods_sum[ 'data' ];
        $this->assign('shop_stat_sum', $shop_stat_sum[ 'data' ]);

        //日同比
        $day_rate[ 'order_pay_count' ] = diff_rate($stat_today[ 'data' ][ 'order_pay_count' ], $stat_yesterday[ 'data' ][ 'order_pay_count' ]);
        $day_rate[ 'order_total' ] = diff_rate($stat_today[ 'data' ][ 'order_total' ], $stat_yesterday[ 'data' ][ 'order_total' ]);
        $day_rate[ 'collect_goods' ] = diff_rate($stat_today[ 'data' ][ 'collect_goods' ], $stat_yesterday[ 'data' ][ 'collect_goods' ]);
        $day_rate[ 'visit_count' ] = diff_rate($stat_today[ 'data' ][ 'visit_count' ], $stat_yesterday[ 'data' ][ 'visit_count' ]);
        $day_rate[ 'member_count' ] = diff_rate($stat_today[ 'data' ][ 'member_count' ], $stat_yesterday[ 'data' ][ 'member_count' ]);

        $this->assign('day_rate', $day_rate);

        //会员总数
        $member_model = new MemberModel();
        $member_count = $member_model->getMemberCount([ [ 'site_id', '=', $this->site_id ] ]);
        $this->assign('member_count', $member_count[ 'data' ]);

        //近十天的订单数以及销售金额
        $date_day = getweeks();
        $order_total = '';
        $order_pay_count = '';
        foreach ($date_day as $k => $day) {
            $dayarr = explode('-', $day);
            $stat_day[ $k ] = $stat_shop_model->getStatShop($this->site_id, $dayarr[ 0 ], $dayarr[ 1 ], $dayarr[ 2 ]);
            $order_total .= $stat_day[ $k ][ 'data' ][ 'order_total' ] . ',';
            $order_pay_count .= $stat_day[ $k ][ 'data' ][ 'order_pay_count' ] . ',';
        }
        $ten_day[ 'order_total' ] = explode(',', substr($order_total, 0, strlen($order_total) - 1));
        $ten_day[ 'order_pay_count' ] = explode(',', substr($order_pay_count, 0, strlen($order_pay_count) - 1));
        $this->assign('ten_day', $ten_day);

        //营销活动
        $promotion_model = new PrmotionModel();
        $promotions = $promotion_model->getSitePromotions($this->site_id);
        $toolcount = 0;
        $shopcount = 0;
        //营销插件数量
        foreach ($promotions as $k => $v) {
            if ($v[ "show_type" ] == 'tool') {
                $toolcount += 1;
            }
            if ($v[ "show_type" ] == 'member' || $v[ "show_type" ] == 'shop') {
                $shopcount += 1;
            }
        }
        $count = [
            'toolcount' => $toolcount,
            'shopcount' => $shopcount
        ];

        $this->assign("promotion", $promotions);
        $this->assign("count", $count);

        //分销插件是否存在
        $is_fenxiao = addon_is_exit('fenxiao', $this->site_id);
        $this->assign('is_fenxiao', $is_fenxiao);

        return $this->fetch("index/index");
    }

}