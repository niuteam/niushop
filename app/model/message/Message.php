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

use app\model\shop\Shop;
use app\model\BaseModel;
use addon\wechat\model\Wechat;
use app\model\system\Site;
use EasyWeChatComposer\Laravel\ServiceProvider;

/**
 * 消息管理类
 */
class Message extends BaseModel
{

    /********************************************************************* 平台消息类型 start *********************************************************************************/

    function editMessage($data, $condition)
    {

        $count = model('message')->getCount($condition);
        if ($count > 0) {
            $res = model('message')->update($data, $condition);
        } else {
            $res = model('message')->add($data);
        }

        return $this->success($res);
    }

    /**
     * 编辑微信模板消息是否启动
     * @param $is_open
     * @param $condition
     */
    public function modifyMessageWechatIsOpen($is_open, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $keywords = isset($check_condition[ 'keywords' ]) ? $check_condition[ 'keywords' ] : '';
        if ($keywords === '') {
            return $this->error('', 'REQUEST_KEYWORDS');
        }

        $data = array (
            "wechat_is_open" => $is_open
        );
        $res = model('message')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 消息模本信息
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getMessageInfo($site_id, $keywords, $field = "*")
    {

        $info = model("message_template")->getInfo([ [ 'keywords', '=', $keywords ] ], $field);
        if (!empty($info)) {
            $info[ "message_json_array" ] = empty($info[ "message_json" ]) ? [] : json_decode($info[ "message_json" ], true);//消息配置
            $info[ "sms_json_array" ] = event('SmsTemplateInfo', [ 'keywords' => $keywords, 'site_id' => $site_id ], true);//短信配置
            $info[ "wechat_json_array" ] = empty($info[ "wechat_json" ]) ? [] : json_decode($info[ "wechat_json" ], true);//微信模板消息配置
            $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ]);
            if (empty($message)) {
                $data = [
                    'keywords' => $keywords,
                    'site_id' => $site_id,
                    'sms_is_open' => 0,
                ];
                model('message')->add($data);
                $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ]);
            }
            $info = array_merge($info, $message);
        }

        return $this->success($info);
    }

    /**
     * 获取消息详情
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getMessageDetail($site_id, $keywords, $field = "*")
    {
        $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ], $field);
        if (empty($message)) {
            $data = [
                'keywords' => $keywords,
                'site_id' => $site_id,
                'sms_is_open' => 0
            ];
            model('message')->add($data);

            $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ], $field);
            return $this->success($message);
        }
        return $this->success($message);
    }


    /**
     * 消息列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param null $limit
     */
    public function getMessageList($site_id = 0, $message_type = 1, $field = '*', $order = '', $limit = null)
    {

        $list = model('message_template')->getList([ [ "message_type", "=", $message_type ] ], $field, $order, '', '', '', $limit);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[ $k ][ 'support_type' ] = explode(',', $v[ 'support_type' ]);

                $message_info = model('message')->getInfo([ [ "keywords", "=", $v[ 'keywords' ] ], [ 'site_id', '=', $site_id ] ], 'sms_is_open,wechat_is_open');
                $list[ $k ][ 'sms_is_open' ] = $message_info == null ? 0 : $message_info[ 'sms_is_open' ];

                $list[ $k ][ 'wechat_is_open' ] = $message_info == null ? 0 : $message_info[ 'wechat_is_open' ];
            }
        }
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
    public function getMessagePageList($condition = [], $site_id = 0, $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('message_template')->pageList($condition, $field, $order, $page, $page_size);
        if ($site_id > 0) {
            if (!empty($list[ 'list' ])) {
                foreach ($list[ 'list' ] as $k => $v) {
                    $message_info = model('message')->getInfo([ [ "keywords", "=", $v[ 'keywords' ] ], [ 'site_id', '=', $site_id ] ], 'wechat_is_open,wechat_template_id');
                    $list[ 'list' ][ $k ][ 'wechat_is_open' ] = $message_info == null ? 0 : $message_info[ 'wechat_is_open' ];
                    $list[ 'list' ][ $k ][ 'wechat_template_id' ] = $message_info == null ? 0 : $message_info[ 'wechat_template_id' ];
                }
            }
        }

        return $this->success($list);
    }

    /**
     * 获取微信模板消息id
     * @param string $keywords
     * todo 批量获取模板消息
     */
    public function getWechatTemplateNo(string $keywords, $site_id, $wechat_is_open = 0)
    {
        $keyword = explode(',', $keywords);
        $wechat = new Wechat($site_id);

        if ($wechat_is_open == 1) {
            // 启用
            foreach ($keyword as $item) {
                $shop_message = model('message')->getInfo([ [ 'keywords', '=', $item ], [ "site_id", "=", $site_id ] ], 'wechat_template_id');
                $data = [
                    'wechat_is_open' => $wechat_is_open,
                    'site_id' => $site_id,
                    'keywords' => $item,
                ];
                // 开启时没有模板则进行添加
                if (!empty($shop_message)) {
                    if (empty($shop_message[ 'wechat_template_id' ])) {
                        $template_info = model('message_template')->getInfo([ [ 'keywords', '=', $item ], [ 'wechat_json', '<>', '' ] ], 'wechat_json');
                        if (!empty($template_info)) {
                            $template = json_decode($template_info[ 'wechat_json' ], true);
                            $res = $wechat->getTemplateId($template[ 'template_id_short' ]);
                            if (isset($res[ 'errcode' ]) && $res[ 'errcode' ] == 0) {
                                $data[ 'wechat_template_id' ] = $res[ 'template_id' ];
                            } else {
                                return $this->error($res, $res[ 'errmsg' ]);
                            }
                        }
                    }
                    model('message')->update($data, [ [ 'keywords', '=', $item ], [ "site_id", "=", $site_id ] ]);
                } else {
                    $template_info = model('message_template')->getInfo([ [ 'keywords', '=', $item ], [ 'wechat_json', '<>', '' ] ], 'wechat_json');
                    if (!empty($template_info)) {
                        $template = json_decode($template_info[ 'wechat_json' ], true);
                        $res = $wechat->getTemplateId($template[ 'template_id_short' ]);
                        if (isset($res[ 'errcode' ]) && $res[ 'errcode' ] == 0) {
                            $data[ 'wechat_template_id' ] = $res[ 'template_id' ];
                        } else {
                            return $this->error($res, $res[ 'errmsg' ]);
                        }
                    }
                    model('message')->add($data);
                }
            }
        } else if ($wechat_is_open == 0) {
            // 关闭
            foreach ($keyword as $item) {
                $shop_message = model('message')->getInfo([ [ 'keywords', '=', $item ], [ "site_id", "=", $site_id ] ], 'wechat_template_id');
                if (!empty($shop_message)) {
                    model('message')->update([ 'wechat_is_open' => $wechat_is_open ], [ [ 'keywords', '=', $item ], [ "site_id", "=", $site_id ] ]);
                } else {
                    model('message')->add([
                        'site_id' => $site_id,
                        'keywords' => $item,
                        'wechat_is_open' => $wechat_is_open
                    ]);
                }
            }
        } else {
            // 获取
            $list = model('message_template')->getList([ [ 'keywords', 'in', $keyword ], [ 'wechat_json', '<>', '' ] ], 'keywords,wechat_json');
            if (!empty($list)) {
                foreach ($list as $item) {
                    $template = json_decode($item[ 'wechat_json' ], true);
                    $res = $wechat->getTemplateId($template[ 'template_id_short' ]);
                    if (isset($res[ 'errcode' ]) && $res[ 'errcode' ] != 0) return $this->error($res, $res[ 'errmsg' ]);

                    $shop_message = model('message')->getInfo([ [ 'keywords', '=', $item[ 'keywords' ] ], [ "site_id", "=", $site_id ] ], 'wechat_template_id');

                    if (!empty($shop_message)) {
                        model('message')->update([ 'wechat_template_id' => $res[ 'template_id' ] ], [ [ 'keywords', '=', $item[ 'keywords' ] ], [ "site_id", "=", $site_id ] ]);
                    } else {
                        model('message')->add([
                            'site_id' => $site_id,
                            'keywords' => $item[ 'keywords' ],
                            'wechat_template_id' => $res[ 'template_id' ]
                        ]);
                    }
                }
            }
        }
        return $this->success();
    }

    /********************************************************************* 平台消息类型 end *********************************************************************************/


    /**
     * 消息发送
     * @param $param
     */
    public function sendMessage($param)
    {
        try {
            $keywords = $param[ "keywords" ];
            $site_id = $param[ "site_id" ] ?? $param[ "site_id" ];
            $message_info_result = $this->getMessageInfo($site_id, $keywords);
            $message_info = $message_info_result[ "data" ];
            $param[ "message_info" ] = $message_info;
            $shop_info = [];
            if ($site_id > 0) {
                $shop_model = new Shop();
                $shop_info_result = $shop_model->getShopInfo([ [ 'site_id', '=', $site_id ] ]);
                $site_model = new Site();
                $site_info = $site_model->getSiteInfo([ [ 'site_id', '=', $site_id ] ]);
                $shop_info = array_merge($shop_info_result[ "data" ], $site_info[ 'data' ]);
            }
            $param[ "site_info" ] = $shop_info;
            $result = event("SendMessageTemplate", $param, true);//匹配消息模板  并发送
            return $result;
        } catch (\Exception $e) {
            return $this->error('', "MESSAGE_FAIL");
        }
    }

}