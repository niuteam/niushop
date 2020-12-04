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
use app\model\web\DiyView as DiyViewModel;

/**
 * 自定义页面编辑
 */
class DiyViewEdit extends Controller
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {
        $diy_view = new DiyViewModel();

        // 自定义模板组件集合
        $utils = $diy_view->getDiyViewUtilList($data[ 'condition' ]);

        $diy_view_info = [];
        // 推广码
        $qrcode_info = [];
        if (!empty($data[ 'id' ])) {
            $diy_view_info = $diy_view->getSiteDiyViewDetail([
                [ 'sdv.site_id', '=', $data[ 'site_id' ] ],
                [ 'sdv.id', '=', $data[ 'id' ] ]
            ]);
            $qrcode_info = $diy_view->qrcode([
                [ 'site_id', '=', $data[ 'site_id' ] ],
                [ 'id', '=', $data[ 'id' ] ]
            ]);
        } elseif (!empty($data[ 'name' ])) {
            $condition = [
                [ 'sdv.site_id', '=', $data[ 'site_id' ] ],
                [ 'sdv.name', '=', $data[ 'name' ] ]
            ];
            $qrcode_info = $diy_view->qrcode([
                [ 'site_id', '=', $data[ 'site_id' ] ],
                [ 'name', '=', $data[ 'name' ] ]
            ]);
            $diy_view_info = $diy_view->getSiteDiyViewDetail($condition);
        }

        if (!empty($diy_view_info) && !empty($diy_view_info[ 'data' ])) {
            $diy_view_info = $diy_view_info[ 'data' ];
        }
        if (!empty($qrcode_info)) {
            $qrcode_info = $qrcode_info[ 'data' ];
            // 目前只支持H5
            if ($qrcode_info[ 'path' ][ 'h5' ][ 'status' ] != 1) {
                $qrcode_info = [];
            }
        }

        $diy_view_utils = array ();
        if (!empty($utils[ 'data' ])) {

            // 先遍历，组件分类
            foreach ($utils[ 'data' ] as $k => $v) {
                $value = array ();
                $value[ 'type' ] = $v[ 'type' ];
                $value[ 'type_name' ] = $diy_view->getTypeName($v[ 'type' ]);
                $value[ 'list' ] = [];
                if (!in_array($value, $diy_view_utils)) {
                    array_push($diy_view_utils, $value);
                }
            }

            // 遍历每一个组件，将其添加到对应的分类中
            foreach ($utils[ 'data' ] as $k => $v) {
                foreach ($diy_view_utils as $diy_k => $diy_v) {
                    if ($diy_v[ 'type' ] == $v[ 'type' ]) {
                        array_push($diy_view_utils[ $diy_k ][ 'list' ], $v);
                    }
                }
            }
        }

        // 已知插件：【秒杀、团购、拼团、砍价、优惠券、分销、直播、门店、店铺笔记】
        if (!empty($diy_view_info)) {
            if (!empty($diy_view_info[ 'value' ])) {
                $json_data = json_decode($diy_view_info[ 'value' ], true);
                foreach ($json_data[ 'value' ] as $k => $v) {
                    if (!empty($v[ 'addon_name' ])) {
                        $is_exit = addon_is_exit($v[ 'addon_name' ], $data[ 'site_id' ]);
                        // 检查插件是否存在
                        if ($is_exit == 0) {
                            unset($json_data[ 'value' ][ $k ]);
                        }
                    }
                }
                $json_data[ 'value' ] = array_values($json_data[ 'value' ]);
                $diy_view_info[ 'value' ] = json_encode($json_data);
            }
        }

        $this->assign("time", time());
        $this->assign("name", isset($data[ 'name' ]) ? $data[ 'name' ] : '');
        $this->assign("store_id", isset($data[ 'store_id' ]) ? $data[ 'store_id' ] : 0);

        // 禁止编辑页面设置（商品分类单页用）
        $this->assign("disabled_page_set", isset($data[ 'disabled_page_set' ]) ? $data[ 'disabled_page_set' ] : '');
        $this->assign("qrcode_info", $qrcode_info);
        $this->assign('diy_view_utils', $diy_view_utils);
        $this->assign("diy_view_info", $diy_view_info);

        $request_url = $data[ 'app_module' ] . '/diy/edit';

        $replace = [];
        if ($data[ 'app_module' ] == 'store') {
            $replace = [
                'STORE_CSS' => __ROOT__ . '/addon/store/store/view/public/css',
                'STORE_JS' => __ROOT__ . '/addon/store/store/view/public/js',
                'STORE_IMG' => __ROOT__ . '/addon/store/store/view/public/img',
            ];

            $request_url = 'store://' . $data[ 'app_module' ] . '/diy/index';
            $this->assign("extend_base", 'addon/store/' . $data[ 'app_module' ] . '/view/base.html');
        } else {
            $this->assign("extend_base", 'app/' . $data[ 'app_module' ] . '/view/base.html');
        }

        $this->assign("app_module", $data[ 'app_module' ]);
        $this->assign("request_url", $request_url);

        $template = dirname(realpath(__DIR__)) . '/shop/view/diy/edit.html';
        return $this->fetch($template, [], $replace);

    }

}