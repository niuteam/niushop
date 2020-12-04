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

namespace app\event;

use app\Controller;
use app\model\goods\GoodsCategory;
use app\model\web\DiyViewLink;

/**
 * 自定义链接
 */
class DiyLink extends Controller
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {

        $link = input("link", '');
        $support_diy_view = input("support_diy_view", '');//支持的自定义页面（为空表示都支持）
        $link_model = new DiyViewLink();
        $condition = [
            ['parent', '=', '']
        ];
        $list_result = $link_model->getLinkList($condition, '*', 'sort ASC');
        $list = $list_result['data'];
        foreach ($list as $k => $v) {

            $child_condition = [
                ['parent', '=', $v['name']]
            ];
            $child_list_result = $link_model->getLinkList($child_condition, '*', 'sort ASC');
            $child_list = $child_list_result['data'];
            $list[$k]['child_list'] = $child_list;
        }
        $this->assign('list', $list);
        $this->assign("link", $link);
        $this->assign('link_array', json_decode($link, true));
        $this->assign("support_diy_view", $support_diy_view);
        $this->assign("app_module", $data['app_module']);

        $replace = [];
        $request_url = $data['app_module'] . '/diy/childlink';

        if ($data['app_module'] == 'store') {
            $replace = [
                'STORE_CSS' => __ROOT__ . '/addon/store/store/view/public/css',
                'STORE_JS'  => __ROOT__ . '/addon/store/store/view/public/js',
                'STORE_IMG' => __ROOT__ . '/addon/store/store/view/public/img',
            ];

            $request_url = 'store://' . $data['app_module'] . '/diy/childlink';
        }

        $this->assign("request_url", $request_url);

        $template = dirname(realpath(__DIR__)) . '/shop/view/diy/link.html';


        $goods_category_model = new GoodsCategory();
        $category_condition[]          = ['site_id', '=', $data['site_id']];
        $category_list                 = $goods_category_model->getCategoryTree($category_condition);
        $category_list                 = $category_list['data'];
        $this->assign("category_list", $category_list);
        return $this->fetch($template, [], $replace);
    }

}