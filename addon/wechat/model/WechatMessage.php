<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\system\Wechat\common\model;

use app\model\BaseModel;

/**
 * 微信公众号模板消息配置
 */
class WechatMessage extends BaseModel
{

    public $site_model;

    public function __construct()
    {
        $this->site_model = new Site();
    }

    /**
     * 发送模板消息
     * @param $data
     */
    public function send($param)
    {
        $message_model = new Wechat();
        $config_result = $message_model->getWechatConfigInfo($param["site_id"]);
        $config_data   = $config_result["data"]["value"];
        $wechat_api    = new Weixin('public');
        $wechat_api->initWechatPublicAccount($config_data["appid"], $config_data["appsecret"]);
        $data = array(
            "open_id"     => $param["open_id"],
            "template_id" => $param["template_id"],
            "url"         => $param["url"],
            "first"       => $param["first"],
            "remark"      => $param["remark"],
            "keyword"     => $param["keyword"]
        );
        $res  = $wechat_api->tmplmsgSend($data);
        if ($res->errcode == 0) {
            return $this->success($res);
        } else {
            return $this->error($res);
        }

    }

    /**
     * 获取所有当前绑定微信公众号的模板消息
     * @param $param
     */
    public function getWechatTemplateList($param)
    {
        $config_result = $this->getWechatConfigInfo($param["site_id"]);
        $config_data   = $config_result["data"]["value"];
        $wechat_api    = new Weixin('public');
        $wechat_api->initWechatPublicAccount($config_data["appid"], $config_data["appsecret"]);

        $res = $wechat_api->getWechatTemplateList();//获取微信消息模板
        return $res;
    }

    /**
     * 获取微信模板消息id
     * @param $param
     */
    public function getMessageTemolateId($param)
    {
        $wechat_model  = new Wechat();
        $config_result = $wechat_model->getWechatConfigInfo($param["site_id"]);
        $config_data   = $config_result["data"]["value"];
        $wechat_api    = new Weixin('public');
        $wechat_api->initWechatPublicAccount($config_data["appid"], $config_data["appsecret"]);
        $keyword = $param["keyword"];//消息管理关键标识

        //微信消息模板
        $message_model       = new Message();
        $message_info_result = $message_model->getSiteWechatMessageInfo(["keyword" => $keyword, "site_id" => $param["site_id"]]);
        $message_info        = $message_info_result["data"];
        if (empty($message_info))
            return $this->error([], "当前微信消息模板不存在!");

        $message_type_model       = new MessageModel();
        $message_type_info_result = $message_type_model->getMessageTypeInfo(["keyword" => $keyword]);
        $message_type_info        = $message_type_info_result["data"];
        if (empty($message_type_info["wechat_json"]))
            return $this->error([], "当前微信消息模板不存在!");

        $template_res = $wechat_api->getWechatTemplateId($message_type_info["wechat_json"]["template_no"]);
        if ($template_res->errcode == 0) {
            //设置模板编号
            $res = $message_model->editSiteWechatMessage(["template_id" => $template_res->template_id], ["keyword" => $keyword, "site_id" => $param["site_id"]]);
            return $res;
        } else {
            return $this->error($template_res, $template_res->errmsg);
        }

    }

    /**
     * 重置模板消息
     * @param $param
     * @return mixed
     */
    public function resetMessage($param)
    {
        $wechat_model  = new Wechat();
        $config_result = $wechat_model->getWechatConfigInfo($param["site_id"]);
        $config_data   = $config_result["data"]["value"];
        $wechat_api    = new Weixin('public');
        $wechat_api->initWechatPublicAccount($config_data["appid"], $config_data["appsecret"]);

        $res = $wechat_api->getWechatTemplateList();//获取微信消息模板

        //申請微信模板消息
        $message_model = new Message();
        $list          = $message_model->getSiteWechatMessageList(["site_id" => $param["site_id"]]);
        $res           = error();
        if (!empty($list["data"])) {
            foreach ($list["data"] as $k => $v) {
                if (!empty($v["wechat_json"])) {
                    $temp_json = json_decode($v["wechat_json"], true);
                    if (!empty($temp_json["template_no"])) {
                        $res = $wechat_api->getWechatTemplateId($temp_json["template_no"]);
                        if ($res->errcode == 0) {
                            //设置模板编号
                            $message_model->editSiteWechatMessage(["template_id" => $res->template_id], ["keyword" => $v["keyword"], "site_id" => $param["site_id"]]);
                        } else {
                            return $this->error($res, $res->errmsg);
                        }
                    }
                }
            }
        }
        return $res;
    }

    /**
     * 發送模板消息
     * @param $param
     */
    public function sendMessage($param)
    {
        $message_model = new SiteMessage();
        $type_info     = $message_model->getSiteMessageTypeViewInfo(["keyword" => $param["keyword"], "site_id" => $param["site_id"]]);
        if (((!empty($param["support_type"]) && stripos($param["support_type"], "Wechat") !== false) || empty($param["support_type"])) && stripos($type_info["data"]["port"], "Wechat") !== false && $type_info["data"]["wechat_is_open"] == 1) {
            $message_model = new Message();
            $message_info  = $message_model->getSiteWechatMessageInfo(["keyword" => $param["keyword"], "site_id" => $param["site_id"]]);
            if (empty($message_info["data"]["template_id"]))
                return $this->error();

            if (empty($message_info["data"]["headtext"]))
                return $this->error();

            if (empty($message_info["data"]["bottomtext"]))
                return $this->error();

            //模板消息字段
            if (empty($param["keyword_json"]))
                return $this->error();

            //发送的接收用户
            if (empty($param["open_id"]))
                return $this->error();

            $url  = empty($param["url"]) ? '' : $param["url"];
            $data = array(
                "open_id"     => $param["open_id"],
                "template_id" => $message_info["data"]["template_id"],
                "url"         => $url,
                "first"       => $message_info["data"]["headtext"],
                "remark"      => $message_info["data"]["bottomtext"],
                "keyword"     => $param["keyword_json"],
                "site_id"     => $param["site_id"],
            );
            //添加发送记录(未即时发送的记录 发送状态为为发送)
            $message_records_model = new MessageRecords();
            $records_data          = array(
                "site_id"      => $param["site_id"],
                "open_id"      => $param["open_id"],
                "keyword_json" => json_encode($param["keyword_json"]),
                "keyword"      => $param["keyword"],
                "url"          => $url,
                "create_time"  => time()
            );
            //是否即时发送
            if ($type_info["data"]["is_instant"] == 1) {
                $result = $this->send($data);
                if ($result["code"] == 0) {
                    $status                    = 1;
                    $records_data["send_time"] = time();
                } else {
                    $status                 = -1;
                    $records_data["result"] = $result["data"]->errmsg;
                }
            } else {
                $status = 0;
            }
            $records_data["status"] = $status;
            $result                 = $message_records_model->addWechatMessageRecords($records_data);
            return $result;
        }
    }

    /**
     * 邮箱消息延时发送
     * @param array $param
     */
    public function cronMessageSend($param = [])
    {
        $message_records_model = new MessageRecords();
        $message_records_list  = $message_records_model->getWechatMessageRecordsList(["status" => 0]);
        if (!empty($message_records_list["data"])) {
            foreach ($message_records_list["data"] as $k => $v) {
                $message_model = new Message();
                $message_info  = $message_model->getSiteWechatMessageInfo(["keyword" => $param["keyword"], "site_id" => $param["site_id"]]);

                $params = array(
                    "site_id"     => $v["site_id"],
                    "open_id"     => $v["open_id"],
                    "keyword"     => json_decode($v["keyword_json"], true),
                    "url"         => $v["url"],
                    "template_id" => $message_info["data"]["template_id"],
                    "first"       => $message_info["data"]["headtext"],
                    "remark"      => $message_info["data"]["bottomtext"],
                );
                $result = $this->send($params);

                $data      = array();
                $condition = array(
                    "id"      => $v["id"],
                    "site_id" => $v["site_id"]
                );
                if ($result["code"] == 0) {
                    $data["send_time"] = time();
                    $data["status"]    = 1;
                } else {
                    $data["status"] = -1;
                    $data["result"] = $result["message"];
                }
                $message_records_model->editWechatMessageRecords($data, $condition);
            }
        }
    }
}