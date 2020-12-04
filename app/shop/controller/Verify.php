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

use app\model\member\Member;
use app\model\verify\Verifier;
use app\model\verify\Verify as VerifyModel;
use app\model\web\Config as ConfigModel;

/**
 * 核销
 * Class Verify
 * @package app\shop\controller
 */
class Verify extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 核销记录
     * @return mixed
     */
    public function records()
    {
        $verify_model = new VerifyModel();
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $order = input("order", "create_time desc");
            $verify_type = input('verify_type', "");//验证类型
            $verify_code = input('verify_code', "");//验证码
            $verifier_name = input('verifier_name', "");
            $start_time = input("start_time", '');
            $end_time = input("end_time", '');

            $condition = [
                ['site_id', "=", $this->site_id],
                ['is_verify', '=', 1]
            ];
            if (!empty($verify_type)) {
                $condition[] = ["verify_type", "=", $verify_type];
            }
            if (!empty($verify_code)) {
                $condition[] = ["verify_code", 'like', '%' . $verify_code . '%'];
            }
            if (!empty($verifier_name)) {
                $condition[] = ['verifier_name', 'like', '%' . $verifier_name . '%'];
            }
            if (!empty($start_time) && empty($end_time)) {
                $condition[] = ['create_time', '>=', date_to_time($start_time)];
            } elseif (empty($start_time) && !empty($end_time)) {
                $condition[] = ["create_time", "<=", date_to_time($end_time)];
            } elseif (!empty($start_time) && !empty($end_time)) {
                $condition[] = ['create_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
            }
            $list = $verify_model->getVerifyPageList($condition, $page, $page_size, $order, $field = 'id, verify_code, verify_type, verify_type_name, verify_content_json, verifier_id, verifier_name, is_verify, create_time, verify_time');
            return $list;
        } else {
            $verify_type = $verify_model->getVerifyType();
            $this->assign('verify_type', $verify_type);
            return $this->fetch("verify/records");
        }

    }

    /**
     * 核销信息
     */
    public function verifyInfo()
    {
        $id = input('id','');

        $verify_model = new VerifyModel();
        $info = $verify_model->getVerifyInfo([['id','=',$id],['site_id','=',$this->site_id]]);
        return $info;
    }


    /**
     * 核销台
     * @return mixed
     */
    public function verifyCard()
    {
        if (request()->isAjax()) {
            $verify_code = input("verify_code", "");
            $verify_model = new VerifyModel();
            $res = $verify_model->getVerifyInfo([["verify_code", "=", $verify_code], ["site_id", "=", $this->site_id]]);
            return $res;
        } else {
            return $this->fetch("verify/verify_card");
        }

    }

    /**
     * 核销人员
     * @return mixed
     */
    public function user()
    {
        if (request()->isAjax()) {
            $verifier = new Verifier();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $order = input("order", "create_time desc");
            $verifier_name = input('verifier_name', '');
            $condition = [];
            $condition[] = ['v.site_id', "=", $this->site_id];
            if ($verifier_name) {
                $condition[] = ['v.verifier_name', '=', $verifier_name];
            }
            $list = $verifier->getVerifierPageList($condition, $page, $page_size, $order);
            return $list;
        } else {
            return $this->fetch("verify/user");
        }
    }

    /**
     * 添加核销人员
     * @return mixed
     */
    public function addUser()
    {
        if (request()->isAjax()) {
            $verifier_name = input("verifier_name", "");
            $member_id = input("member_id", 0);//会员账号
            $uid = input("uid", 0);//管理员账号
            $model = new Verifier();
            $data = array();
            $data['site_id'] = $this->site_id;
            $data['create_time'] = time();
            $data["verifier_name"] = $verifier_name;
            $data["member_id"] = $member_id;
            $data["uid"] = $uid;
            $result = $model->addVerifier($data);
            return $result;
        } else {
            $upload_config_model = new ConfigModel();
            $upload_config_result = $upload_config_model->getDefaultImg($this->site_id, $this->app_module);
            $upload_config_result = $upload_config_result['data']['value'];
            $this->assign("default_headimg", $upload_config_result['default_headimg']);
            return $this->fetch("verify/add_user");
        }
    }

    /**
     * 编辑核销人员
     * @return mixed
     */
    public function editUser()
    {
        $verifier_id = input("verifier_id", 0);//核销员id
        if (request()->isAjax()) {
            $verifier_name = input("verifier_name", "");
            $member_id = input("member_id", 0);//会员账号
            $data = [
                'verifier_name' => $verifier_name,
                'modify_time' => time(),
            ];
            $data["member_id"] = $member_id;
            $data["uid"] = 0;
            $condition = array(
                ['verifier_id', '=', $verifier_id],
                ['site_id', '=', $this->site_id],
            );

            $model = new Verifier();
            $result = $model->editVerifier($data, $condition);
            return $result;
        } else {
            $verifier_id = input("verifier_id", 0);

            //用户信息
            $model = new Verifier();
            $condition = [
                ["verifier_id", "=", $verifier_id],
                ["site_id", "=", $this->site_id],
            ];
            $info_result = $model->getVerifierInfo($condition);
            $info = $info_result["data"];
            $member_account = "";
            if (!empty($info["member_id"])) {
                $member_model = new Member();
                $member_info_result = $member_model->getMemberInfo([["member_id", "=", $info["member_id"]]], "username");
                $member_info = $member_info_result["data"];
                if (!empty($member_info)) {
                    $member_account = $member_info["username"];
                }

            }
            $info["member_account"] = $member_account;
            $this->assign("data", $info);
            $this->assign("verifier_id", $verifier_id);
            $upload_config_model = new ConfigModel();
            $upload_config_result = $upload_config_model->getDefaultImg($this->site_id, $this->app_module);
            $upload_config_result = $upload_config_result['data']['value'];
            $this->assign("default_headimg", $upload_config_result['default_headimg']);
            return $this->fetch("verify/edit_user");
        }

    }

    /**
     * 删除核销人员
     * @return mixed
     */
    public function deleteUser()
    {
        if (request()->isAjax()) {
            $verifier = new Verifier();
            $verifier_id = input('ids', 0);
            $res = $verifier->deleteVerifier($verifier_id, $this->site_id);
            return $res;
        }
    }

    /**
     * 核销
     */
    public function verify()
    {
        //先验证登录用户是否具备核销权限
        $info = array(
            "verifier_id" => $this->uid,
            "verifier_name" => $this->user_info['username'],
        );
        $verify_code = input("verify_code", "");
        $verify_model = new VerifyModel();
        $res = $verify_model->verify($info, $verify_code);
        return $res;
    }

    /**
     * 搜索会员
     * 不是菜单 不入权限
     */
    public function searchMember()
    {
        if (request()->isAjax()) {
            $search_text = input('search_text', '');
            $member_model = new Member();
            $member_info = $member_model->getMemberInfo([['username|mobile', '=', $search_text], ['site_id', '=', $this->site_id]]);
            return $member_info;
        }
    }


    /**
     * 核销记录导出
     */
    public function exportVerify()
    {
        $verify_model = new VerifyModel();
        $page = input('page', 1);
        $page_size = 0;
        $order = input("order", "create_time desc");
        $verify_type = input('verify_type', "");//验证类型
        $verify_code = input('verify_code', "");//验证码
        $verifier_name = input('verifier_name', "");
        $start_time = input("start_time", '');
        $end_time = input("end_time", '');

        $condition = [
            ['site_id', "=", $this->site_id],
            ['is_verify', '=', 1]
        ];
        if (!empty($verify_type)) {
            $condition[] = ["verify_type", "=", $verify_type];
        }
        if (!empty($verify_code)) {
            $condition[] = ["verify_code", 'like', '%' . $verify_code . '%'];
        }
        if (!empty($verifier_name)) {
            $condition[] = ['verifier_name', 'like', '%' . $verifier_name . '%'];
        }
        if (!empty($start_time) && empty($end_time)) {
            $condition[] = ['create_time', '>=', date_to_time($start_time)];
        } elseif (empty($start_time) && !empty($end_time)) {
            $condition[] = ["create_time", "<=", date_to_time($end_time)];
        } elseif (!empty($start_time) && !empty($end_time)) {
            $condition[] = ['create_time', 'between', [date_to_time($start_time), date_to_time($end_time)]];
        }
        $list_result = $verify_model->getVerifyPageList($condition, $page, $page_size, $order, $field = 'id, verify_code, verify_type, verify_type_name, verify_content_json, verifier_id, verifier_name, is_verify, create_time, verify_time');
        $list = $list_result['data']['list'];

        // 实例化excel
        $phpExcel = new \PHPExcel();

        $phpExcel->getProperties()->setTitle("核销记录");
        $phpExcel->getProperties()->setSubject("核销记录");
        //单独添加列名称
        $phpExcel->setActiveSheetIndex(0);

        $phpExcel->getActiveSheet()->setCellValue("A1", '核销码');
        $phpExcel->getActiveSheet()->setCellValue("B1", '核销类型');
        $phpExcel->getActiveSheet()->setCellValue("C1", '核销员');
        $phpExcel->getActiveSheet()->setCellValue("D1", '状态');
        $phpExcel->getActiveSheet()->setCellValue("E1", '创建时间');
        $phpExcel->getActiveSheet()->setCellValue("F1", '核销时间');

        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $start = $k + 2;
                $phpExcel->getActiveSheet()->setCellValue('A' . $start, $v['verify_code'] . "\t");
                $phpExcel->getActiveSheet()->setCellValue('B' . $start, $v['verify_type_name'] . "\t");
                $phpExcel->getActiveSheet()->setCellValue('C' . $start, $v['verifier_name'] . "\t");
                if ($v['is_verify'] == 1) {
                    $verify_status = "已核销";
                } else {
                    $verify_status = "尚未核销";
                }
                $phpExcel->getActiveSheet()->setCellValue('D' . $start, $verify_status . "\t");
                $phpExcel->getActiveSheet()->setCellValue('E' . $start, time_to_date($v['create_time']) . "\t");
                $phpExcel->getActiveSheet()->setCellValue('F' . $start, time_to_date($v['verify_time']) . "\t");
            }
        }

        // 重命名工作sheet
        $phpExcel->getActiveSheet()->setTitle('核销记录');
        // 设置第一个sheet为工作的sheet
        $phpExcel->setActiveSheetIndex(0);
        // 保存Excel 2007格式文件，保存路径为当前路径，名字为export.xlsx
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        $file = date('Y年m月d日-核销记录', time()) . '.xlsx';
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
}