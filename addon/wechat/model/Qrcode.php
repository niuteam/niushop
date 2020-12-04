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
use think\facade\Cache;

/**
 * 微信二维码
 */
class Qrcode extends BaseModel
{
    /***************************************************************** 微信二维码 start ***************************************************************************/
    /**
     * 添加微信二维码
     * @param $data
     * @return int|string
     */
    public function addQrcode($data)
    {
        $data["update_time"] = time();
        Cache::tag("wechat_qrcode")->clear();
        $result = model("wechat_qrcode")->add($data);
        return $this->success($result);
    }

    /**
     * 编辑微信二维码
     * @param $data
     * @param $condition
     */
    public function editQrcode($data, $condition)
    {
        $data["update_time"] = time();
        Cache::tag("wechat_qrcode")->clear();
        $result = model("wechat_qrcode")->update($data, $condition);
        return $this->success($result);
    }

    /**
     * 删除微信二维码
     * @param $condition
     */
    public function deleteQrcode($condition)
    {
        Cache::tag("wechat_qrcode")->clear();
        $result = model("wechat_qrcode")->delete($condition);
        return $this->success($result);
    }

    /**
     * 设置默认二维码模板
     * @param $condition
     * @param $is_default
     */
    public function modifyQrcodeDefault($condition)
    {
        //将全部模板设置为非默认
        Cache::tag("wechat_qrcode")->clear();
        model("wechat_qrcode")->update(["is_default" => 0], ['is_default' => 1]);
        $res = model("wechat_qrcode")->update(["is_default" => 1], $condition);
        return $this->success($res);
    }

    /**
     * 获取二维码模板详情
     * @param $condition
     */
    public function getQrcodeInfo($condition, $field = "*")
    {
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("wechat_qrcode_getQrcodeInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('wechat_qrcode')->getInfo($condition, $field);
        Cache::tag("wechat_qrcode")->set("wechat_qrcode_getQrcodeInfo_" . $data, $info);
        return $this->success($info);
    }

    /**
     * 获取微信二维码列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getQrcodePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $data  = json_encode([$condition, $page, $page_size, $order, $field]);
        $cache = Cache::get("wechat_qrcode_getQrcodePageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('wechat_qrcode')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("wechat_qrcode")->set("wechat_qrcode_getQrcodePageList_" . $data, $list);
        return $this->success($list);
    }

    /***************************************************************** 微信粉丝 end ***************************************************************************/
}