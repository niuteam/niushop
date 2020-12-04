<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\upload;

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 相册组件模型
 */
class Album extends BaseModel
{

    /*******************************************************************相册编辑查询 start*****************************************************/

    /**
     * 创建相册
     * @param $data
     */
    public function addAlbum($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data["update_time"] = time();

        Cache::tag("album_" . $site_id)->clear();
        $res = model("album")->add($data);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑相册
     * @param $data
     * @param $condition
     */
    public function editAlbum($data, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data["update_time"] = time();
        Cache::tag("album_" . $site_id)->clear();
        $res = model("album")->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 删除相册
     * @param array $condition
     * @return multitype:string mixed
     */
    public function deleteAlbum($condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '')
            return $this->error('', 'REQUEST_SITE_ID');

        //判断当前相册是否存在默认, 默认相册不可删除
        $temp_count = model("album_pic")->getCount($condition, "*");
        if ($temp_count > 0)
            return $this->error("", "当前删除相册中存在图片,不可删除!");

        $temp_condition   = $condition;
        $temp_condition[] = ["is_default", "=", 1];
        $temp_count       = model('album')->getCount($temp_condition, "album_id");
        if ($temp_count > 0)
            return $this->error('', '当前删除相册中存在默认相册,默认相册不可删除!');

        Cache::tag("album_" . $site_id)->clear();
        $res = model('album')->delete($condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 设置默认相册
     * @param $status
     * @param $condition
     */
    public function modifyAlbumDefault($condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $album_id        = isset($check_condition['album_id']) ? $check_condition['album_id'] : '';
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        if ($album_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        //先将所有本站点的相册都设为非默认(一个站点只能有一个默认相册)
        $temp_condition = array(
            ["site_id", "=", $site_id],
        );
        Cache::tag("album_" . $site_id)->clear();
        $res = model('user')->update(["is_default" => 0, "update_time" => time()], $temp_condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }

        //将本相册设置为默认相册
        $data = array(
            "is_default"  => 1,
            "update_time" => time()
        );
        $res  = model('album')->update($data, $condition);
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 获取相册信息
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getAlbumInfo($condition, $field = "album_id, site_id, album_name, sort, cover, desc, is_default, update_time, num")
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("ablum_getAlbumInfo_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('album')->getInfo($condition, $field);
        Cache::tag("album_" . $site_id)->set("ablum_getAlbumInfo_" . $site_id . '_' . $data, $info);
        return $this->success($info);
    }

    /**
     * 获取相册列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return multitype:string mixed
     */
    public function getAlbumList($condition = [], $field = "album_id, site_id, album_name, sort, cover, desc, is_default, update_time, num", $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("ablum_getAlbumList_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('album')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("album_" . $site_id)->set("ablum_getAlbumList_" . $site_id . '_' . '_' . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取会员分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return multitype:string mixed
     */
    public function getAlbumPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'album_id, site_id, album_name, sort, cover, desc, is_default, update_time, num')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data  = json_encode([$condition, $page, $page_size, $order, $field]);
        $cache = Cache::get("album_getAlbumPageList_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('album')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("album_" . $site_id)->set("album_getAlbumPageList_" . $site_id . '_' . '_' . $data, $list);
        return $this->success($list);
    }

    /**
     * 同步修改相册下的图片数量
     * @param unknown $condition
     */
    public function syncAlbumNum($album_id)
    {
        $count = model("album_pic")->getCount([["album_id", "=", $album_id]], "*");//获取本商品分组下的图片数量
        $data  = array(
            "num" => $count
        );
        $res   = model("album")->update($data, [["album_id", "=", $album_id]]);
        return $this->success($res);
    }
    /*******************************************************************相册编辑查询 end*****************************************************/

    /*******************************************************************相册图片编辑查询 start*****************************************************/

    /**
     * 添加相册图片
     * @param $data
     */
    public function addAlbumPic($data)
    {
        $site_id = isset($data['site_id']) ? $data['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data["update_time"] = time();
        Cache::tag("album_pic_" . $site_id)->clear();
        $res = model("album_pic")->add($data);
        $this->syncAlbumNum($data["album_id"]);//同步当前相册下的图片数量
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑相册图片
     * @param $data
     * @param $condition
     */
    public function editAlbumPic($data, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data["update_time"] = time();
        Cache::tag("album_pic_" . $site_id)->clear();
        $res = model("album_pic")->update($data, $condition);
        $this->syncAlbumNum($check_condition["album_id"]);//同步当前相册下的图片数量
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 删除相册图片
     * @param array $condition
     * @return multitype:string mixed
     */
    public function deleteAlbumPic($condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '')
            return $this->error('', 'REQUEST_SITE_ID');


        Cache::tag("album_pic_" . $site_id)->clear();
        $res = model('album_pic')->delete($condition);
        $this->syncAlbumNum($check_condition["album_id"]);//同步当前相册下的图片数量
        if ($res === false) {
            return $this->error('', 'UNKNOW_ERROR');
        }
        return $this->success($res);
    }

    /**
     * 编辑图片所在分组
     * @param $album_id
     * @param $condition
     */
    public function modifyAlbumPicAlbum($album_id, $condition)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '')
            return $this->error('', 'REQUEST_SITE_ID');

        $info              = model("album_pic")->getInfo($condition);
        $original_album_id = $info["album_id"];
        if ($original_album_id == $album_id) {
            return $this->success();
        }
        Cache::tag("album_pic_" . $site_id)->clear();
        Cache::tag("album_" . $site_id)->clear();
        $res = model("album_pic")->update(["album_id" => $album_id], $condition);//切换图片所在分组
        $this->syncAlbumNum($album_id);//同步当前相册下的图片数量
        $this->syncAlbumNum($original_album_id);//同步当前相册下的图片数量
        if ($res === false)
            return $this->error('', 'UNKNOW_ERROR');

        return $this->success($res);
    }

    /**
     * 获取相册图片信息
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getAlbumPicInfo($condition, $field = "pic_id, pic_name, pic_path, pic_spec, site_id, update_time")
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data  = json_encode([$condition, $field]);
        $cache = Cache::get("album_pic_getAlbumPicInfo_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $info = model('album_pic')->getInfo($condition, $field);
        Cache::tag("album_pic_" . $site_id)->set("album_pic_getAlbumPicInfo_" . $site_id . '_' . $data, $info);
        return $this->success($info);
    }

    /**
     * 获取相册图片列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return multitype:string mixed
     */
    public function getAlbumPicList($condition = [], $field = "pic_id, pic_name, pic_path, pic_spec, site_id, update_time", $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("album_pic_getAlbumPicList_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('album_pic')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("album_pic_" . $site_id)->set("album_pic_getAlbumPicList_" . $site_id . '_' . '_' . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取相册图片分页列表
     *
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     * @return multitype:string mixed
     */
    public function getAlbumPicPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'pic_id, pic_name, pic_path, pic_spec, site_id, update_time')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }
        $data  = json_encode([$condition, $page, $page_size, $order, $field]);
        $cache = Cache::get("album_pic_getAlbumPicPageList_" . $site_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('album_pic')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("album_pic_" . $site_id)->set("album_pic_getAlbumPicPageList_" . $site_id . '_' . '_' . $data, $list);
        return $this->success($list);
    }
    /*******************************************************************相册图片 end*****************************************************/

}