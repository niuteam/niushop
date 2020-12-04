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

use addon\fenxiao\model\Fenxiao;
use app\model\member\Member as MemberModel;
use app\model\member\MemberAddress as MemberAddressModel;
use app\model\member\MemberLabel as MemberLabelModel;
use app\model\member\MemberLevel as MemberLevelModel;
use app\model\member\MemberAccount as MemberAccountModel;
use app\model\member\Config as ConfigModel;
use extend\Poster;
use think\facade\Db;
use phpoffice\phpexcel\Classes\PHPExcel;
use phpoffice\phpexcel\Classes\PHPExcel\Writer\Excel2007;
use app\model\upload\Upload as UploadModel;
use app\model\member\MemberCluster as MemberClusterModel;
use think\facade\Config;

/**
 * 会员管理 控制器
 */
class Member extends BaseShop
{
    /*
     *  会员概况
     */
    public function index()
    {

        $member = new MemberModel();

        // 累计会员数
        $total_count = $member->getMemberCount([ [ 'site_id', '=', $this->site_id ] ]);
        // 今日新增数
        $newadd_count = $member->getMemberCount([ [ 'site_id', '=', $this->site_id ], [ 'reg_time', 'between', [ date_to_time(date('Y-m-d 00:00:00')), time() ] ] ]);
        // 已购会员数
        $buyed_count = $member->getMemberCount([ [ 'site_id', '=', $this->site_id ], [ 'order_complete_num', '>', 0 ] ]);

        $this->assign('data', [
            'total_count' => $total_count[ 'data' ],
            'newadd_count' => $newadd_count[ 'data' ],
            'buyed_count' => $buyed_count[ 'data' ]
        ]);
        return $this->fetch('member/index');
    }

    /**
     * 获取区域会员数量
     */
    public function areaCount()
    {
        if (request()->isAjax()) {
            $member = new MemberModel();
            $handle = input('handle', false);
            $res = $member->getMemberCountByArea($this->site_id, $handle);
            return $res;
        }
    }

    /**
     * 会员列表
     */
    public function memberList()
    {
        //判断分销是否存在
        $is_exit_fenxiao = addon_is_exit('fenxiao');
        $cluster_id = input('cluster_id', '');//获取会员群体
        $member_cluster_model = new MemberClusterModel();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'username');//可以传username mobile email
            $level_id = input('level_id', 0);
            $label_id = input('label_id', 0);
            $reg_start_date = input('reg_start_date', '');
            $reg_end_date = input('reg_end_date', '');
            $status = input('status', '');
            $cluster_id = input('cluster_id', '');//获取会员群体
            $last_login_time_start = input('last_login_time_start', '');//上次登录时间
            $last_login_time_end = input('last_login_time_end', '');
            $start_order_complete_num = input('start_order_complete_num', '');//成交次数
            $end_order_complete_num = input('end_order_complete_num', '');
            $start_order_complete_money = input('start_order_complete_money', '');//消费金额
            $end_order_complete_money = input('end_order_complete_money', '');
            $start_point = input('start_point', '');//积分
            $end_point = input('end_point', '');
            $start_balance = input('start_balance', '');//余额
            $end_balance = input('end_balance', '');
            $start_growth = input('start_growth', '');//成长值
            $end_growth = input('end_growth', '');
            $login_type = input('login_type', '');//来源渠道

            $condition[] = [ 'site_id', '=', $this->site_id ];
            //下拉选择
            $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            //会员等级
            if ($level_id != 0) {
                $condition[] = [ 'member_level', '=', $level_id ];
            }
            //会员标签
            if ($label_id != 0) {
                //raw方法变为public类型 需要实例化以后调用
                $condition[] = [ "", 'exp', Db::raw("FIND_IN_SET({$label_id}, member_label)") ];
            }
            //注册时间
            if ($reg_start_date != '' && $reg_end_date != '') {
                $condition[] = [ 'reg_time', 'between', [ strtotime($reg_start_date), strtotime($reg_end_date) ] ];
            } else if ($reg_start_date != '' && $reg_end_date == '') {
                $condition[] = [ 'reg_time', '>=', strtotime($reg_start_date) ];
            } else if ($reg_start_date == '' && $reg_end_date != '') {
                $condition[] = [ 'reg_time', '<=', strtotime($reg_end_date) ];
            }
            //会员状态
            if ($status != '') {
                $condition[] = [ 'status', '=', $status ];
            }

            //会员群体
            if ($cluster_id != '') {
                //获取会员群体的member_id值
                $member_cluster_info = $member_cluster_model->getMemberClusterInfo(["cluster_id" => $cluster_id],'member_ids');
                if(!empty($member_cluster_info['data']['member_ids'])){
                    $condition[] = [ 'member_id', 'in', $member_cluster_info['data']['member_ids'] ];
                }
            }
            //上次访问时间
            if ($last_login_time_start != '' && $last_login_time_end != '') {
                $condition[] = [ 'last_login_time', 'between', [ strtotime($last_login_time_start), strtotime($last_login_time_end) ] ];
            } else if ($last_login_time_start != '' && $last_login_time_end == '') {
                $condition[] = [ 'last_login_time', '>=', strtotime($last_login_time_start) ];
            } else if ($last_login_time_start == '' && $last_login_time_end != '') {
                $condition[] = [ 'last_login_time', '<=', strtotime($last_login_time_end) ];
            }
            //成交次数
            if ($start_order_complete_num != '' && $end_order_complete_num != '') {
                $condition[] = [ 'order_complete_num', 'between', [ $start_order_complete_num, $end_order_complete_num ] ];
            } else if ($start_order_complete_num != '' && $end_order_complete_num == '') {
                $condition[] = [ 'order_complete_num', '>=', $start_order_complete_num ];
            } else if ($start_order_complete_num == '' && $end_order_complete_num != '') {
                $condition[] = [ 'order_complete_num', '<=', $end_order_complete_num ];
            }
            //消费金额
            if ($start_order_complete_money != '' && $end_order_complete_money != '') {
                $condition[] = [ 'order_complete_num', 'between', [ $start_order_complete_money, $end_order_complete_money ] ];
            } else if ($start_order_complete_money != '' && $end_order_complete_money == '') {
                $condition[] = [ 'order_complete_num', '>=', $start_order_complete_money ];
            } else if ($start_order_complete_money == '' && $end_order_complete_money != '') {
                $condition[] = [ 'order_complete_num', '<=', $end_order_complete_money ];
            }
            //积分
            if ($start_point != '' && $end_point != '') {
                $condition[] = [ 'point', 'between', [ $start_point, $end_point ] ];
            } else if ($start_point != '' && $end_point == '') {
                $condition[] = [ 'point', '>=', $start_point ];
            } else if ($start_point == '' && $end_point != '') {
                $condition[] = [ 'point', '<=', $end_point ];
            }
            //余额
            if ($start_balance != '' && $end_balance != '') {
                $condition[] = [ 'balance', 'between', [ $start_balance, $end_balance ] ];
            } else if ($start_balance != '' && $end_balance == '') {
                $condition[] = [ 'balance', '>=', $start_balance ];
            } else if ($start_balance == '' && $end_balance != '') {
                $condition[] = [ 'balance', '<=', $end_balance ];
            }
            //成长值
            if ($start_growth != '' && $end_growth != '') {
                $condition[] = [ 'growth', 'between', [ $start_growth, $end_growth ] ];
            } else if ($start_growth != '' && $end_growth == '') {
                $condition[] = [ 'growth', '>=', $start_growth ];
            } else if ($start_growth == '' && $end_growth != '') {
                $condition[] = [ 'growth', '<=', $end_growth ];
            }
            //来源渠道
            if ($login_type != '') {
                $condition[] = [ 'login_type', '=', $login_type ];
            }

            $order = 'reg_time desc';
            $field = '*';

            $member_model = new MemberModel();
            $result = $member_model->getMemberPageList($condition, $page, $page_size, $order, $field);
            if ($is_exit_fenxiao == 1) {
                $list = $result[ 'data' ][ 'list' ];
                if (!empty($list)) {

                    $fenxiao_model = new Fenxiao();
                    foreach ($list as $k => $v) {

                        if ($v[ 'is_fenxiao' ] == 1) {
                            $parent_fenxiao_name = $fenxiao_model->getParentFenxiaoName($v[ 'fenxiao_id' ], 2);
                        } else {
                            $parent_fenxiao_name = $fenxiao_model->getParentFenxiaoName($v[ 'fenxiao_id' ], 1);
                        }
                        $list[ $k ][ 'parent_fenxiao_name' ] = $parent_fenxiao_name;
                    }
                }

                $result[ 'data' ][ 'list' ] = $list;
            }

            return $result;
        } else {
            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([ [ 'site_id', '=', $this->site_id ] ], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员标签
            $member_label_model = new MemberLabelModel();
            $member_label_list = $member_label_model->getMemberLabelList([ [ 'site_id', '=', $this->site_id ] ], 'label_id, label_name', 'sort asc');
            $this->assign('member_label_list', $member_label_list[ 'data' ]);

            /*奖励规则*/
            //积分
            $point = event('MemberAccountRule', [ 'account' => 'point', 'site_id' => $this->site_id ]);
            $this->assign('point', $point);
            //余额
            $balance = event('MemberAccountRule', [ 'account' => 'balance', 'site_id' => $this->site_id ]);
            $this->assign('balance', $balance);
            //成长值
            $growth = event('MemberAccountRule', [ 'account' => 'growth', 'site_id' => $this->site_id ]);
            $this->assign('growth', $growth);

            $this->assign('is_exit_fenxiao', $is_exit_fenxiao);

            //会员群体
            $member_cluster_list = $member_cluster_model->getMemberClusterList([ [ 'site_id', '=', $this->site_id ] ], 'cluster_id, cluster_name', 'create_time desc');
            $this->assign('member_cluster_list', $member_cluster_list[ 'data' ]);
            $this->assign('cluster_id', $cluster_id);

            //订单来源 (支持端口)
            $order_from = Config::get("app_type");
            $this->assign('order_from_list', $order_from);
            return $this->fetch('member/member_list');
        }
    }

    /**
     * 会员添加
     */
    public function addMember()
    {
        if (request()->isAjax()) {
            $data = [
                'site_id' => $this->site_id,
                'username' => input('username', ''),
                'mobile' => input('mobile', ''),
                'email' => input('email', ''),
                'password' => data_md5(input('password', '')),
                'status' => input('status', 1),
                'headimg' => input('headimg', ''),
                'member_level' => input('member_level', ''),
                'member_level_name' => input('member_level_name', ''),
                'nickname' => input('nickname', ''),
                'sex' => input('sex', 0),
                'birthday' => input('birthday', '') ? strtotime(input('birthday', '')) : 0,
                'realname' => input('realname', ''),
                'reg_time' => time(),
            ];

            $member_model = new MemberModel();
            $this->addLog("添加会员" . $data[ 'username' ] . $data[ 'mobile' ]);
            return $member_model->addMember($data);
        } else {
            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([ [ 'site_id', '=', $this->site_id ] ], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            return $this->fetch('member/add_member');
        }
    }

    /**
     * 会员编辑
     */
    public function editMember()
    {
        if (request()->isAjax()) {
            $data = [
                'mobile' => input('mobile', ''),
                'email' => input('email', ''),
                'status' => input('status', 1),
                'headimg' => input('headimg', ''),
                'member_level' => input('member_level', ''),
                'member_level_name' => input('member_level_name', ''),
                'nickname' => input('nickname', ''),
                'sex' => input('sex', 0),
                'birthday' => input('birthday', '') ? strtotime(input('birthday', '')) : 0,
            ];

            $member_id = input('member_id', 0);
            $member_model = new MemberModel();
            $this->addLog("编辑会员:id" . $member_id, $data);
            return $member_model->editMember($data, [ [ 'member_id', '=', $member_id ] ]);
        } else {

            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([ [ 'site_id', '=', $this->site_id ] ], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员信息
            $member_id = input('member_id', 0);
            $member_model = new MemberModel();
            $member_info = $member_model->getMemberInfo([ [ 'member_id', '=', $member_id ] ]);
            $this->assign('member_info', $member_info);

            //会员详情四级菜单
            $this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/edit_member');
        }
    }

    /**
     * 会员删除
     */
    public function deleteMember()
    {
        $member_ids = input('member_ids', '');
        $member_model = new MemberModel();
        $this->addLog("删除会员:id" . $member_ids);
        return $member_model->deleteMember([ [ 'member_id', 'in', $member_ids ], [ 'site_id', '=', $this->site_id ] ]);
    }

    /**
     * 修改会员标签
     */
    public function modifyLabel()
    {
        $member_ids = input('member_ids', '');
        $label_ids = input('label_ids', '');
        $member_model = new MemberModel();
        return $member_model->modifyMemberLabel($label_ids, [ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 修改会员状态
     */
    public function modifyStatus()
    {
        $member_ids = input('member_ids', '');
        $status = input('status', 0);
        $member_model = new MemberModel();
        return $member_model->modifyMemberStatus($status, [ [ 'member_id', 'in', $member_ids ], ['site_id', '=', $this->site_id ] ]);
    }

    /**
     * 修改会员密码
     */
    public function modifyPassword()
    {
        $member_ids = input('member_ids', '');
        $password = input('password', '123456');
        $member_model = new MemberModel();
        return $member_model->resetMemberPassword($password, [ [ 'member_id', 'in', $member_ids ] ]);
    }

    /**
     * 账户详情
     */
    public function accountDetail()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $account_type = input('account_type', '');
            $from_type = input('from_type', '');
            $start_date = input('start_date', '');
            $end_date = input('end_date', '');
            $member_id = input('member_id', 0);

            $condition[] = [ 'site_id', '=', $this->site_id ];
            $condition[] = [ 'member_id', '=', $member_id ];
            //账户类型
            if ($account_type != '') {
                $condition[] = [ 'account_type', '=', $account_type ];
            }
            //来源类型
            if ($from_type != '') {
                $condition[] = [ 'from_type', '=', $from_type ];
            }
            //发生时间
            if ($start_date != '' && $end_date != '') {
                $condition[] = [ 'create_time', 'between', [ strtotime($start_date), strtotime($end_date) ] ];
            } else if ($start_date != '' && $end_date == '') {
                $condition[] = [ 'create_time', '>=', strtotime($start_date) ];
            } else if ($start_date == '' && $end_date != '') {
                $condition[] = [ 'create_time', '<=', strtotime($end_date) ];
            }

            $member_account_model = new MemberAccountModel();
            $res = $member_account_model->getMemberAccountPageList($condition, $page, $page_size);
            $account_type_arr = $member_account_model->getAccountType();
            foreach ($res[ 'data' ][ 'list' ] as $key => $val) {
                $res[ 'data' ][ 'list' ][ $key ][ 'account_type_name' ] = $account_type_arr[ $val[ 'account_type' ] ];
            }
            return $res;

        } else {
            $member_id = input('member_id', 0);

            //会员信息
            $member_model = new MemberModel();
            $member_info = $member_model->getMemberDetail($member_id);
            $this->assign('member_info', $member_info[ 'data' ]);

            //账户类型和来源类型
            $member_account_model = new MemberAccountModel();
            $account_type_arr = $member_account_model->getAccountType();
//			$from_type_arr = $member_account_model->getFromType();
            $this->assign('account_type_arr', $account_type_arr);
//			$this->assign('from_type_arr', $from_type_arr['point']);

            //会员详情四级菜单
            $this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/account_detail');
        }
    }

    /**
     * 余额调整（不可提现）
     */
    public function adjustBalance()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员余额调整id:" . $member_id . "金额" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($this->site_id, $member_id, 'balance', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 余额调整（可提现）
     */
    public function adjustBalanceMoney()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员余额调整id:" . $member_id . "金额" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($this->site_id, $member_id, 'balance_money', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 积分调整
     */
    public function adjustPoint()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员积分调整id:" . $member_id . "数量" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($this->site_id, $member_id, 'point', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 成长值调整
     */
    public function adjustGrowth()
    {
        $member_id = input('member_id', 0);
        $adjust_num = input('adjust_num', 0);
        $remark = input('remark', '');
        $this->addLog("会员成长值调整id:" . $member_id . "数量" . $adjust_num);
        $member_account_model = new MemberAccountModel();
        return $member_account_model->addMemberAccount($this->site_id, $member_id, 'growth', $adjust_num, 'adjust', 0, $remark);
    }

    /**
     * 注册协议
     */
    public function regAgreement()
    {
        if (request()->isAjax()) {
            //设置注册协议
            $title = input('title', '');
            $content = input('content', '');
            $config_model = new ConfigModel();
            return $config_model->setRegisterDocument($title, $content, $this->site_id, 'shop');
        } else {
            //获取注册协议
            $config_model = new ConfigModel();
            $document_info = $config_model->getRegisterDocument($this->site_id, 'shop');
            $this->assign('document_info', $document_info);

            return $this->fetch('member/reg_agreement');
        }
    }

    /**
     * 注册设置
     */
    public function regConfig()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            //设置注册设置
            $data = array (
                'login' => input('login', ''),
                'register' => input('register', ''),
                'pwd_len' => input('pwd_len', 6),
                'pwd_complexity' => input('pwd_complexity', 'number,letter,upper_case,symbol'),
                'third_party' => input('third_party', 0),
                'bind_mobile' => input('bind_mobile', 0),
            );
            return $config_model->setRegisterConfig($data, $this->site_id, 'shop');
        } else {
            //获取注册设置
            $config_info = $config_model->getRegisterConfig($this->site_id, 'shop');
            $value = $config_info[ 'data' ][ 'value' ];
            if (!empty($value)) {
                $value[ 'pwd_complexity_arr' ] = explode(',', $value[ 'pwd_complexity' ]);
                $value[ 'login' ] = explode(',', $value[ 'login' ]);
                $value[ 'register' ] = explode(',', $value[ 'register' ]);
            }
            $this->assign('value', $value);
            return $this->fetch('member/reg_config');
        }
    }

    /**
     * 注销协议
     */
    public function cancelAgreement()
    {
        if (request()->isAjax()) {
            //设置注销协议
            $title = input('title', '');
            $content = input('content', '');
            $config_model = new ConfigModel();
            return $config_model->setCancelDocument($title, $content, $this->site_id, 'shop');
        } else {
            //获取注销协议
            $config_model = new ConfigModel();
            $document_info = $config_model->getCancelDocument($this->site_id, 'shop');
            $this->assign('document_info', $document_info);

            return $this->fetch('member/cancel_agreement');
        }
    }

    /**
     * 注销设置
     */
    public function cancelConfig()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            //设置注册设置
            $data = array (
                'is_enable' => input('is_enable', 0),
                'is_audit' => input('is_audit', 1),
            );
            return $config_model->setCancelConfig($data, $this->site_id, 'shop');
        } else {
            //获取注册设置
            $config_info = $config_model->getCancelConfig($this->site_id, 'shop');
            $value = $config_info[ 'data' ][ 'value' ];

            $this->assign('value', $value);
            return $this->fetch('member/cancel_config');
        }
    }

    /**
     * 搜索会员
     * 不是菜单 不入权限
     */
    public function searchMember()
    {
        $search_text = input('search_text', '');
        $member_model = new MemberModel();
        $member_info = $member_model->getMemberInfo([ [ 'username|mobile', '=', $search_text ], [ 'site_id', '=', $this->site_id ] ]);
        return $member_info;
    }

    /**
     * 导出会员信息
     */
    public function exportMember()
    {
        //获取会员信息
        $search_text = input('search_text', '');
        $search_text_type = input('search_text_type', 'username');//可以传username mobile email
        $level_id = input('level_id', 0);
        $label_id = input('label_id', 0);
        $reg_start_date = input('reg_start_date', '');
        $reg_end_date = input('reg_end_date', '');
        $status = input('status', '');
        $cluster_id = input('cluster_id', '');//获取会员群体
        $last_login_time_start = input('last_login_time_start', '');//上次登录时间
        $last_login_time_end = input('last_login_time_end', '');
        $start_order_complete_num = input('start_order_complete_num', '');//成交次数
        $end_order_complete_num = input('end_order_complete_num', '');
        $start_order_complete_money = input('start_order_complete_money', '');//消费金额
        $end_order_complete_money = input('end_order_complete_money', '');
        $start_point = input('start_point', '');//积分
        $end_point = input('end_point', '');
        $start_balance = input('start_balance', '');//余额
        $end_balance = input('end_balance', '');
        $start_growth = input('start_growth', '');//成长值
        $end_growth = input('end_growth', '');
        $login_type = input('login_type', '');//来源渠道

        $condition[] = [ 'site_id', '=', $this->site_id ];
        //下拉选择
        $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
        //会员等级
        if ($level_id != 0) {
            $condition[] = [ 'member_level', '=', $level_id ];
        }
        //会员标签
        if ($label_id != 0) {
            //raw方法变为public类型 需要实例化以后调用
            $condition[] = [ "", 'exp', Db::raw("FIND_IN_SET({$label_id}, member_label)") ];
        }
        //注册时间
        if ($reg_start_date != '' && $reg_end_date != '') {
            $condition[] = [ 'reg_time', 'between', [ strtotime($reg_start_date), strtotime($reg_end_date) ] ];
        } else if ($reg_start_date != '' && $reg_end_date == '') {
            $condition[] = [ 'reg_time', '>=', strtotime($reg_start_date) ];
        } else if ($reg_start_date == '' && $reg_end_date != '') {
            $condition[] = [ 'reg_time', '<=', strtotime($reg_end_date) ];
        }
        //会员状态
        if ($status != '') {
            $condition[] = [ 'status', '=', $status ];
        }

        //会员群体
        $member_cluster_model = new MemberClusterModel();
        if ($cluster_id != '') {
            //获取会员群体的member_id值
            $member_cluster_info = $member_cluster_model->getMemberClusterInfo(["cluster_id" => $cluster_id],'member_ids');
            if(!empty($member_cluster_info['data']['member_ids'])){
                $condition[] = [ 'member_id', 'in', $member_cluster_info['data']['member_ids'] ];
            }
        }
        //上次访问时间
        if ($last_login_time_start != '' && $last_login_time_end != '') {
            $condition[] = [ 'last_login_time', 'between', [ strtotime($last_login_time_start), strtotime($last_login_time_end) ] ];
        } else if ($last_login_time_start != '' && $last_login_time_end == '') {
            $condition[] = [ 'last_login_time', '>=', strtotime($last_login_time_start) ];
        } else if ($last_login_time_start == '' && $last_login_time_end != '') {
            $condition[] = [ 'last_login_time', '<=', strtotime($last_login_time_end) ];
        }
        //成交次数
        if ($start_order_complete_num != '' && $end_order_complete_num != '') {
            $condition[] = [ 'order_complete_num', 'between', [ $start_order_complete_num, $end_order_complete_num ] ];
        } else if ($start_order_complete_num != '' && $end_order_complete_num == '') {
            $condition[] = [ 'order_complete_num', '>=', $start_order_complete_num ];
        } else if ($start_order_complete_num == '' && $end_order_complete_num != '') {
            $condition[] = [ 'order_complete_num', '<=', $end_order_complete_num ];
        }
        //消费金额
        if ($start_order_complete_money != '' && $end_order_complete_money != '') {
            $condition[] = [ 'order_complete_num', 'between', [ $start_order_complete_money, $end_order_complete_money ] ];
        } else if ($start_order_complete_money != '' && $end_order_complete_money == '') {
            $condition[] = [ 'order_complete_num', '>=', $start_order_complete_money ];
        } else if ($start_order_complete_money == '' && $end_order_complete_money != '') {
            $condition[] = [ 'order_complete_num', '<=', $end_order_complete_money ];
        }
        //积分
        if ($start_point != '' && $end_point != '') {
            $condition[] = [ 'point', 'between', [ $start_point, $end_point ] ];
        } else if ($start_point != '' && $end_point == '') {
            $condition[] = [ 'point', '>=', $start_point ];
        } else if ($start_point == '' && $end_point != '') {
            $condition[] = [ 'point', '<=', $end_point ];
        }
        //余额
        if ($start_balance != '' && $end_balance != '') {
            $condition[] = [ 'balance', 'between', [ $start_balance, $end_balance ] ];
        } else if ($start_balance != '' && $end_balance == '') {
            $condition[] = [ 'balance', '>=', $start_balance ];
        } else if ($start_balance == '' && $end_balance != '') {
            $condition[] = [ 'balance', '<=', $end_balance ];
        }
        //成长值
        if ($start_growth != '' && $end_growth != '') {
            $condition[] = [ 'growth', 'between', [ $start_growth, $end_growth ] ];
        } else if ($start_growth != '' && $end_growth == '') {
            $condition[] = [ 'growth', '>=', $start_growth ];
        } else if ($start_growth == '' && $end_growth != '') {
            $condition[] = [ 'growth', '<=', $end_growth ];
        }
        //来源渠道
        if ($login_type != '') {
            $condition[] = [ 'login_type', '=', $login_type ];
        }

        $order = 'reg_time desc';
        $field = 'username,nickname,realname,mobile,sex,birthday,email,member_level_name,member_label_name,
        qq,location,balance,balance_money,point,growth,reg_time,last_login_ip,last_login_time';

        $member_model = new MemberModel();
        $list = $member_model->getMemberList($condition, $field, $order);

        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("会员信息");
        $phpExcel->getProperties()->setSubject("会员信息");
        // 对单元格设置居中效果
        $phpExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', '会员账号');//可以指定位置
        $phpExcel->getActiveSheet()->setCellValue('B1', '会员昵称');
        $phpExcel->getActiveSheet()->setCellValue('C1', '真实姓名');
        $phpExcel->getActiveSheet()->setCellValue('D1', '手机号');
        $phpExcel->getActiveSheet()->setCellValue('E1', '性别');
        $phpExcel->getActiveSheet()->setCellValue('F1', '生日');
        $phpExcel->getActiveSheet()->setCellValue('G1', '会员等级');
        $phpExcel->getActiveSheet()->setCellValue('H1', '会员标签');
        $phpExcel->getActiveSheet()->setCellValue('I1', 'qq');
        $phpExcel->getActiveSheet()->setCellValue('J1', '地址');
        $phpExcel->getActiveSheet()->setCellValue('K1', '余额');
        $phpExcel->getActiveSheet()->setCellValue('L1', '积分');
        $phpExcel->getActiveSheet()->setCellValue('M1', '成长值');
        $phpExcel->getActiveSheet()->setCellValue('N1', '上次登录时间');
        $phpExcel->getActiveSheet()->setCellValue('O1', '上次登录ip');
        $phpExcel->getActiveSheet()->setCellValue('P1', '注册时间');
        //循环添加数据（根据自己的逻辑）
        $sex = [ '保密', '男', '女' ];
        foreach ($list[ 'data' ] as $k => $v) {
            $i = $k + 2;
            $phpExcel->getActiveSheet()->setCellValue('A' . $i, $v[ 'username' ]);
            $phpExcel->getActiveSheet()->setCellValue('B' . $i, $v[ 'nickname' ]);
            $phpExcel->getActiveSheet()->setCellValue('C' . $i, $v[ 'realname' ]);
            $phpExcel->getActiveSheet()->setCellValue('D' . $i, $v[ 'mobile' ]);
            $phpExcel->getActiveSheet()->setCellValue('E' . $i, $sex[ $v[ 'sex' ] ]);
            $phpExcel->getActiveSheet()->setCellValue('F' . $i, date('Y-m-d', $v[ 'birthday' ]));
            $phpExcel->getActiveSheet()->setCellValue('G' . $i, $v[ 'member_level_name' ]);
            $phpExcel->getActiveSheet()->setCellValue('H' . $i, $v[ 'member_label_name' ]);
            $phpExcel->getActiveSheet()->setCellValue('I' . $i, $v[ 'qq' ]);
            $phpExcel->getActiveSheet()->setCellValue('J' . $i, $v[ 'location' ]);
            $phpExcel->getActiveSheet()->setCellValue('K' . $i, $v[ 'balance' ] + $v[ 'balance_money' ]);
            $phpExcel->getActiveSheet()->setCellValue('L' . $i, $v[ 'point' ]);
            $phpExcel->getActiveSheet()->setCellValue('M' . $i, $v[ 'growth' ]);
            $phpExcel->getActiveSheet()->setCellValue('N' . $i, date('Y-m-d H:i:s', $v[ 'last_login_time' ]));
            $phpExcel->getActiveSheet()->setCellValue('O' . $i, $v[ 'last_login_ip' ]);
            $phpExcel->getActiveSheet()->setCellValue('P' . $i, date('Y-m-d H:i:s', $v[ 'reg_time' ]));
        }

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('会员信息');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file = date('Y年m月d日-会员信息表', time()) . '.xlsx';
        $objWriter->save($file);

        header("Content-type:application/octet-stream");

        $filename = basename($file);
        header("Content-Disposition:attachment;filename = " . $filename);
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        readfile($file);
        unlink($file);
        exit;
    }

    /**
     * 订单管理
     */
    public function order()
    {
        $member_id = input("member_id", 0);//会员id
        $this->assign('member_id', $member_id);
        //会员详情四级菜单
        $this->forthMenu([ 'member_id' => $member_id ]);
        return $this->fetch('member/order');

    }

    /**
     * 会员地址
     */
    public function addressDetail()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $member_id = input('member_id', 0);

            $condition[] = [ 'site_id', '=', $this->site_id ];
            $condition[] = [ 'member_id', '=', $member_id ];

            //会员地址
            $member_address_model = new MemberAddressModel();
            $res = $member_address_model->getMemberAddressPageList($condition, $page, $page_size);
            return $res;

        } else {
            $member_id = input('member_id', 0);
            $this->assign('member_id', $member_id);

            //会员详情四级菜单
            $this->forthMenu([ 'member_id' => $member_id ]);

            return $this->fetch('member/address_detail');
        }
    }

    /**
     * 根据账户类型获取来源类型
     * @return array
     */
    public function getFromType()
    {
        $type = input('type', '');
        $model = new MemberAccountModel();
        $res = $model->getFromType();

        return $res[ $type ];
    }

    /**
     * 会员导入列表页
     */
    public function memberImport()
    {
        if (request()->isAjax()) {
            $member_model = new MemberModel();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $condition = [];
            $result = $member_model->getMemberImportRecordList($condition, $page, $page_size);
            return $result;
        }
        return $this->fetch('member/memberImport');
    }

    /**
     * 下载会员导入模板
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function downloadMemberFile()
    {
        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("会员导入模板");
        $phpExcel->getProperties()->setSubject("会员导入模板");
        // 对单元格设置居中效果
        $phpExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', '用户名');//可以指定位置
        $phpExcel->getActiveSheet()->setCellValue('B1', '手机号');
        $phpExcel->getActiveSheet()->setCellValue('C1', '昵称');
        $phpExcel->getActiveSheet()->setCellValue('D1', '密码(明文)');
        $phpExcel->getActiveSheet()->setCellValue('E1', '微信公众号openid');
        $phpExcel->getActiveSheet()->setCellValue('F1', '微信小程序openid');
        $phpExcel->getActiveSheet()->setCellValue('G1', '真实姓名');
        $phpExcel->getActiveSheet()->setCellValue('H1', '积分');
        $phpExcel->getActiveSheet()->setCellValue('I1', '成长值');
        $phpExcel->getActiveSheet()->setCellValue('J1', '余额(可提现)');
        $phpExcel->getActiveSheet()->setCellValue('K1', '余额(不可提现)');
        $phpExcel->getActiveSheet()->setCellValue('L1', '会员等级(id)');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file = date('Y年m月d日-会员导入模板', time()) . '.xlsx';
        $objWriter->save($file);

        header("Content-type:application/octet-stream");

        $filename = basename($file);
        header("Content-Disposition:attachment;filename = " . $filename);
        header("Accept-ranges:bytes");
        header("Accept-length:" . filesize($file));
        readfile($file);
        unlink($file);
        exit;
    }

    /**
     * 上传文件
     */
    public function file()
    {
        $upload_model = new UploadModel($this->site_id);

        $param = array (
            "name" => "file",
            'extend_type' => [ 'xlsx' ]
        );

        $result = $upload_model->setPath("common/member/member_import/" . date("Ymd") . '/')->file($param);
        return $result;
    }

    /**
     * 导入
     */
    public function import()
    {
        if (request()->isAjax()) {
            $filename = input('filename', '');
            $path = input('path', '');
            $index = input('index', '');
            $success_num = input('success_num', 0);
            $error_num = input('error_num', 0);
            $record = input('record', 0);
            $member_model = new MemberModel();

            $params = [
                'filename' => $filename,
                'path' => $path,
                'index' => $index,
                'success_num' => $success_num,
                "error_num" => $error_num,
                "record" => $record
            ];

            $res = $member_model->importMember($params, $this->site_id);
            return $res;
        }
    }

    /**
     * 黑名单
     * @return mixed
     */
    public function blacklist(){
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'username');//可以传username mobile email

            $condition[] = [ 'status', '=', 0 ];
            $condition[] = [ 'site_id', '=', $this->site_id ];
            //下拉选择
            $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            $order = 'reg_time desc';
            $field = '*';

            $member_model = new MemberModel();
            $result = $member_model->getMemberPageList($condition, $page, $page_size, $order, $field);
            return $result;
        }
        return $this->fetch('member/blacklist');
    }

    /*
     *  会员导入记录
     */
     public function memberimportlist(){

         if(request()->isAjax()){
             $member_model = new MemberModel();
             $id = input("id", 0);
             $condition['record_id'] = $id;
             $list = $member_model->getMemberImportLogList($condition);

             return $list;
         }

         $id = request()->get("id", 0);
         $member_model = new MemberModel();
         $info = $member_model->getMemberImportRecordInfo($id);
         $this->assign('info', $info);
         $this->assign('id', $id);
         return $this->fetch('member/import_log');
     }
}