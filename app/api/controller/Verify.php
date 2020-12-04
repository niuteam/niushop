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

use app\model\verify\Verifier;
use app\model\verify\Verify as VerifyModel;

/**
 * 核销管理
 * @author Administrator
 *
 */
class Verify extends BaseApi
{

    /**
     * 核销列表
     */
    public function lists()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $verifier_model = new Verifier();
        $condition      = array(
            ["member_id", "=", $this->member_id],
            ["site_id", "=", $this->site_id]
        );
        $res            = $verifier_model->checkIsVerifier($condition);
        if ($res["code"] != 0)
            return $this->response($res);

        $verifier_id  = $res["data"]["verifier_id"];
        $verify_model = new VerifyModel();
        $condition    = array(
            ["verifier_id", "=", $verifier_id],
        );
        $verify_type  = isset($this->params['verify_type']) ? $this->params['verify_type'] : 'all';
        if ($verify_type != "all") {
            $condition[] = ["verify_type", "=", $verify_type];
        }
        $page_index = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size  = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
        $res        = $verify_model->getVerifyPageList($condition, $page_index, $page_size, "verify_time desc");
        return $this->response($res);
    }

    /**
     *获取核销类型
     */
    public function getVerifyType()
    {
        $verify_model = new VerifyModel();
        $res          = $verify_model->getVerifyType();
        return $this->response($this->success($res));
    }

    /**
     * 验证核销员身份
     */
    public function checkIsVerifier()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $verifier_model = new Verifier();
        $condition      = array(
            ["member_id", "=", $this->member_id],
            ["site_id", "=", $this->site_id]
        );
        $res            = $verifier_model->checkIsVerifier($condition);
        return $this->response($res);
    }

    /**
     * 核销验证信息
     */
    public function verifyInfo()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        $verify_code  = isset($this->params['verify_code']) ? $this->params['verify_code'] : '';
        $verify_model = new VerifyModel();
        $res          = $verify_model->checkMemberVerify($this->member_id, $verify_code);
        if ($res["code"] != 0)
            return $this->response($res);

        return $this->response($this->success($res["data"]["verify"]));
    }

    /**
     * 核销
     * @return string
     */
    public function verify()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $verify_code  = isset($this->params['verify_code']) ? $this->params['verify_code'] : '';
        $verify_model = new VerifyModel();
        $res          = $verify_model->checkMemberVerify($this->member_id, $verify_code);
        if ($res["code"] != 0)
            return $this->response($res);

        $res = $verify_model->verify($res["data"]["verifier"], $verify_code);
        return $this->response($res);
    }

}