<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\message;

use app\model\system\Site;
use app\model\web\WebSite;
use think\facade\Cache;
use app\model\BaseModel;
use addon\wechat\model\Wechat;

/**
 * 消息管理类
 */
class MessageTemplate extends BaseModel
{

    /********************************************************************* 平台消息类型 start *********************************************************************************/

    /**
     * 编辑消息
     * @param $data
     * @param $condition
     */
    function editMessageTemplate($data, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }

        Cache::tag("message_template")->clear();
        $res = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑邮箱是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageTemplateEmailIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }
        Cache::tag("message_template")->clear();
        $data = array(
            "email_is_open" => $is_open
        );
        $res  = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑短信消息是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageTemplateSmsIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }
        Cache::tag("message_template")->clear();
        $data = array(
            "sms_is_open" => $is_open
        );
        $res  = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑微信模板消息是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageTemplateWechatIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }
        Cache::tag("message_template")->clear();
        $data = array(
            "wechat_is_open" => $is_open
        );
        $res  = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑微信小程序消息是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageTemplateWeappIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }
        Cache::tag("message_template")->clear();
        $data = array(
            "weapp_is_open" => $is_open
        );
        $res  = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑阿里小程序消息是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageTemplateAliappIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords        = isset($check_condition['keywords']) ? $check_condition['keywords'] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }
        Cache::tag("message_template")->clear();
        $data = array(
            "aliapp_is_open" => $is_open
        );
        $res  = model('message_template')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 消息详情
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getMessageTemplateInfo($condition, $field = "*", $ailas = 'a', $join = null)
    {
        $data  = json_encode([$condition, $field, $ailas, $join]);
        $cache = Cache::get("message_template_getMessageTemplateInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model("message_template")->getInfo($condition, $field, $ailas, $join);

        if (!empty($info)) {
            $info["message_json_array"] = empty($info["message_json"]) ? [] : json_decode($info["message_json"], true);//消息配置
            $info["sms_json_array"]     = empty($info["sms_json"]) ? [] : json_decode($info["sms_json"], true);//短信配置
            $info["wechat_json_array"]  = empty($info["wechat_json"]) ? [] : json_decode($info["wechat_json"], true);//微信公众号配置
            $info["weapp_json_array"]   = empty($info["weapp_json"]) ? [] : json_decode($info["weapp_json"], true);//微信小程序配置
            $info["aliapp_json_array"]  = empty($info["aliapp_json"]) ? [] : json_decode($info["aliapp_json"], true);//阿里配置
        }

        Cache::tag("message_template")->set("message_template_getMessageTemplateInfo_" . $data, $info);
        return $this->success($info);
    }

    /**
     * 消息列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param null $limit
     */
    public function getMessageTemplateList($condition = [], $field = true, $order = '', $limit = null)
    {
        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("message_template_getMessageTemplateList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('message_template')->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($list as $k => $v) {
            $list[$k]['support_type'] = explode(',', $v['support_type']);
        }
        Cache::tag("message_template")->set("message_template_getMessageTemplateList_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 消息分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getMessageTemplatePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {

        $data  = json_encode([$condition, $page, $page_size, $order, $field]);
        $cache = Cache::get("message_template_getMessageTemplatePageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('message_template')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("message_template")->set("message_template_getMessageTemplatePageList_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取微信模板消息id
     * @param string $keywords
     */
    public function getWechatTemplateNo(string $keywords)
    {
        $keyword = explode(',', $keywords);
        $list    = model('message_template')->getList([['keywords', 'in', $keyword], ['wechat_json', '<>', '']], 'keywords,wechat_json');
        if (!empty($list)) {
            $wechat = new Wechat();
            foreach ($list as $item) {
                $template_info = json_decode($item['wechat_json'], true);
                $res           = $wechat->getTemplateId($template_info['template_id_short']);
                if (isset($res['errcode']) && $res['errcode'] == 0) {
                    $template_info['template_id'] = $res['template_id'];
                    model('message_template')->update(['wechat_json' => json_encode($template_info, JSON_UNESCAPED_UNICODE)], ['keywords' => $item['keywords']]);
                } else {
                    return $this->error($res, $res['errmsg']);
                }
            }
        }
        Cache::clear('message_template');
        return $this->success();
    }

    /********************************************************************* 平台消息类型 end *********************************************************************************/


    /**
     * 消息发送
     * @param $param
     */
    public function sendMessageTemplate($param)
    {
        $keywords                     = $param["keywords"];
        $site_id                      = $param["site_id"];
        $condition                    = [
            ["mt.keywords", "=", $keywords],
            ["mt.site_id", "=", $site_id]
        ];
        $field                        = 'mt.*,m.addon, m.title, m.message_type, m.message_json, m.sms_addon, m.sms_json, m.sms_content, m.wechat_is_open, m.wechat_json, m.weapp_is_open, m.weapp_json, m.aliapp_is_open, m.aliapp_json, m.support_type';
        $join                         = [
            ['message_template m', 'm.keywords = mt.keywords', 'left']
        ];
        $message_template_info_result = $this->getMessageTemplateInfo($condition, $field, 'mt', $join);
        $message_template_info        = $message_template_info_result["data"];

        if (empty($message_template_info)) return $this->error('', 'NOT_SET_SMS_TEMPLATE');

        $param["message_template_info"] = $message_template_info;

        //平台配置信息
        $site_model         = new Site();
        $shop_info          = $site_model->getSiteInfo([['site_id', '=', $site_id]], 'site_name,logo,seo_keywords,seo_description, create_time');
        $param["site_name"] = $shop_info["data"]["site_name"];
        $result             = event("SendMessageTemplateTemplate", $param, true);//匹配消息模板  并发送
        return $result;
    }

}