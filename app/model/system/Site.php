<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use app\model\BaseModel;
use think\facade\Cache;
use think\facade\Db;

/**
 * 站点管理
 * @author Administrator
 *
 */
class Site extends BaseModel
{

    /**
     * 添加站点
     */
    public function addSite($data)
    {
        $res = model('site')->add($data);
        return $this->success($res);
    }

    /**
     * getSiteInfo 获取站点详情
     * @param $condtion
     * @param string $fields
     */
    public function getSiteInfo($condition, $fields = '*')
    {
        $res = model('site')->getInfo($condition, $fields);
        return $this->success($res);
    }

    /**
     * 修改商城站点信息
     * @param $site_data
     * @param $condition
     * @return int
     */
    public function editSite($site_data, $condition)
    {
        $res = model('site')->update($site_data, $condition);
        return $this->success($res);
    }
}