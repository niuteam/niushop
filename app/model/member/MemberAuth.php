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
 * 实名认证
 */
class MemberAuth extends BaseModel
{

    //申请状态
    private $status = [
        1  => '审核通过',
        0  => '待审核',
        -1 => '审核失败',
    ];

    /**
     * 获取实名认证分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getMemberAuthPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('member_auth')->pageList($condition, $field, $order, $page, $page_size, '', '', '');
        return $this->success($list);
    }

    /**
     * 获取实名认证列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getMemberAuthList($where = [], $field = true, $order = '', $alias = 'a', $join = [], $group = '', $limit = null)
    {
        $res = model('member_auth')->getList($where, $field, $order, $alias, $join, $group, $limit);
        return $this->success($res);
    }

    /**
     * 获取实名认证信息
     * @param array $condition
     * @param string $field
     * @return unknown
     */
    public function getMemberAuthInfo($condition = [], $field = '*')
    {
        $member_info = model('member_auth')->getInfo($condition, $field);
        return $this->success($member_info);
    }

    /**
     * 添加实名认证
     * @param $data
     */
    public function add($data)
    {

        $member_id = isset($data['member_id']) ? $data['member_id'] : '';
        if ($member_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data["create_time"] = time();
        $result              = model("member_auth")->add($data);
        if ($result === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($result);
    }

    /**
     * 编辑实名认证
     * @param $data
     * @param $condition
     */
    public function edit($data, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $member_id       = isset($check_condition['member_id']) ? $check_condition['member_id'] : '';
        $auth_id         = isset($check_condition['auth_id']) ? $check_condition['auth_id'] : '';
        if ($member_id === '') {
            return $this->error('', '会员ID不能为空');
        }
        if ($auth_id === '') {
            return $this->error('', '实名认证ID不能为空');
        }
        $res = model("member_auth")->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 实名认证 审核通过 后台审核
     * @param unknown $auth_id
     */
    public function authPass($auth_id)
    {
        // 开启事务
        model('member_auth')->startTrans();
        try {
            //获取实名认证 信息
            $member_auth_info = model('member_auth')->getInfo([['auth_id', '=', $auth_id]]);
            //获取会员id
            $member_id = $member_auth_info['member_id'];

            // 会员用户实名修改
            model('member')->update(['is_auth' => 1], [['member_id', '=', $member_id]]);
            // 会员实名认证通过修改
            $res = model('member_auth')->update(['status' => 1, 'audit_time' => time()], [['auth_id', '=', $auth_id]]);
            // 事务提交
            model('member_auth')->commit();
            return $this->success($res);
        } catch (\Exception $e) {
            // 事务回滚
            model('member_auth')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 审核拒绝
     * @param unknown $auth_id
     * @param unknown $reason
     */
    public function authReject($auth_id, $reason)
    {
        $res = model('member_auth')->update(['status' => -1, 'remark' => $reason], [['auth_id', '=', $auth_id]]);
        return $this->success($res);
    }

    /**
     * 获取实名审核状态
     */
    public function getAuthStatus()
    {
        return $this->status;
    }
}