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
use app\model\message\Sms;
use app\model\system\Stat;
use app\model\upload\Upload;
use app\model\system\Address;
use think\facade\Cache;
use think\facade\Db;

/**
 * 会员管理
 */
class Member extends BaseModel
{

    /**
     * 添加会员(注意等级名称)
     * @param $data
     * @return array
     */
    public function addMember($data)
    {
        if ($data[ 'username' ]) {
            $count = model('member')->getCount([
                [ 'username', '=', $data[ 'username' ] ],
                [ 'site_id', '=', $data[ 'site_id' ] ],
                ['is_delete', '=', 0]
            ]);
            if ($count > 0) {
                return $this->error('', 'USERNAME_EXISTED');
            }
        }

        if ($data[ 'mobile' ]) {
            $count = model('member')->getCount([
                [ 'mobile', '=', $data[ 'mobile' ] ],
                [ 'site_id', '=', $data[ 'site_id' ] ],
                ['is_delete', '=', 0]
            ]);
            if ($count > 0) {
                return $this->error('', 'MOBILE_EXISTED');
            }
        }

        if ($data[ 'email' ]) {
            $count = model('member')->getCount([
                [ 'email', '=', $data[ 'email' ] ],
                [ 'site_id', '=', $data[ 'site_id' ] ],
                ['is_delete', '=', 0]
            ]);
            if ($count > 0) {
                return $this->error('', 'EMAIL_EXISTED');
            }
        }
        $res = model('member')->add($data);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        //添加统计
        $stat = new Stat();
        $stat->addShopStat([ 'member_count' => 1, 'site_id' => $data['site_id'] ]);
        return $this->success($res);
    }

    /**
     * 修改会员(注意标签与等级名称)
     * @param $data
     * @param $condition
     * @return array
     */
    public function editMember($data, $condition)
    {
        if (isset($data[ 'mobile' ]) && $data[ 'mobile' ] != '') {
            $info = model('member')->getInfo([ [ 'mobile', '=', $data[ 'mobile' ] ],['is_delete', '=', 0] ]);
            if (!empty($info)) {
                if ($info[ 'member_id' ] != (int) $condition[ 0 ][ 2 ]) {
                    return $this->error('', 'MOBILE_EXISTED');
                }
            }
        }
        $res = model('member')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'SAVE_FAIL');
        }

        return $this->success($res);
    }

    /**
     * 修改会员状态
     * @param $status
     * @param $condition
     * @return array
     */
    public function modifyMemberStatus($status, $condition)
    {
        $res = model('member')->update([
            'status' => $status
        ], $condition);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }

        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : 0;
        Cache::set('member_blacklist_' . $site_id, null);
        return $this->success($res);
    }

    /**
     * 修改会员标签
     * @param $label_ids
     * @param $condition
     * @return array
     */
    public function modifyMemberLabel($label_ids, $condition)
    {
        //查询会员标签
        $label_list = model("member_label")->getList([ [ 'label_id', 'in', $label_ids ] ], 'label_id,label_name');

        $label_ids = '';
        $label_names = '';
        if (!empty($label_list)) {
            foreach ($label_list as $k => $v) {
                $label_ids = $label_ids . $v[ 'label_id' ] . ',';
                $label_names = $label_names . $v[ 'label_name' ] . ',';
            }
        }
        $res = model('member')->update([
            'member_label' => $label_ids,
            'member_label_name' => $label_names
        ], $condition);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 重置密码
     * @param string $password
     * @param $condition
     * @return array
     */
    public function resetMemberPassword($password = '123456', $condition)
    {
        $res = model('member')->update([
            'password' => data_md5($password)
        ], $condition);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 修改密码
     * @param $member_id
     * @param $old_password
     * @param $new_password
     * @return array
     */
    public function modifyMemberPassword($member_id, $old_password, $new_password)
    {
        $res = model('member')->getCount([
            [ 'password', '=', data_md5($old_password) ],
            [ 'member_id', '=', $member_id ],
        ]);
        if ($res > 0) {
            $res = model('member')->update([
                'password' => data_md5($new_password)
            ], [ [ 'member_id', '=', $member_id ] ]);
            if ($res === false) {
                return $this->error('', 'RESULT_ERROR');
            }
            return $this->success($res);
        } else {
            return $this->error('', 'PASSWORD_ERROR');
        }
    }

    /**
     * 删除会员（应用后台）
     * @param $condition
     * @return array
     */
    public function deleteMember($condition)
    {
        $res = model('member')->delete($condition);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 获取会员信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getMemberInfo($condition = [], $field = '*')
    {
        $condition[] = ['is_delete', '=', 0];
        $member_info = model('member')->getInfo($condition, $field);
        return $this->success($member_info);
    }

    /**
     * 获取会员信息
     * @param int $member_id
     * @return array
     */
    public function getMemberDetail($member_id)
    {
        $field = 'member_id,source_member,username,nickname,mobile,email,status,headimg,member_level,member_level_name,member_label,member_label_name,qq,realname,sex,location,birthday,reg_time,point,balance,growth,balance_money,account5,pay_password';
        $member_info = model('member')->getInfo([ [ 'member_id', '=', $member_id ] ], $field);
        if (!empty($member_info)) {
            $member_info[ 'balance_total' ] = $member_info[ 'balance' ] + $member_info[ 'balance_money' ];
            return $this->success($member_info);
        }
        return $this->error();
    }

    /**
     * 获取会员数量
     * @param array $condition
     * @return array
     */
    public function getMemberCount($condition = [])
    {
        $condition[] = ['is_delete', '=', 0];
        $member_info = model('member')->getCount($condition);
        return $this->success($member_info);
    }

    /**
     * 获取会员分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getMemberPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $condition[] = ['is_delete', '=', 0];
        $list = model('member')->pageList($condition, $field, $order, $page, $page_size, '', '', '');
        return $this->success($list);
    }

    /**
     * 获取会员列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param string $alias
     * @param array $join
     * @param string $group
     * @param null $limit
     * @return array
     */
    public function getMemberList($where = [], $field = true, $order = '', $alias = 'a', $join = [], $group = '', $limit = null)
    {
        $where[] = ['is_delete', '=', 0];
        $res = model('member')->getList($where, $field, $order, $alias, $join, $group, $limit);
        return $this->success($res);
    }

    /**
     * 绑定发送验证码
     * @param $data
     * @return array|mixed|void
     */
    public function bindCode($data)
    {
        //发送短信
        $sms_model = new Sms();
        $var_parse = array (
            "code" => $data[ "code" ],//验证码
        );
        $data[ "sms_account" ] = $data[ "mobile" ] ?? '';//手机号
        $data[ "var_parse" ] = $var_parse;
        $sms_result = $sms_model->sendMessage($data);
        if ($sms_result[ "code" ] < 0)
            return $sms_result;

        return $this->success();
    }

    /**
     * 找回密码发送验证码
     * @param $data
     * @return array|mixed|void
     */
    public function findCode($data)
    {
        //发送短信
        $sms_model = new Sms();
        $var_parse = array (
            "code" => $data[ "code" ],//验证码
        );
        $data[ "sms_account" ] = $data[ "mobile" ] ?? '';//手机号
        $data[ "var_parse" ] = $var_parse;
        $sms_result = $sms_model->sendMessage($data);
        if ($sms_result[ "code" ] < 0)
            return $sms_result;

        return $this->success();
    }

    /**
     * 设置会员交易密码
     * @param unknown $member_id
     * @param unknown $old_password
     * @param unknown $new_password
     */
    public function modifyMemberPayPassword($member_id, $password)
    {
        $res = model('member')->update([
            'pay_password' => data_md5($password)
        ], [ [ 'member_id', '=', $member_id ] ]);
        if ($res === false) {
            return $this->error('', 'RESULT_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 会员是否已设置支付密码
     * @param unknown $member_id
     */
    public function memberIsSetPayPassword($member_id)
    {
        $info = model('member')->getInfo([ [ 'member_id', '=', $member_id ] ], 'pay_password');
        if (empty($info[ 'pay_password' ])) return $this->success(0);
        else return $this->success(1);
    }

    /**
     * 检测会员支付密码是否正确
     * @param unknown $member_id
     * @param unknown $pay_password
     */
    public function checkPayPassword($member_id, $pay_password)
    {
        $res = model('member')->getCount([
            [ 'pay_password', '=', data_md5($pay_password) ],
            [ 'member_id', '=', $member_id ]
        ]);
        if ($res > 0) {
            return $this->success($res);
        } else {
            return $this->error('', 'PAY_PASSWORD_ERROR');
        }
    }

    /**
     * 找回密码发送验证码
     * @param $data
     * @return array|mixed|void
     */
    public function paypasswordCode($data)
    {
        //发送短信
        $sms_model = new Sms();
        $var_parse = array (
            "code" => $data[ "code" ],//验证码
        );
        $member_info_result = $this->getMemberInfo([ [ "member_id", "=", $data[ "member_id" ] ] ], "mobile");
        $member_info = $member_info_result[ "data" ];
        $data[ "sms_account" ] = $member_info[ "mobile" ] ?? '';//通过member_id获得手机号
        $data[ "var_parse" ] = $var_parse;
        $sms_result = $sms_model->sendMessage($data);
        if ($sms_result[ "code" ] < 0)
            return $sms_result;

        return $this->success();
    }

    /**
     * 拉取用户头像到本地
     * @param unknown $token
     */
    public function pullHeadimg($member_id)
    {
        $member_info = model("member")->getInfo([ [ 'member_id', '=', $member_id ] ], 'headimg');
        if (!empty($member_info[ 'headimg' ]) && is_url($member_info[ 'headimg' ])) {
            $upload = new Upload();
            $res = $upload->setPath("headimg/" . date("Ymd") . '/')->remotePull($member_info[ 'headimg' ]);
            if ($res[ 'code' ] >= 0) {
                model("member")->update([ 'headimg' => $res[ 'data' ][ 'pic_path' ] ], [ [ 'member_id', '=', $member_id ] ]);
            }
        }
    }

    /**
     * 获取店铺会员数量
     * @param unknown $condition
     * @param string $alias
     * @param unknown $join
     */
    public function getMemberAreaCount($condition, $alias = 'a', $join = [], $group = null)
    {
        $db = Db::name('member')->where($condition);
        if (!empty($join)) {
            $db = $this->parseJoin($db->alias($alias), $join);
        }
        if (!empty($group)) {
            $db = $db->group($group);
        }
        $count = $db->count();
        return $this->success($count);
    }

    /**
     * 按地域分布查询会员数量
     * @param unknown $site_id
     * @param string $handle
     */
    public function getMemberCountByArea($site_id, $handle = false)
    {
        $total_count = $this->getMemberAreaCount([ [ 'site_id', '=', $site_id ],['is_delete','=',0] ]);

        $address = new Address();
        $list = $address->getAreaList([ [ 'pid', '=', 0 ] ], 'id,shortname', 'sort asc');

        $data = [];

        if ($total_count[ 'data' ]) {
            foreach ($list[ 'data' ] as $item) {
                $count = $this->getMemberAreaCount([ [ 'nsm.site_id', '=', $site_id ], [ 'nma.is_default', '=', 1 ], [ 'nma.province_id', '=', $item[ 'id' ] ],['nsm.is_delete', '=', 0] ], 'nsm', [ [ 'member_address nma', 'nsm.member_id = nma.member_id', 'left' ] ], 'nma.member_id');
                if ($handle) {
                    if ($count[ 'data' ] > 0) {
                        array_push($data, [
                            'name' => $item[ 'shortname' ],
                            'value' => $count[ 'data' ],
                            'ratio' => $count[ 'data' ] > 0 ? sprintf("%.2f", $count[ 'data' ] / $total_count[ 'data' ] * 100) : 0
                        ]);
                    }
                } else {
                    array_push($data, [
                        'name' => $item[ 'shortname' ],
                        'value' => $count[ 'data' ],
                        'ratio' => $count[ 'data' ] > 0 ? sprintf("%.2f", $count[ 'data' ] / $total_count[ 'data' ] * 100) : 0
                    ]);
                }
            }
        }

        if ($handle) {
            array_multisort(array_column($data, 'value'), SORT_DESC, $data);
        }

        return $this->success([
            'page_count' => 1,
            'count' => $total_count[ 'data' ],
            'list' => $data
        ]);
    }

    /**
     * 处理表连接
     * @param unknown $db_obj
     * @param unknown $join
     */
    protected function parseJoin($db_obj, $join)
    {
        foreach ($join as $item) {
            list($table, $on, $type) = $item;
            $type = strtolower($type);
            switch ( $type ) {
                case "left":
                    $db_obj = $db_obj->leftJoin($table, $on);
                    break;
                case "inner":
                    $db_obj = $db_obj->join($table, $on);
                    break;
                case "right":
                    $db_obj = $db_obj->rightjoin($table, $on);
                    break;
                case "full":
                    $db_obj = $db_obj->fulljoin($table, $on);
                    break;
                default:
                    break;
            }
        }
        return $db_obj;
    }

    /**
     *
     */
    public function getMemberImportLogList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {

        $list = model('member_import_log')->pageList($condition, $field, $order, $page, $page_size, '', '', '');

        if (!empty($list['list'])) {
            foreach ($list['list'] as $key => $val) {
                $list['list'][ $key ][ "create_time" ] = date('Y-m-d H:i:s', $val[ 'create_time' ]);
            }
        }

        return $this->success($list);
    }

    /**
     * @param $param
     * @param $site_id
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \think\exception\PDOException
     */
    public function importMember($param, $site_id)
    {
        $PHPExcel = new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        //载入文件
        $PHPExcel = $PHPReader->load($param[ 'path' ]);

        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);

        //获取总行数
        $allRow = $currentSheet->getHighestRow();

        if ($allRow < 2) {
            return $this->error('', '导入了一个空文件');
        }

        $index = $param[ 'index' ];

        //每次导入100条
        $length = $index * 100;
        if($index == 1){
            $num = 2;
            $success_num = 0;
            $error_num = 0;

            $data_record = [
                "member_num" => ($allRow - 1),
                "success_num" => 0,
                "error_num" => 0,
                "create_time" => time(),
                "status_name" => "等待导入"
            ];
            $record = model('member_import_record')->add($data_record);

        }else{
            $num = (($index - 1 ) * 100) + 1;
            $success_num = $param['success_num'];
            $error_num = $param['error_num'];
            $record = $param['record'];
        }
        $type_num = 0;
        model('member')->startTrans();
        try {


            for ($i = $num; $i <= $length; $i++) {

                if($i > $allRow){
                    break;
                }
                $type_num = $i;
                //用户名
                $username = $PHPExcel->getActiveSheet()->getCell('A' . $i)->getValue();
                $username = trim($username, ' ');

                //手机号
                $mobile = $PHPExcel->getActiveSheet()->getCell('B' . $i)->getValue();
                $mobile = trim($mobile, ' ');

                //昵称
                $nickname = $PHPExcel->getActiveSheet()->getCell('C' . $i)->getValue();
                $nickname = trim($nickname, ' ');

                //密码（明文）
                $password = $PHPExcel->getActiveSheet()->getCell('D' . $i)->getValue();
                $password = trim($password, ' ');

                //微信公众号openid
                $wx_openid = $PHPExcel->getActiveSheet()->getCell('E' . $i)->getValue();
                $wx_openid = trim($wx_openid, ' ');

                //微信小程序openid
                $weapp_openid = $PHPExcel->getActiveSheet()->getCell('F' . $i)->getValue();
                $weapp_openid = trim($weapp_openid, ' ');

                //真实姓名
                $realname = $PHPExcel->getActiveSheet()->getCell('G' . $i)->getValue();
                $realname = trim($realname, ' ');

                //积分
                $point = $PHPExcel->getActiveSheet()->getCell('H' . $i)->getValue();
                $point = trim($point, ' ');

                //成长值
                $growth = $PHPExcel->getActiveSheet()->getCell('I' . $i)->getValue();
                $growth = trim($growth, ' ');

                //余额(可提现)
                $balance_money = $PHPExcel->getActiveSheet()->getCell('J' . $i)->getValue();
                $balance_money = trim($balance_money, ' ');

                //余额(不可提现)
                $balance = $PHPExcel->getActiveSheet()->getCell('K' . $i)->getValue();
                $balance = trim($balance, ' ');

                //会员等级(id)
                $membeer_level_id = $PHPExcel->getActiveSheet()->getCell('K' . $i)->getValue();
                $membeer_level_id = trim($membeer_level_id, ' ');

                $not_data = [
                    "username" => $username,
                    "mobile" => $mobile,
                    "nickname" => $nickname,
                    "password" => $password,
                    "wx_openid" => $wx_openid,
                    "weapp_openid" => $weapp_openid,
                    "realname" => $realname,
                    "create_time" => time(),
                    "record_id" => $record
                ];

                if ($username == "" && $mobile == "") {
                    $not_data[ 'content' ] = "失败，用户名或手机号必须存在一个";
                    model('member_import_log')->add($not_data);
                    $error_num ++;
                    continue;
                }

                if ($nickname == "") {
                    $not_data[ 'content' ] = "失败，用户昵称不能为空";
                    model('member_import_log')->add($not_data);
                    $error_num ++;
                    continue;
                }

                if ($password == "") {
                    $not_data[ 'content' ] = "失败，用户密码不能为空";
                    model('member_import_log')->add($not_data);
                    $error_num ++;
                    continue;
                }
                if($username){
                    $username_res = model("member")->getInfo([ 'username' => $username ]);//根据用户名查找
                    if ($username_res) {
                        $not_data[ 'content' ] = "失败，已存在相同的用户名";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        continue;
                    }
                }

                if($mobile){
                    $mobile_res = model("member")->getInfo([ 'mobile' => $mobile ]);//根据手机号查找
                    if ($mobile_res) {
                        $not_data[ 'content' ] = "失败，已存在相同的手机号";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        continue;
                    }
                }

                if($wx_openid){
                    $wx_openid_res = model("member")->getInfo([ 'wx_openid' => $wx_openid ]);//根据微信公众号ID查找
                    if ($wx_openid_res) {
                        $not_data[ 'content' ] = "失败，已存在相同的公众号openid";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        continue;
                    }
                }

                if($weapp_openid){
                    $weapp_openid_res = model("member")->getInfo([ 'weapp_openid' => $weapp_openid ]);//根据小程序ID查找
                    if ($weapp_openid_res) {
                        $not_data[ 'content' ] = "失败，已存在相同的小程序openid";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        continue;
                    }
                }

                if($membeer_level_id == ""){
                    $member_level_info = model('member_level')->getInfo([ 'is_default' => 1 ]);
                    if (empty($member_level_info)) {
                        $not_data[ 'content' ] = "失败，未设置默认会员等级";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        break;
                    }
                }else{
                    $member_level_info = model('member_level')->getInfo([ 'level_id' => $membeer_level_id ]);
                    if (empty($member_level_info)) {
                        $not_data[ 'content' ] = "失败，未查到该会员等级";
                        model('member_import_log')->add($not_data);
                        $error_num ++;
                        break;
                    }
                }

                $data = [
                    "username" => isset($username) ? $username : '',
                    "mobile" => isset($mobile) ? $mobile : '',
                    "nickname" => $nickname,
                    "password" => data_md5($password),
                    "member_level" => $member_level_info[ 'level_id' ],
                    "wx_openid" => isset($wx_openid) ? $wx_openid : '',
                    "weapp_openid" => isset($weapp_openid) ? $weapp_openid : '',
                    "realname" => isset($realname) ? $realname : '',
                    'member_level_name' => $member_level_info[ 'level_name' ],
                    'point' => isset($point) ? $point : 0,
                    'growth' => isset($growth) ? $growth : 0,
                    'balance_money' => isset($balance_money) ? $balance_money : 0.00,
                    'balance' => isset($balance) ? $balance : 0.00,
                    'reg_time' => time(),
                    'login_time' => time(),
                    'last_login_time' => time(),
                    'site_id' => 1
                ];

                model('member')->add($data);
                $not_data[ 'content' ] = "成功";
                model('member_import_log')->add($not_data);
                $success_num ++;
            }
            model('member')->commit();
            if($success_num + $error_num == ($allRow - 1)){
                $data_record = [
                    "member_num" => ($allRow - 1),
                    "success_num" => $success_num,
                    "error_num" => $error_num,
                    "create_time" => time(),
                    "status_name" => "导入成功"
                ];
                model('member_import_record')->update($data_record, ['id' => $record]);
            }
            return $this->success([
                "allRow" => $allRow,
                "num" => $type_num,
                "path" => $param[ 'path' ],
                "name" => $param['filename'],
                "success_num" => $success_num,
                "error_num" => $error_num,
                "record" => $record
            ]);
        } catch (\Exception $e) {
            model('member')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取用户黑名单
     * @return array
     */
    public function getMemberBlacklist($site_id)
    {
        $cache = Cache::get('member_blacklist_' . $site_id);
        if (!empty($cache)) return $this->success($cache);

        $blacklist = model('member')->getColumn([['status', '=', 0]], 'member_id');
        Cache::set('member_blacklist_' . $site_id, $blacklist);

        return $this->success($blacklist);
    }

    /**
     *  获取会员导入记录列表
     */
    public function getMemberImportRecordList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {

        $list = model('member_import_record')->pageList($condition, $field, $order, $page, $page_size, '', '', '');

        if (!empty($list['list'])) {
            foreach ($list['list'] as $key => $val) {
                $list['list'][ $key ][ "create_time" ] = date('Y-m-d H:i:s', $val[ 'create_time' ]);
            }
        }

        return $this->success($list);
    }

    /**
     * 获取导入记录单条数据
     */
    public function getMemberImportRecordInfo($id){

        $info = model('member_import_record')->getInfo(['id' => $id]);

        return $this->success($info);
    }
}