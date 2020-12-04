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


use app\model\member\Withdraw as MemberWithdrawModel;
use app\model\system\Pay;
use app\model\web\Account as AccountModel;

/**
 * 会员管理 控制器
 */
class Memberwithdraw extends BaseShop
{
    /**
     * 会员提现配置
     */
    public function config()
    {
        $config_model = new MemberWithdrawModel();
        if (request()->isAjax()) {

            if (empty(input("transfer_type"))) {
                $transfer_type = "";
            } else {
                $transfer_type = implode(",", input("transfer_type"));
            }
            //订单提现
            $data = [
                'is_auto_audit'    => input('is_auto_audit', 0),//是否需要审核 1 手动审核  2 自动审核
                'rate'             => input('rate', 0),//提现手续费比率 (0-100)
                'transfer_type'    => $transfer_type,//转账方式,
                'is_auto_transfer' => input('is_auto_transfer', 0),//是否自动转账 1 手动转账  2 自动转账
                'min'              => input('min', 0),//提现最低额度
            ];
            $this->addLog("设置会员提现配置");
            $is_use = input("is_use", 0);//是否启用
            $res    = $config_model->setConfig($data, $is_use, $this->site_id, $this->app_module);
            return $res;
        } else {
            $this->assign("is_exist", addon_is_exit("memberwithdraw", $this->site_id));
            //会员提现
            $config_result = $config_model->getConfig($this->site_id, $this->app_module);
            $this->assign('config', $config_result['data']);
            $pay_model          = new Pay();
            $transfer_type_list = $pay_model->getTransferType($this->site_id);
            $this->assign("transfer_type_list", $transfer_type_list);
            return $this->fetch('memberwithdraw/config');
        }
    }

    /**
     * 会员提现列表
     * @return mixed
     */
    public function lists()
    {
        $withdraw_model = new MemberWithdrawModel();
        if (request()->isAjax()) {
            $page          = input('page', 1);
            $page_size     = input('page_size', PAGE_LIST_ROWS);
            $withdraw_no   = input('withdraw_no', '');
            $start_date    = input('start_date', '');
            $end_date      = input('end_date', '');
            $status        = input('status', 'all');//提现状态
            $transfer_type = input('transfer_type', '');//提现转账方式
            $member_name   = input('member_name', '');//提现转账方式
            $condition     = [['site_id', '=', $this->site_id]];

            if (!empty($withdraw_no)) {
                $condition[] = ['withdraw_no', 'like', '%' . $withdraw_no . '%'];
            }
            if (!empty($transfer_type)) {
                $condition[] = ['transfer_type', '=', $transfer_type];
            }
            if ($status != "all") {
                $condition[] = ['status', '=', $status];
            }
            if (!empty($member_name)) {
                $condition[] = ['member_name', '=', $member_name];
            }
            if ($start_date != '' && $end_date != '') {
                $condition[] = ['apply_time', 'between', [strtotime($start_date), strtotime($end_date)]];
            } else if ($start_date != '' && $end_date == '') {
                $condition[] = ['apply_time', '>=', strtotime($start_date)];
            } else if ($start_date == '' && $end_date != '') {
                $condition[] = ['apply_time', '<=', strtotime($end_date)];
            }
            $order = 'apply_time desc';

            return $withdraw_model->getMemberWithdrawPageList($condition, $page, $page_size, $order);
        } else {
            $this->assign("is_exist", addon_is_exit("memberwithdraw", $this->site_id));
            $pay_model          = new Pay();
            $transfer_type_list = $pay_model->getTransferType($this->site_id);
            $this->assign("transfer_type_list", $transfer_type_list);

            $account_model      = new AccountModel();
            $member_balance_sum = $account_model->getMemberBalanceSum($this->site_id);
            $this->assign('member_balance_sum', $member_balance_sum['data']);
            return $this->fetch("memberwithdraw/lists");
        }
    }

    /**
     * 详情
     */
    public function detail()
    {
        $id                   = input('id', 0);
        $withdraw_model       = new MemberWithdrawModel();
        $withdraw_info_result = $withdraw_model->getMemberWithdrawInfo([["id", "=", $id], ['site_id', '=', $this->site_id]]);
        $withdraw_info        = $withdraw_info_result["data"];
        $this->assign("withdraw_info", $withdraw_info);
        return $this->fetch("memberwithdraw/detail");
    }

    /**
     * 同意
     * @return array
     */
    public function agree()
    {
        if (request()->isAjax()) {
            $id             = input('id', 0);
            $withdraw_model = new MemberWithdrawModel();
            $condition      = array(
                ['site_id', '=', $this->site_id],
                ["id", "=", $id]
            );
            $result         = $withdraw_model->agree($condition);
            return $result;
        }
    }

    /**
     * 拒绝
     * @return array
     */
    public function refuse()
    {

        if (request()->isAjax()) {
            $id             = input('id', 0);
            $refuse_reason  = input('refuse_reason', '');
            $withdraw_model = new MemberWithdrawModel();
            $condition      = array(
                ['site_id', '=', $this->site_id],
                ["id", "=", $id]
            );
            $data           = array(
                "refuse_reason" => $refuse_reason
            );
            $result         = $withdraw_model->refuse($condition, $data);
            return $result;
        }
    }

    /**
     * 转账
     */
    public function transferFinish()
    {
        if (request()->isAjax()) {
            $id                 = input('id', 0);
            $certificate        = input('certificate', '');
            $certificate_remark = input('certificate_remark', '');
            $withdraw_model     = new MemberWithdrawModel();
            $condition          = array(
                ["id", "=", $id]
            );
            $data               = array(
                "certificate"        => $certificate,
                "certificate_remark" => $certificate_remark,
            );
            $result             = $withdraw_model->transferFinish($condition, $data);
            return $result;
        }
    }

}