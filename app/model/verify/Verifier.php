<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\verify;

use app\model\BaseModel;

/**
 * 核销员管理
 */
class Verifier extends BaseModel
{

    /**
     * 添加核销人员
     * @param unknown $data
     */
    public function addVerifier($data)
    {
        //检测会员是否在本店铺存在核销员
        if ($data["member_id"] > 0) {
            $member_condition = array(
                ["member_id", "=", $data["member_id"]],
                ["site_id", "=", $data["site_id"]]
            );
            $member_count     = model("verifier")->getCount($member_condition, "verifier_id");
            if ($member_count > 0) {
                return $this->error([], "当前会员已存在核销员身份");
            }
        }
        //检测用户是否在本店铺存在核销员
        if ($data["uid"] > 0) {
            $user_condition = array(
                ["uid", "=", $data["uid"]],
                ["site_id", "=", $data["site_id"]]
            );
            $user_count     = model("verifier")->getCount($user_condition, "verifier_id");
            if ($user_count > 0) {
                return $this->error([], "当前用户已存在核销员身份");
            }
        }
        $res = model("verifier")->add($data);
        return $this->success($res);
    }

    /**
     * 编辑用户
     * @param $data
     * @param $condition
     */
    public function editVerifier($data, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        $verifier_id     = isset($check_condition['verifier_id']) ? $check_condition['verifier_id'] : '';
        //检测会员是否在本店铺存在核销员
        if ($data["member_id"] > 0) {
            $member_condition = array(
                ["member_id", "=", $data["member_id"]],
                ["site_id", "=", $site_id],
                ["verifier_id", "<>", $verifier_id]
            );
            $member_count     = model("verifier")->getCount($member_condition, "verifier_id");
            if ($member_count > 0) {
                return $this->error([], "当前会员在当前店铺已存在核销员身份");
            }
        }
        //检测用户是否在本店铺存在核销员
        if ($data["uid"] > 0) {
            $user_condition = array(
                ["uid", "=", $data["uid"]],
                ["site_id", "=", $site_id],
                ["verifier_id", "<>", $verifier_id]
            );
            $user_count     = model("verifier")->getCount($user_condition, "verifier_id");
            if ($user_count > 0) {
                return $this->error([], "当前用户在当前店铺已存在核销员身份");
            }
        }

        $res = model("verifier")->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 删除核销人员
     * @param unknown $verifier_id
     * @param unknown $site_id
     * @return multitype:number unknown
     */
    public function deleteVerifier($verifier_id, $site_id)
    {
        $res = model("verifier")->delete([['verifier_id', '=', $verifier_id], ['site_id', '=', $site_id]]);
        return $this->success($res);
    }

    /**
     * 获取核销人员信息
     * @param array $condition
     * @param string $field
     */
    public function getVerifierInfo($condition, $field = '*')
    {
        $res = model('verifier')->getInfo($condition, $field);
        return $this->success($res);
    }

    /**
     * 获取核销人员列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getVerifierList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $list = model('verifier')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取核销人员分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getVerifierPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'v.create_time desc')
    {
        $field = 'v.verifier_id, v.verifier_name, v.site_id, v.member_id, v.uid, v.create_time, v.modify_time, m.username, m.mobile';
        $alias = 'v';
        $join = [
            [
                'member m',
                'm.member_id = v.member_id',
                'left'
            ]
        ];
        $list = model('verifier')->pageList($condition, $field, $order, $page, $page_size,$alias,$join);
        return $this->success($list);
    }

    /**
     * 检测会员是否是核销员
     * @param $condition
     */
    public function checkIsVerifier($condition)
    {
        $info = model('verifier')->getInfo($condition, "verifier_id");
        if (!empty($info)) {
            return $this->success($info);
        } else {
            return $this->error();
        }
    }

}
