<?php

/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\member;

use app\model\BaseModel;

/**
 * 会员账户
 */
class MemberAccount extends BaseModel
{
    //账户类型
    private $account_type = [
        'balance' => '余额（不可提现）',
        'balance_money' => '余额（可提现）',
        'point' => '积分',
        'growth' => '成长值'
    ];

    //来源类型
    private $from_type = [];

    public function __construct()
    {
        $event_from_type = event('MemberAccountFromType', '');
        $from_type = [];
        foreach ($event_from_type as $info) {

            if (isset($info[ 'balance' ])) {
                $balance = array_keys($info[ 'balance' ]);
                $from_type[ 'balance' ][ $balance[ 0 ] ] = $info[ 'balance' ][ $balance[ 0 ] ];
            }

            if (isset($info[ 'point' ])) {
                $point = array_keys($info[ 'point' ]);
                $from_type[ 'point' ][ $point[ 0 ] ] = $info[ 'point' ][ $point[ 0 ] ];
            }

            if (isset($info[ 'growth' ])) {
                $growth = array_keys($info[ 'growth' ]);
                $from_type[ 'growth' ][ $growth[ 0 ] ] = $info[ 'growth' ][ $growth[ 0 ] ];
            }

            if (isset($info[ 'balance_money' ])) {
                $balance_money = array_keys($info[ 'balance_money' ]);
                $from_type[ 'balance_money' ][ $balance_money[ 0 ] ] = $info[ 'balance_money' ][ $balance_money[ 0 ] ];
            }
        }

        $from_type[ 'balance' ][ 'adjust' ] = [ 'type_name' => '调整', 'type_url' => '' ];
        $from_type[ 'balance_money' ][ 'adjust' ] = [ 'type_name' => '调整', 'type_url' => '' ];

        $from_type[ 'balance' ][ 'order' ] = [ 'type_name' => '消费', 'type_url' => '' ];
        $from_type[ 'balance_money' ][ 'order' ] = [ 'type_name' => '消费', 'type_url' => '' ];

        $from_type[ 'point' ][ 'adjust' ] = [ 'type_name' => '调整', 'type_url' => '' ];
        $from_type[ 'growth' ][ 'adjust' ] = [ 'type_name' => '调整', 'type_url' => '' ];

        $from_type[ 'balance' ][ 'upgrade' ] = [ 'type_name' => '升级', 'type_url' => '' ];
        $from_type[ 'balance_money' ][ 'upgrade' ] = [ 'type_name' => '升级', 'type_url' => '' ];

        $from_type[ 'point' ][ 'upgrade' ] = [ 'type_name' => '升级', 'type_url' => '' ];
        $from_type[ 'growth' ][ 'upgrade' ] = [ 'type_name' => '升级', 'type_url' => '' ];

        $from_type[ 'balance' ][ 'refund' ] = [ 'type_name' => '退还', 'type_url' => '' ];
        $from_type[ 'point' ][ 'refund' ] = [ 'type_name' => '退还', 'type_url' => '' ];

        $this->from_type = $from_type;
    }

    /**
     * 获取账户类型
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * 获取来源类型
     */
    public function getFromType()
    {
        return $this->from_type;
    }

    /**
     * 添加会员账户数据
     * @param int $site_id
     * @param int $member_id
     * @param int $account_type
     * @param float $account_data
     * @param string $relate_url
     * @param string $remark
     */
    public function addMemberAccount($site_id, $member_id, $account_type, $account_data, $from_type, $relate_tag, $remark)
    {
        model('member_account')->startTrans();
        try {
            //账户检测
            $member_account = model('member')->getInfo([
                [ 'member_id', '=', $member_id ],
                [ 'site_id', '=', $site_id ]
            ], $account_type . ', username, mobile, email');
            $account_new_data = (float) $member_account[ $account_type ] + (float) $account_data;
            if ((float) $account_new_data < 0) {
                model('member_account')->rollback();
                $msg = '';
                if ($account_type == 'balance') {
                    $msg = '账户余额不足';
                } elseif ($account_type = 'point') {
                    $msg = '账户积分不足';
                } elseif ($account_type = 'growth') {
                    $msg = '账户成长值不足';
                }
                return $this->error('', $msg);
            }

            //添加记录
            $type_info = $this->from_type[ $account_type ][ $from_type ];
            $data = array (
                'site_id' => $site_id,
                'member_id' => $member_id,
                'account_type' => $account_type,
                'account_data' => $account_data,
                'from_type' => $from_type,
                'type_name' => $type_info[ 'type_name' ],
                'type_tag' => $relate_tag,
                'create_time' => time(),
                'username' => $member_account[ 'username' ],
                'mobile' => $member_account[ 'mobile' ],
                'email' => $member_account[ 'email' ],
                'remark' => $remark
            );
            model('member_account')->add($data);

            //账户更新
            model('member')->update([
                $account_type => $account_new_data
            ], [
                'member_id' => $member_id
            ]);

            event("AddMemberAccount", $data);
            model('member_account')->commit();
            return $this->success([ 'member_id' => $member_id, $account_type => sprintf("%.2f", $account_new_data) ]);
        } catch (\Exception $e) {
            model('member_account')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取账户分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array|\multitype
     */
    public function getMemberAccountPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'create_time desc', $field = '*')
    {
        $list = model('member_account')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 获取账户列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array|\multitype
     */
    public function getMemberAccountList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('member_account')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取账户总额
     * @param array $where
     * @param string $field
     * @param string $alias
     * @param null $join
     * @return array
     */
    public function getMemberAccountSum($where = [], $field = '', $alias = 'a', $join = null){
        $sum = model('member_account')->getSum($where, $field, $alias, $join);
        return $this->success($sum);
    }

}
