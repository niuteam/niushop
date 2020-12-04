<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */

namespace app\api\controller;

use app\model\member\MemberBankAccount as MemberBankAccountModel;

/**
 * 会员提现账号
 * Class Memberbankaccount
 * @package app\api\controller
 */
class Memberbankaccount extends BaseApi
{
    /**
     * 添加信息
     */
    public function add()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $realname         = isset($this->params['realname']) ? $this->params['realname'] : '';
        $mobile           = isset($this->params['mobile']) ? $this->params['mobile'] : '';
        $withdraw_type    = isset($this->params['withdraw_type']) ? $this->params['withdraw_type'] : '';// '账户类型 alipay 支付宝 bank 银行卡
        $branch_bank_name = isset($this->params['branch_bank_name']) ? $this->params['branch_bank_name'] : '';// 银行支行信息
        $bank_account     = isset($this->params['bank_account']) ? $this->params['bank_account'] : '';// 银行账号
        if (empty($realname)) {
            return $this->response($this->error('', 'REQUEST_REAL_NAME'));
        }
        if (empty($mobile)) {
            return $this->response($this->error('', 'REQUEST_MOBILE'));
        }
        if (empty($withdraw_type)) {
            return $this->response($this->error('', 'REQUEST_WITHDRAW_TYPE'));
        }
        if (!empty($withdraw_type) && $withdraw_type == 'bank') {
            if (empty($branch_bank_name)) {
                return $this->response($this->error('', 'REQUEST_BRANCH_BANK_NAME'));
            }
            if (empty($bank_account)) {
                return $this->response($this->error('', 'REQUEST_BRANCH_BANK_ACCOUNT'));
            }
        }

        $member_bank_account_model = new MemberBankAccountModel();
        $data                      = [
            'member_id'        => $this->member_id,
            'realname'         => $realname,
            'mobile'           => $mobile,
            'withdraw_type'    => $withdraw_type,
            'branch_bank_name' => $branch_bank_name,
            'bank_account'     => $bank_account,
            'is_default'       => 1
        ];
        $res                       = $member_bank_account_model->addMemberBankAccount($data);
        return $this->response($res);

    }

    /**
     * 编辑信息
     */
    public function edit()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $id               = isset($this->params['id']) ? $this->params['id'] : 0;
        $realname         = isset($this->params['realname']) ? $this->params['realname'] : '';
        $mobile           = isset($this->params['mobile']) ? $this->params['mobile'] : '';
        $withdraw_type    = isset($this->params['withdraw_type']) ? $this->params['withdraw_type'] : '';// '账户类型 alipay 支付宝 bank 银行卡
        $branch_bank_name = isset($this->params['branch_bank_name']) ? $this->params['branch_bank_name'] : '';// 银行支行信息
        $bank_account     = isset($this->params['bank_account']) ? $this->params['bank_account'] : '';// 银行账号
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        if (empty($realname)) {
            return $this->response($this->error('', 'REQUEST_REAL_NAME'));
        }
        if (empty($mobile)) {
            return $this->response($this->error('', 'REQUEST_MOBILE'));
        }
        if (empty($withdraw_type)) {
            return $this->response($this->error('', 'REQUEST_WITHDRAW_TYPE'));
        }
        if (!empty($withdraw_type) && $withdraw_type == 'bank') {
            if (empty($branch_bank_name)) {
                return $this->response($this->error('', 'REQUEST_BRANCH_BANK_NAME'));
            }
            if (empty($bank_account)) {
                return $this->response($this->error('', 'REQUEST_BRANCH_BANK_ACCOUNT'));
            }
        }

        $member_bank_account_model = new MemberBankAccountModel();
        $data                      = [
            'id'               => $id,
            'member_id'        => $this->member_id,
            'realname'         => $realname,
            'mobile'           => $mobile,
            'withdraw_type'    => $withdraw_type,
            'branch_bank_name' => $branch_bank_name,
            'bank_account'     => $bank_account,
            'is_default'       => 1
        ];
        $res                       = $member_bank_account_model->editMemberBankAccount($data);
        return $this->response($res);
    }

    /**
     * 删除信息
     */
    public function delete()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $id = isset($this->params['id']) ? $this->params['id'] : 0;
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        $member_bank_account_model = new MemberBankAccountModel();
        $res                       = $member_bank_account_model->deleteMemberBankAccount([['member_id', '=', $this->member_id], ['id', '=', $id]]);
        return $this->response($res);
    }

    /**
     * 基础信息
     */
    public function setDefault()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $id = isset($this->params['id']) ? $this->params['id'] : 0;
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        $member_bank_account_model = new MemberBankAccountModel();
        $info                      = $member_bank_account_model->modifyDefaultAccount($id, $this->member_id);
        return $this->response($info);
    }

    /**
     * 基础信息
     */
    public function info()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $id = isset($this->params['id']) ? $this->params['id'] : 0;
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        $member_bank_account_model = new MemberBankAccountModel();
        $info                      = $member_bank_account_model->getMemberBankAccountInfo([['member_id', '=', $this->member_id], ['id', '=', $id]], 'id,member_id,realname,mobile,withdraw_type,branch_bank_name,bank_account,is_default');
        if (!empty($info['data'])) {
            $info['data']['withdraw_type_name'] = $member_bank_account_model->getWithdrawType()[$info['data']['withdraw_type']];
        }
        return $this->response($info);
    }

    /**
     * 获取默认账户信息
     */
    public function defaultInfo()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_bank_account_model = new MemberBankAccountModel();
        $info                      = $member_bank_account_model->getMemberBankAccountInfo([['member_id', '=', $this->member_id], ['is_default', '=', 1]], 'id,member_id,realname,mobile,withdraw_type,branch_bank_name,bank_account,is_default');
        if (!empty($info['data'])) {
            $info['data']['withdraw_type_name'] = $member_bank_account_model->getWithdrawType()[$info['data']['withdraw_type']];
        }

        return $this->response($info);
    }

    /**
     * 分页列表信息
     */
    public function page()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page      = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;

        $member_bank_account_model = new MemberBankAccountModel();
        $list                      = $member_bank_account_model->getMemberBankAccountPageList([['member_id', '=', $this->member_id]], $page, $page_size);
        return $this->response($list);
    }


}