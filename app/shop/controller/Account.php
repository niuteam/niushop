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

use app\model\web\Account as AccountModel;

use addon\fenxiao\model\FenxiaoData;
use app\model\order\Order as OrderModel;
use app\model\order\OrderCommon as OrderCommonModel;

class Account extends BaseShop
{

    public function dashboard()
    {
        $account_model = new AccountModel();
        //会员余额
        $member_balance_sum = $account_model->getMemberBalanceSum($this->site_id);
        $is_memberwithdraw  = addon_is_exit('memberwithdraw', $this->site_id);
        $this->assign('is_memberwithdraw', $is_memberwithdraw);
        if ($is_memberwithdraw == 1) {
            $this->assign('member_balance_sum', $member_balance_sum['data']);
        } else {
            $member_balance = number_format($member_balance_sum['data']['balance'] + $member_balance_sum['data']['balance_money'], 2, '.', '');
            $this->assign('member_balance', $member_balance);
        }

        //获取分销商账户统计
        $is_addon_fenxiao = addon_is_exit('fenxiao', $this->site_id);
        $this->assign('is_addon_fenxiao', $is_addon_fenxiao);
        if ($is_addon_fenxiao == 1) {
            $fenxiao_data_model = new FenxiaoData();
            $account_data       = $fenxiao_data_model->getFenxiaoAccountData($this->site_id);

            $this->assign('account_data', $account_data);
            //累计佣金
            $fenxiao_account = number_format($account_data['account'] + $account_data['account_withdraw'], 2, '.', '');
            $this->assign('fenxiao_account', $fenxiao_account);
            //分销订单总金额
            $fenxiao_order_money = $fenxiao_data_model->getFenxiaoOrderSum($this->site_id);
            $this->assign('fenxiao_order_money', $fenxiao_order_money);
        }

        $order_model = new OrderModel();
        //获取订单总额
        $order_total_money = $order_model->getOrderMoneySum(
            [
                ['site_id', '=', $this->site_id],
                ['order_status', '>', 0]
            ], 'order_money');
        $this->assign('order_total_money', number_format($order_total_money['data'], 2, '.', ''));
        //获取订单退款金额
        $refund_total_money = $order_model->getOrderMoneySum(
            [
                ['site_id', '=', $this->site_id],
//				[ 'refund_status', '<>', 0 ],
            ], 'refund_money');
        $this->assign('refund_total_money', number_format($refund_total_money['data'], 2, '.', ''));

        $common_model = new OrderCommonModel();
        //获取订单总数
        $order_total_count = $common_model->getOrderCount(
            [
                ['site_id', '=', $this->site_id],
                ['order_status', '>', 0]
            ]
        );
        $this->assign('order_total_count', $order_total_count['data']);

        //获取退款订单总数
        $refund_total_count = $common_model->getOrderCount(
            [
                ['site_id', '=', $this->site_id],
                ['refund_money', '>', 0],
            ]
        );
        $this->assign('refund_total_count', $refund_total_count['data']);

        return $this->fetch('account/dashboard');
    }
}