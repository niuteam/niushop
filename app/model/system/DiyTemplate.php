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

namespace app\model\system;

use app\model\BaseModel;

class DiyTemplate extends BaseModel
{
    /**
     * 刷新自定义模板
     */
    public function refresh()
    {
        try {
            // 获取系统内置的自定义模板
            $dirs = array_map('basename', glob('public/diy_view/*', GLOB_ONLYDIR));
            if (!empty($dirs)) {
                foreach ($dirs as $key => $value) {
                    if (file_exists('public/diy_view/' . $value . '/config.json')) {
                        $config_json = file_get_contents('public/diy_view/' . $value . '/config.json');
                        $config      = json_decode($config_json, true);

                        foreach ($config['templateValue'] as $type => $template_item) {
                            $template_info = $config['templateInfo'];
                            $data          = [
                                'title' => $template_info['name'],
                                'desc'  => $template_info['desc'],
                                'mark'  => $template_info['mark'],
                                'type'  => $type,
                                'value' => json_encode($template_item['data'], JSON_UNESCAPED_UNICODE),
                                'image' => $template_item['image']
                            ];

                            $info = model('div_template')->getInfo([['mark', '=', $template_info['mark']], ['type', '=', $type]]);
                            if (!empty($info)) {
                                model('div_template')->update($data, [['id', '=', $info['id']]]);
                            } else {
                                model('div_template')->add($data);
                            }
                        }
                    }
                }
            }
            return $this->success();
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取模板信息
     * @param $condition
     * @param $field
     * @return array
     */
    public function getTemplateInfo($condition, $field = '*')
    {
        $data = model('div_template')->getInfo($condition, $field);
        return $this->success($data);
    }

    /**
     * 获取模板分页列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param int $page
     * @param int $list_rows
     * @return array
     */
    public function getTemplatePageList($condition = [], $field = true, $order = '', $page = 1, $list_rows = PAGE_LIST_ROWS)
    {
        $data = model('div_template')->pageList($condition, $field, $order, $page, $list_rows);
        return $this->success($data);
    }
}