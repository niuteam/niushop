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

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 微信素材管理
 */
class Material extends BaseModel
{

    /**
     * 添加微信素材
     * @param array $data
     */
    public function addMaterial($data)
    {
        $res = model('wechat_media')->add($data);
        Cache::tag("wechat_media")->clear();
        return $this->success($res);
    }

    /**
     * 修改微信素材
     * @param array $data
     * @param array $condition
     * @return multitype:string mixed
     */
    public function editMaterial($data, $condition)
    {
        $res = model('wechat_media')->update($data, $condition);
        Cache::tag("wechat_media")->clear();
        return $this->success($res);
    }

    /**
     * 删除微信素材
     * @param array $condition
     * @return multitype:string mixed
     */
    public function deleteMaterial($condition)
    {
        $res = model('wechat_media')->delete($condition);
        Cache::tag("wechat_media")->clear();
        return $this->success($res);
    }

    /**
     * 获取微信素材信息
     * @param array $condition
     * @param string $field
     * @return multitype:string mixed
     */
    public function getMaterialInfo($condition, $field = '*')
    {
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("wechat_media_getMaterialInfo_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('wechat_media')->getInfo($condition, $field);
        Cache::tag("wechat_media")->set("wechat_media_getMaterialInfo_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取微信素材列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getMaterialList($condition = [], $field = '*', $order = '', $limit = null)
    {
        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("wechat_media_getMaterialList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('wechat_media')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("wechat_media")->set("wechat_media_getMaterialList_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取微信素材分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return multitype:string mixed
     */
    public function getMaterialPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'update_time desc', $field = '*')
    {
        $data  = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache = Cache::get("wechat_media_getMaterialPageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('wechat_media')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("wechat_media")->set("wechat_media_getMaterialPageList_" . $data, $list);
        return $this->success($list);
    }
}