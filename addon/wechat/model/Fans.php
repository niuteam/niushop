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

namespace addon\wechat\model;

use app\model\BaseModel;

/**
 * 微信粉丝
 */
class Fans extends BaseModel
{
    /***************************************************************** 微信粉丝 start ***************************************************************************/
    /**
     * 获取粉丝列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getFansList($condition = [], $field = '*', $order = '', $limit = null)
    {

        $list = model('wechat_fans')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取粉丝分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getFansPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'subscribe_time desc', $field = '*')
    {

        $list = model('wechat_fans')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }


    /**
     * 为微信粉丝批量打标签
     * @param  $data
     */
    public function batchtagging($data)
    {
        //调用微信接口服务器配置 修改微信端粉丝标签

        $res = model('wechat_fans')->update(['tagid_list' => implode(',', $data['tag_id_list'])], ['openid' => ['in', $data['openid_list']]]);
        return $this->success($res);
    }

    /**
     * 为微信粉丝批量取消标签
     * @param unknown $data
     */
    public function batchUnTagging($data)
    {
        return $this->success();
    }

    /**
     * 同步粉丝标签
     * @param unknown $openid_list
     */
    public function syncFans($openid_list)
    {
        $wechat_model  = new Wechat();
        $select_result = $wechat_model->selectUser($openid_list);//获取多个微信粉丝信息
        if ($select_result["code"] != 0)
            return $select_result;

        $user_list             = $select_result["data"]["user_info_list"];
        $subscribe_scene_array = array(
            "ADD_SCENE_SEARCH"            => "公众号搜索",
            "ADD_SCENE_ACCOUNT_MIGRATION" => "公众号迁移",
            "ADD_SCENE_PROFILE_CARD"      => "名片分享",
            "ADD_SCENE_QR_CODE"           => "扫描二维码",
            "ADD_SCENE_PROFILE_ LINK"     => "图文页内名称点击",
            "ADD_SCENE_PROFILE_ITEM"      => "图文页右上角菜单",
            "ADD_SCENE_PAID"              => "支付后关注",
            "ADD_SCENE_OTHERS"            => "其他",
        );
        foreach ($user_list as $user_k => $user_item) {
            $unionid         = empty($user_item["unionid"]) ? '' : $user_item["unionid"];
            $province        = base64_encode($user_item["province"]);
            $city            = base64_encode($user_item["city"]);
            $nickname        = base64_encode($user_item['nickname']);
            $nickname_decode = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $user_item['nickname']);
            $data            = array(
                'nickname'             => $nickname,
                'nickname_decode'      => $nickname_decode,
                'headimgurl'           => $user_item['headimgurl'],
                'sex'                  => $user_item["sex"],
                'language'             => $user_item["language"],
                'country'              => $user_item["country"],
                'province'             => $province,
                'city'                 => $city,
                'district'             => '',
                'openid'               => $user_item["openid"],
                'unionid'              => $unionid,
                'groupid'              => $user_item["groupid"],
                'is_subscribe'         => $user_item["subscribe"],
                'remark'               => $user_item["remark"],
                'update_date'          => time(),
                'tagid_list'           => empty($user_item["tagid_list"]) ? '' : implode(',', $user_item["tagid_list"]),
                'subscribe_scene'      => $user_item["subscribe_scene"],
                'subscribe_scene_name' => $subscribe_scene_array[$user_item["subscribe_scene"]],
                'qr_scene'             => $user_item["qr_scene"],
                'qr_scene_str'         => $user_item["qr_scene_str"],
                'subscribe_time'       => $user_item["subscribe_time"],
            );
            $res             = model("wechat_fans")->add($data);
        }
        return $this->success();
    }
    /***************************************************************** 微信粉丝 end ***************************************************************************/
    /***************************************************************** 微信粉丝标签 start ***************************************************************************/

    /**
     * 增加粉丝标签
     * @param $data
     */
    public function addFansTag($data)
    {
        $res = model('wechat_fans_tag')->add($data);
        if ($res === false)
            return $this->error('', 'UNKNOW_ERROR');

        //同步修改微信端粉丝标签

        return $this->success($res);
    }

    /**
     * 编辑粉丝标签
     * @param $data
     * @param $condition
     * @return int|\multitype
     */
    public function editFansTag($data, $condition)
    {
        $res = model('wechat_fans_tag')->update($data, $condition);
        if ($res === false)
            return $this->error('', 'UNKNOW_ERROR');

        //同步修改微信端粉丝标签

        return $this->success($res);
    }


    /**
     * 删除标签
     * @param unknown $data
     */
    public function deleteFansTag($condition)
    {
        $res = model('wechat_fans_tag')->delete($condition);
        return $this->success($res);

    }

    /**
     * 获取粉丝列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getFansTagList($condition = [], $field = '*', $order = '', $limit = null)
    {

        $list = model('wechat_fans_tag')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取微信粉丝标签列表
     */
    public function getFansTagPageList($condition = [], $page = 1, $list_rows = PAGE_LIST_ROWS, $order = '', $field = true)
    {
        $list = model('wechat_fans_tag')->pageList($condition, $field, $order, $page, $list_rows);
        return $this->success($list);
    }


    /**
     * 同步粉丝标签
     * @param unknown $data
     */
    public function syncFansTag()
    {
        return $this->success();
    }
    /***************************************************************** 微信粉丝标签 end ***************************************************************************/


    /**
     * 增加粉丝
     * @param $data
     */
    public function addFans($data)
    {
        $res = model('wechat_fans')->add($data);

        return $this->success($res);
    }

    /**
     * 取消关注
     */
    public function unfollowWechat($open_id)
    {
        $data              = array(
            'is_subscribe'     => 0,
            'update_date'      => time(),
            'unsubscribe_time' => time()
        );
        $wechat_fans_model = model('wechat_fans');
        $res               = $wechat_fans_model->update($data, ['openid' => $open_id]);
        return success($res);
    }

    /**
     * 粉丝详情
     * @param $condition
     */
    public function getFansInfo($condition, $field = "*")
    {
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('wechat_fans')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 编辑粉丝
     * @param $data
     * @param $condition
     */
    public function editFans($data, $condition)
    {
        $data["update_date"] = time();
        $result              = model("wechat_fans")->update($data, $condition);
        return $this->success($result);
    }

}