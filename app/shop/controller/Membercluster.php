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

use app\model\member\MemberCluster as MemberClusterModel;
use app\model\member\Member as MemberModel;
use app\model\member\MemberLevel as MemberLevelModel;
use app\model\member\MemberLabel as MemberLabelModel;

/**
 * 会员群体管理 控制器
 */
class Membercluster extends BaseShop
{
    /**
     * 会员群体列表
     * @return array|mixed
     */
    public function clusterList()
    {
        $member_cluster_model = new MemberClusterModel();
        if (request()->isAjax()) {
            $page        = input('page', 1);
            $page_size   = input('page_size', PAGE_LIST_ROWS);
            $cluster_name = input('cluster_name', '');

            $start_date = input('start_date', '');
            $end_date = input('end_date', '');

            $condition[]   = ['site_id', '=', $this->site_id];
            $condition[] = ['cluster_name', 'like', "%" . $cluster_name . "%"];
            //更新时间
            if ($start_date != '' && $end_date != '') {
                $condition[] = [ 'update_time', 'between', [ strtotime($start_date), strtotime($end_date) ] ];
            } else if ($start_date != '' && $end_date == '') {
                $condition[] = [ 'update_time', '>=', strtotime($start_date) ];
            } else if ($start_date == '' && $end_date != '') {
                $condition[] = [ 'update_time', '<=', strtotime($end_date) ];
            }
            $order       = 'create_time desc';
            $field       = '*';
            $list               = $member_cluster_model->getMemberClusterPageList($condition, $page, $page_size, $order, $field);
            return $list;
        } else {

            return $this->fetch('membercluster/cluster_list');
        }
    }

    /**
     * 添加会员群体
     * @return array|mixed
     */
    public function addCluster()
    {
        $member_cluster_model = new MemberClusterModel();
        if (request()->isAjax()) {
            $data = [
                'site_id'     => $this->site_id,
                'cluster_name'  => input('cluster_name', ''),
                'rule_json' => input('rule_json', ''),
                'create_time' => time(),
                'update_time' => time(),
            ];

            return $member_cluster_model->addMemberCluster($data);
        } else {
            $basic_list = $member_cluster_model->basic;
            $consume_list = $member_cluster_model->consume;
            $promotion_list = $member_cluster_model->promotion;

            $this->assign('basic_list', $basic_list);
            $this->assign('consume_list', $consume_list);
            $this->assign('promotion_list', $promotion_list);

            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([ [ 'site_id', '=', $this->site_id ] ], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员标签
            $member_label_model = new MemberLabelModel();
            $member_label_list = $member_label_model->getMemberLabelList([ [ 'site_id', '=', $this->site_id ] ], 'label_id, label_name', 'sort asc');
            $this->assign('member_label_list', $member_label_list[ 'data' ]);
            return $this->fetch('membercluster/add_cluster');
        }
    }

    /**
     * 编辑会员群体
     * @return array|mixed
     */
    public function editCluster()
    {
        $member_cluster_model = new MemberClusterModel();
        $cluster_id           = input('cluster_id', 0);
        if (request()->isAjax()) {
            $data = [
                'site_id'     => $this->site_id,
                'cluster_name'  => input('cluster_name', ''),
                'rule_json' => input('rule_json', ''),
                'update_time' => time(),
            ];
            return $member_cluster_model->editMemberCluster($data, ['cluster_id' =>  $cluster_id]);
        } else {

            $cluster_info = $member_cluster_model->getMemberClusterDetail([['cluster_id', '=', $cluster_id]]);
            $this->assign('cluster_info', $cluster_info['data']);

            //会员等级
            $member_level_model = new MemberLevelModel();
            $member_level_list = $member_level_model->getMemberLevelList([ [ 'site_id', '=', $this->site_id ] ], 'level_id, level_name', 'growth asc');
            $this->assign('member_level_list', $member_level_list[ 'data' ]);

            //会员标签
            $member_label_model = new MemberLabelModel();
            $member_label_list = $member_label_model->getMemberLabelList([ [ 'site_id', '=', $this->site_id ] ], 'label_id, label_name', 'sort asc');
            $this->assign('member_label_list', $member_label_list[ 'data' ]);
            return $this->fetch('membercluster/edit_cluster');
        }
    }

    /**
     *  删除会员群体
     */
    public function deleteCluster()
    {
        $cluster_ids          = input('cluster_ids', '');
        $member_cluster_model = new MemberClusterModel();
        return $member_cluster_model->deleteMemberCluster(['cluster_id' =>  $cluster_ids]);
    }

    /**
     * 刷新操作
     * @return array|mixed
     */
    public function refreshCluster()
    {
        if (request()->isAjax()) {
            $member_cluster_model = new MemberClusterModel();
            $cluster_id           = input('cluster_id', 0);

            return $member_cluster_model->refreshMemberCluster($cluster_id);
        }
    }

    /**
     * 导出会员
     */
    public function exportClusterMember()
    {

        $member_cluster_model = new MemberClusterModel();
        $cluster_id           = input('cluster_id', 0);
        $cluster_condition[]   = ['site_id', '=', $this->site_id];
        $cluster_condition[]   = ['cluster_id', '=', $cluster_id];

        $cluster_info = $member_cluster_model->getMemberClusterInfo($cluster_condition,'member_ids,cluster_name');
        $order = 'reg_time desc';
        $field = 'username,nickname,realname,mobile,sex,birthday,email,member_level_name,member_label_name,
        qq,location,balance,balance_money,point,growth,reg_time,last_login_ip,last_login_time';

        $member_model = new MemberModel();

        $condition[] = ["member_id", "in", $cluster_info['data']["member_ids"]];
        $condition[] = ["site_id", "=", $this->site_id];
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
     * 发放优惠券
     */
    public function sendCoupon()
    {
        if (request()->isAjax()) {
            $member_cluster_model = new MemberClusterModel();
            $cluster_id           = input('cluster_id', 0);
            $coupon           = input('coupon', '');

            return $member_cluster_model->sendCoupon($coupon, $cluster_id);
        }
    }

    /**
     * 发放红包
     */
    public function sendBalance()
    {
        if (request()->isAjax()) {
            $member_cluster_model = new MemberClusterModel();
            $cluster_id           = input('cluster_id', 0);
            $adjust_num           = input('adjust_num', 0);
            $remark = input('remark', '');

            return $member_cluster_model->sendBalance($adjust_num, $cluster_id, $remark);
        }
    }

    /**
     * 发放积分
     */
    public function sendPoint()
    {
        if (request()->isAjax()) {
            $member_cluster_model = new MemberClusterModel();
            $cluster_id           = input('cluster_id', 0);
            $adjust_num           = input('adjust_num', 0);
            $remark = input('remark', '');

            return $member_cluster_model->sendPoint($adjust_num, $cluster_id, $remark);
        }
    }

    /**
     * 计算人数
     * @return array
     */
    public function calculate()
    {
        $member_cluster_model = new MemberClusterModel();
        if (request()->isAjax()) {
            $data = [
                'site_id'     => $this->site_id,
                'rule_json' => input('rule_json', ''),
            ];
            return $member_cluster_model->calculate($data);
        }
    }

}