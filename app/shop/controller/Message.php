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


use app\model\message\Message as MessageModel;
use app\model\message\Sms;
use app\model\system\Site;

/**
 * 消息管理 控制器
 */
class Message extends BaseShop
{
    /**
     *  消息管理 列表
     */
    public function lists()
    {
        $message_model = new MessageModel();
        //买家消息
        $member_message_list_result = $message_model->getMessageList($this->site_id, 1);
        $member_message_list = $member_message_list_result[ "data" ];
        $this->assign("member_message_list", $member_message_list);
        //卖家通知
        $shop_message_list_result = $message_model->getMessageList($this->site_id, 2);
        $shop_message_list = $shop_message_list_result[ "data" ];
        $this->assign("shop_message_list", $shop_message_list);
        return $this->fetch("message/lists");
    }

    /**
     * 编辑短信模板(跳转)
     */
    public function editSmsMessage()
    {
        $keywords = input("keywords", '');
        $sms_model = new Sms();
        $edit_data_result = $sms_model->doEditSmsMessage();

        if (empty($edit_data_result[ "data" ][ 0 ]))
            $this->error("没有开启的短信方式!");

        $edit_data = $edit_data_result[ "data" ][ 0 ];
        $edit_url = $edit_data[ "shop_url" ];
        $this->redirect(addon_url($edit_url, [ "keywords" => $keywords ]));
    }

    /**
     * 短信管理
     */
    public function sms()
    {
        $sms_model = new Sms();
        $list = $sms_model->getSmsType();
        if (request()->isAjax()) {
            return $list;
        } else {
            $this->forthMenu();
            $list = $list[ 'data' ];
            if (count($list) == 1) {
                foreach ($list as $k => $v) {
                    if ($v[ 'sms_type' ] == 'niusms') {
                        $this->redirect(addon_url("niusms://shop/sms/index"));
                    }
                }
            }
            return $this->fetch("message/sms");
        }
    }

    /**
     * 短信记录
     */
    public function smsRecords()
    {
        if (request()->isAjax()) {
            $sms_model = new Sms();
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $status = input('status', 'all');
            $condition = [ [ 'site_id', '=', $this->site_id ] ];
            if (!empty($search_text)) {
                $condition[] = [ "keywords_name", "like", "%" . $search_text . "%" ];
            }
            if (!empty($status) && $status != 'all') {
                if ($status == -1) {
                    $condition[] = [ 'status', 'not in', [ 0, 1, '' ] ];
                } else {
                    $condition[] = [ 'status', '=', $status - 1 ];
                }
            }
            $list = $sms_model->getSmsRecordsPageList($condition, $page, $page_size);
            return $list;
        } else {
            $this->forthMenu();

            $sms_data = [
                'total_num' => 0,
                'sms_num' => 0,
                'sms_used_num' => 0
            ];

            $this->assign('sms_data', $sms_data);
            return $this->fetch("message/smsrecords");
        }
    }

    /**
     * 删除短信记录
     */
    public function deleteSmsRecords()
    {
        if (request()->isAjax()) {
            $ids = input("ids", "");
            $sms_model = new Sms();
            $condition = array (
                [ "id", "in", $ids ]
            );
            $result = $sms_model->deleteSmsRecords($condition);
            return $result;
        }
    }


    /**
     * 编辑短信模板(跳转)
     */
    public function editEmailMessage()
    {
        $message_model = new MessageModel();
        $keywords = input("keywords", "");
        $info_result = $message_model->getMessageInfo($this->site_id, $keywords);
        $info = $info_result[ "data" ];

        if (request()->isAjax()) {
            if (empty($info))
                return error(-1, "不存在的模板信息!");

            $email_title = input("email_title", '');//邮件标题
            $email_content = input("email_content", '');//邮件内容
            $email_is_open = input("email_is_open", 0);//邮件开关

            $data = array (
                'email_title' => $email_title,
                'email_content' => $email_content,
                "email_is_open" => $email_is_open,
            );
            $condition = array (
                [ "keywords", "=", $keywords ],
                [ 'site_id', '=', $this->site_id ],
                [ 'app_module', '=', $this->app_module ]
            );
            $this->addLog("编辑邮箱模板:" . $keywords);
            $res = $message_model->editMessage($data, $condition);
            return $res;
        } else {
            if (empty($info))
                $this->error("不存在的模板信息!");

            $email_title = $info[ "email_title" ];//邮件标题
            $email_content = $info[ "email_content" ];//邮件内容
            $email_is_open = $info[ "email_is_open" ];//邮件开关
            $this->assign("email_title", $email_title);
            $this->assign("email_content", $email_content);
            $this->assign("email_is_open", $email_is_open);
            $this->assign("keywords", $keywords);

            //模板变量
            $message_variable_list = $info[ "message_json_array" ];
            $this->assign("message_variable_list", $message_variable_list);
            return $this->fetch("message/edit_email_message");
        }

    }

}