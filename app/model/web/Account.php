<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\web;

use app\model\BaseModel;

/**
 * 系统站账户
 */
class Account extends BaseModel
{
    public $from_type = [
        'order'    => [
            'type_name' => '订单结算',
            'type_url'  => '',
        ],
        'withdraw' => [
            'type_name' => '提现',
            'type_url'  => '',
        ],
    ];
    /**************************************************************店铺账户****************************************************************/
    /**
     * 添加分站账户数据
     * @param int $site_id
     * @param int $account_type 账户类型 默认account
     * @param float $account_data
     * @param string $relate_url
     * @param string $remark
     */
    public function addAccount($site_id, $account_type = 'account', $account_data, $from_type, $relate_tag, $remark)
    {
        $data = array(
            'account_no'   => date('YmdHi') . rand(1000, 9999),
            'site_id'      => $site_id,
            'account_type' => $account_type,
            'account_data' => $account_data,
            'from_type'    => $from_type,
            'relate_tag'   => $relate_tag,
            'create_time'  => time(),
            'remark'       => $remark
        );

        $account          = model('website')->getInfo([
            'site_id' => 0
        ], $account_type);
        $account_new_data = (float)$account[$account_type] + (float)$account_data;
        if ((float)$account_new_data < 0) {
            return $this->error('', 'RESULT_ERROR');
        }

        $res = model('account')->add($data);
        $res = model('website')->update([
            $account_type => $account_new_data
        ], [
            'site_id' => 0
        ]);
        event("AddAccount", $data);
        return $this->success($res);
    }

    /**
     * 获取店铺账户流水分页
     * @param unknown $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return multitype:number unknown
     */
    public function getAccountPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {

        $list = model('account')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 会员金额账户
     * @return multitype:
     */
    public function getMemberBalanceSum($site_id = 0)
    {
        $field = '
                sum(balance) as balance, 
                sum(balance_money) as balance_money,
                sum(balance_withdraw_apply) as balance_withdraw_apply, 
                sum(balance_withdraw) as balance_withdraw
                ';
        $info  = model("member")->getInfo([['member_id', '>', 0], ['site_id', '=', $site_id]], $field);
        if ($info['balance'] == null) {
            $info['balance'] = '0.00';
        }
        if ($info['balance_money'] == null) {
            $info['balance_money'] = '0.00';
        }
        if ($info['balance_withdraw_apply'] == null) {
            $info['balance_withdraw_apply'] = '0.00';
        }
        if ($info['balance_withdraw'] == null) {
            $info['balance_withdraw'] = '0.00';
        }
        return $this->success($info);
    }

}