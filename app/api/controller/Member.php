<?php
/**
 * Member.php
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

use app\model\member\Member as MemberModel;
use app\model\member\Register as RegisterModel;
use app\model\message\Message;
use think\facade\Cache;
use app\model\member\MemberLevel as MemberLevelModel;

class Member extends BaseApi
{

    /**
     * 基础信息
     */
    public function info()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_model = new MemberModel();
        $info         = $member_model->getMemberInfo([['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]], 'member_id,source_member,username,nickname,mobile,email,password,status,headimg,member_level,member_level_name,member_label,member_label_name,qq,qq_openid,wx_openid,wx_unionid,ali_openid,baidu_openid,toutiao_openid,douyin_openid,realname,sex,location,birthday,point,balance,balance_money,growth,sign_days_series,password');
        if (!empty($info['data'])) {
            $info['data']['password'] = empty($info['data']['password']) ? 0 : 1;

            $member_level_model                = new MemberLevelModel();
            $member_level_result               = $member_level_model->getMemberLevelInfo([['level_id', '=', $info['data']['member_level']]]);
            $member_level                      = $member_level_result['data'] ?? [];
            $info['data']['member_level_info'] = $member_level;
        }

        return $this->response($info);
    }

    /**
     * 修改会员头像
     * @return string
     */
    public function modifyheadimg()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $headimg      = isset($this->params['headimg']) ? $this->params['headimg'] : '';
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['headimg' => $headimg], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
        return $this->response($res);
    }

    /**
     * 修改昵称
     * @return string
     */
    public function modifynickname()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $nickname     = isset($this->params['nickname']) ? $this->params['nickname'] : '';
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['nickname' => $nickname], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
        return $this->response($res);
    }

    /**
     * 修改手机号
     * @return string
     */
    public function modifymobile()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        // 校验验证码
        $captcha   = new Captcha();
        $check_res = $captcha->checkCaptcha(false);
        if ($check_res['code'] < 0) return $this->response($check_res);

        $register = new RegisterModel();
        $exist    = $register->mobileExist($this->params['mobile'], $this->site_id);
        if ($exist) {
            return $this->response($this->error("", "手机号已存在"));
        } else {
            $key         = $this->params['key'];
            $verify_data = Cache::get($key);
            if ($verify_data["mobile"] == $this->params["mobile"] && $verify_data["code"] == $this->params["code"]) {
                $mobile       = isset($this->params['mobile']) ? $this->params['mobile'] : '';
                $member_model = new MemberModel();
                $res          = $member_model->editMember(['mobile' => $mobile], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
            } else {
                $res = $this->error("", "验证码不正确");
            }
            return $this->response($res);
        }

    }

    /**
     * 修改密码
     * @return string
     */
    public function modifypassword()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $old_password = isset($this->params['old_password']) ? $this->params['old_password'] : '';
        $new_password = isset($this->params['new_password']) ? $this->params['new_password'] : '';

        $member_model = new MemberModel();
        $info         = $member_model->getMemberInfo([['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]], 'password');
        // 未设置密码时设置密码需验证身份
        if (empty($info['data']['password'])) {
            $key         = $this->params['key'] ?? '';
            $code        = $this->params['code'] ?? '';
            $verify_data = Cache::get($key);
            if (empty($verify_data) || $verify_data["code"] != $code) {
                return $this->response($this->error("", "手机验证码不正确"));
            }
        }
        $res = $member_model->modifyMemberPassword($token['data']['member_id'], $old_password, $new_password);

        return $this->response($res);
    }

    /**
     * 绑定短信验证码
     */
    public function bindmobliecode()
    {
        // 校验验证码
        $captcha   = new Captcha();
        $check_res = $captcha->checkCaptcha(false);
        if ($check_res['code'] < 0) return $this->response($check_res);

        $mobile   = $this->params['mobile'];//注册手机号
        $register = new RegisterModel();
        $exist    = $register->mobileExist($mobile, $this->site_id);
        if ($exist) {
            return $this->response($this->error("", "当前手机号已存在"));
        } else {
            $code          = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
            $message_model = new Message();
            $res           = $message_model->sendMessage(["mobile" => $mobile, "site_id" => $this->site_id, "code" => $code, "support_type" => ["sms"], "keywords" => "MEMBER_BIND"]);
            if ($res["code"] >= 0) {
                //将验证码存入缓存
                $key = 'bind_mobile_code_' . md5(uniqid(null, true));
                Cache::tag("bind_mobile_code")->set($key, ['mobile' => $mobile, 'code' => $code], 600);
                return $this->response($this->success(["key" => $key]));
            } else {
                return $this->response($res);
            }
        }
    }

    /**
     * 设置密码时获取验证码
     */
    public function pwdmobliecode()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        // 校验验证码
        $captcha   = new Captcha();
        $check_res = $captcha->checkCaptcha(false);
        if ($check_res['code'] < 0) return $this->response($check_res);

        $member_model = new MemberModel();
        $info         = $member_model->getMemberInfo([['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]], 'mobile');
        if (empty($info['data'])) return $this->response($this->error([], '未获取到会员信息！'));
        if (empty($info['data']['mobile'])) return $this->response($this->error([], '会员信息尚未绑定手机号！'));

        $mobile = $info['data']['mobile'];

        $code          = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
        $message_model = new Message();
        $res           = $message_model->sendMessage(["mobile" => $mobile, "site_id" => $this->site_id, "code" => $code, "support_type" => ["sms"], "keywords" => "SET_PASSWORD"]);
        if (isset($res["code"]) && $res["code"] >= 0) {
            //将验证码存入缓存
            $key = 'password_mobile_code_' . md5(uniqid(null, true));
            Cache::tag("password_mobile_code_")->set($key, ['mobile' => $mobile, 'code' => $code], 600);
            return $this->response($this->success(["key" => $key, 'code' => $code]));
        } else {
            return $this->response($this->error('', '发送失败'));
        }
    }

    /**
     * 验证手机号
     * @return string
     */
    public function checkmobile()
    {
        $mobile = isset($this->params['mobile']) ? $this->params['mobile'] : '';
        if (empty($mobile)) {
            return $this->response($this->error('', 'REQUEST_MOBILE'));
        }
        $member_model = new MemberModel();
        $condition    = [
            ['mobile', '=', $mobile],
            ['site_id', '=', $this->site_id]
        ];
        $res          = $member_model->getMemberCount($condition);
        if ($res['data'] > 0) {
            return $this->response($this->error('', '当前手机号已存在'));
        }
        return $this->response($this->success());
    }

    /**
     * 修改支付密码
     * @return string
     */
    public function modifypaypassword()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $key      = $this->params['key'] ?? '';
        $code     = $this->params['code'] ?? '';
        $password = isset($this->params['password']) ? trim($this->params['password']) : '';
        if (empty($password)) return $this->response($this->error('', '支付密码不可为空'));

        $verify_data = Cache::get($key);
        if ($verify_data["code"] == $this->params["code"]) {
            $member_model = new MemberModel();
            $res          = $member_model->modifyMemberPayPassword($token['data']['member_id'], $password);
        } else {
            $res = $this->error("", "验证码不正确");
        }
        return $this->response($res);
    }

    /**
     * 检测会员是否设置支付密码
     */
    public function issetpayaassword()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $member_model = new MemberModel();
        $res          = $member_model->memberIsSetPayPassword($this->member_id);
        return $this->response($res);
    }

    /**
     * 检测支付密码是否正确
     */
    public function checkpaypassword()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $password = isset($this->params['pay_password']) ? trim($this->params['pay_password']) : '';
        if (empty($password)) return $this->response($this->error('', '支付密码不可为空'));

        $member_model = new MemberModel();
        $res          = $member_model->checkPayPassword($this->member_id, $password);
        return $this->response($res);
    }

    /**
     *
     * 修改支付密码发送手机验证码
     */
    public function paypwdcode()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $code          = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);// 生成4位随机数，左侧补0
        $message_model = new Message();
        $res           = $message_model->sendMessage(["member_id" => $this->member_id, "site_id" => $this->site_id, "code" => $code, "support_type" => ["sms"], "keywords" => "MEMBER_PAY_PASSWORD"]);
        if ($res["code"] >= 0) {
            //将验证码存入缓存
            $key = 'pay_password_code_' . md5(uniqid(null, true));
            Cache::tag("pay_password_code")->set($key, ['member_id' => $this->member_id, 'code' => $code], 600);
            return $this->response($this->success(["key" => $key]));
        } else {
            return $this->response($res);
        }
    }

    /**
     * 验证修改支付密码动态码
     */
    public function verifypaypwdcode()
    {
        $key = isset($this->params['key']) ? trim($this->params['key']) : '';

        $verify_data = Cache::get($key);
        if ($verify_data["code"] == $this->params["code"]) {
            $res = $this->success([]);
        } else {
            $res = $this->error("", "验证码不正确");
        }
        return $this->response($res);
    }

    /**
     * 通过token得到会员id
     */
    public function id()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);
        return $this->response($this->success($this->member_id));
    }

    /**
     * 账户奖励规则说明
     * @return false|string
     */
    public function accountrule()
    {
        //积分
        $point = event('MemberAccountRule', ['account' => 'point', 'site_id' => $this->site_id]);

        //余额
        $balance = event('MemberAccountRule', ['account' => 'balance', 'site_id' => $this->site_id]);

        //成长值
        $growth = event('MemberAccountRule', ['account' => 'growth', 'site_id' => $this->site_id]);

        $res = [
            'point'   => $point,
            'balance' => $balance,
            'growth'  => $growth
        ];

        return $this->response($this->success($res));
    }

    /**
     * 拉取会员头像
     */
    public function pullhaedimg()
    {
        $member_id = input('member_id', '');
        $member    = new MemberModel();
        $member->pullHeadimg($member_id);
    }

    /**
     * 修改真实姓名
     */
    public function modifyrealname()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $realname     = isset($this->params['realname']) ? $this->params['realname'] : '';
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['realname' => $realname], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
        return $this->response($res);
    }

    /**
     * 修改性别
     */
    public function modifysex()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $sex          = isset($this->params['sex']) ? $this->params['sex'] : 0;
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['sex' => $sex], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
        return $this->response($res);
    }

    /**
     * 修改生日
     */
    public function modifybirthday()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $birthday     = isset($this->params['birthday']) ? $this->params['birthday'] : '';
        $member_model = new MemberModel();
        $res          = $member_model->editMember(['birthday' => $birthday], [['member_id', '=', $token['data']['member_id'], ['site_id', '=', $this->site_id]]]);
        return $this->response($res);
    }
}