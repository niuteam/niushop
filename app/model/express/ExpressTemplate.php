<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\express;

use think\facade\Cache;
use app\model\BaseModel;

/**
 * 运费模板
 */
class ExpressTemplate extends BaseModel
{
    /**
     * 添加运费模板（控制每个站点最多10条）
     * @param unknown $data
     * @param unknown $items
     * @return multitype:string
     */
    public function addExpressTemplate($data, $items)
    {
        $count = model('express_template')->getCount(['site_id' => $data['site_id']]);
        if ($count >= 10) {
            return $this->error('', 'TEMPLATE_TO_LONG');
        }

        if ($data['is_default'] == 1) {
            model('express_template')->update(['is_default' => 0], ['site_id' => $data['site_id']]);
        }

        //模板基础信息
        $data["create_time"] = time();
        $template_id         = model('express_template')->add($data);


        //具体模板信息
        foreach ($items as $k => $v) {
            $data_item                = $v;
            $data_item['template_id'] = $template_id;
            $data_item['fee_type']    = $data['fee_type'];
            model("express_template_item")->add($data_item);
        }
        Cache::tag("express_template_" . $data['site_id'])->clear();
        return $this->success($template_id);
    }

    /**
     * 修改系统运费模板
     * @param unknown $data
     * @return multitype:string
     */
    public function editExpressTemplate($data, $items)
    {
        //设置默认
        if ($data['is_default'] == 1) {
            model('express_template')->update(['is_default' => 0], ['site_id' => $data['site_id']]);
        }

        $data["modify_time"] = time();
        $res                 = model('express_template')->update($data, [['template_id', '=', $data['template_id']]]);
        //具体模板信息
        model("express_template_item")->delete([['template_id', '=', $data['template_id']]]);
        foreach ($items as $k => $v) {
            $data_item                = $v;
            $data_item['template_id'] = $data['template_id'];
            $data_item['fee_type']    = $data['fee_type'];
            model("express_template_item")->add($data_item);
        }
        Cache::tag("express_template_" . $data['site_id'])->clear();
        return $this->success($res);
    }

    /**
     * 删除系统运费模板
     * @param int $template_id
     */
    public function deleteExpressTemplate($template_id, $site_id)
    {
        $res = model('express_template')->delete([['template_id', '=', $template_id], ['site_id', '=', $site_id]]);
        if ($res) {
            model('express_template_item')->delete([['template_id', '=', $template_id]]);
        }

        Cache::tag("express_template_" . $site_id)->clear();
        return $this->success($res);
    }


    /**
     * 设置默认运费模板
     * @param int $template_id
     */
    public function updateDefaultExpressTemplate($template_id, $is_default, $site_id)
    {
        if ($is_default == 1) {
            model('express_template')->update(['is_default' => 0], ['site_id' => $site_id]);
        }
        $res = model('express_template')->update(['is_default' => 1], ['template_id' => $template_id]);

        Cache::tag("express_template_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 获取运费模板信息
     * @param unknown $template_id
     * @param unknown $site_id
     */
    public function getExpressTemplateInfo($template_id, $site_id)
    {
        $cache = Cache::get("express_template_getExpressTemplateInfo_" . $template_id . '_' . $site_id);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('express_template')->getInfo([['template_id', '=', $template_id], ['site_id', '=', $site_id]], 'template_id, site_id, template_name, fee_type, create_time, modify_time, is_default, surplus_area_ids');
        if ($res) {
            $res['template_item'] = model('express_template_item')->getList([['template_id', '=', $template_id]], '*');
        }
        Cache::tag("express_template_" . $site_id)->set("express_template_getExpressTemplateInfo_" . $template_id . '_' . $site_id, $res);
        return $this->success($res);
    }

    /**
     * 获取默认运费模板
     * @param unknown $site_id
     * @return multitype:string
     */
    public function getDefaultTemplate($site_id)
    {
        $cache = Cache::get("express_template_getDefaultTemplate_" . $site_id);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('express_template')->getInfo([['is_default', '=', 1], ['site_id', '=', $site_id]], 'template_id, site_id, template_name, fee_type, create_time, modify_time, is_default');
        if ($res) {
            $res['template_item'] = model('express_template_item')->getList([['template_id', '=', $res['template_id']]], '*');
        }
        Cache::tag("express_template_" . $site_id)->set("express_template_getDefaultTemplate_" . $site_id, $res);
        return $this->success($res);
    }

    /**
     * 获取运费模板列表（主表查询）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getExpressTemplateList($condition = [], $field = 'template_id, site_id, template_name, fee_type, create_time, modify_time, is_default', $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';

        $data  = json_encode([$condition, $field, $order, $limit]);
        $cache = Cache::get("express_template_getExpressTemplateList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('express_template')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("express_template_" . $site_id)->set("express_template_getExpressTemplateList_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取运费模板列表（主表查询）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getExpressTemplatePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'template_id, site_id, template_name, fee_type, create_time, modify_time, is_default')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id         = isset($check_condition['site_id']) ? $check_condition['site_id'] : '';
        $data            = json_encode([$condition, $field, $order, $page, $page_size]);
        $cache           = Cache::get("express_template_getExpressTemplatePageList_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('express_template')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("express_template_" . $site_id)->set("express_company_getExpressTemplatePageList_" . $data, $list);
        return $this->success($list);
    }

}