<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\goods;

use think\facade\Cache;
use app\model\BaseModel;
use think\facade\Db;

/**
 * 商品分类
 */
class GoodsCategory extends BaseModel
{

    /**
     * 添加商品分类
     * @param $data
     * @return \multitype
     */
    public function addCategory($data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $category_id = model('goods_category')->add($data);
        model('goods_category')->update([ 'category_id_' . $data[ 'level' ] => $category_id ], [ [ 'category_id', '=', $category_id ] ]);
        Cache::tag("goods_category_" . $site_id)->clear();
        return $this->success($category_id);
    }

    /**
     * 修改商品分类
     * @param $data
     * @return \multitype
     */
    public function editCategory($data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        model('goods_category')->startTrans();
        try {

            //获取该分类信息
            $info = model('goods_category')->getInfo([ [ 'category_id', '=', $data[ 'category_id' ] ], [ 'site_id', '=', $site_id ] ]);
            if ($data[ 'is_show' ] == -1) {

                switch ( $info[ 'level' ] ) {
                    case 1:
                        model('goods_category')->update([ 'is_show' => -1 ], [ [ 'category_id_1', '=', $info[ 'category_id_1' ] ] ]);
                        break;

                    case 2:
                        model('goods_category')->update([ 'is_show' => -1 ], [ [ 'category_id_2', '=', $info[ 'category_id_2' ] ] ]);
                        break;
                }
            } else {
                switch ( $info[ 'level' ] ) {
                    case 2:
                        model('goods_category')->update([ 'is_show' => 0 ], [ [ 'category_id', '=', $info[ 'category_id_1' ] ] ]);
                        break;
                    case 3:
                        model('goods_category')->update([ 'is_show' => 0 ], [ [ 'category_id', 'in', [ $info[ 'category_id_1' ], $info[ 'category_id_2' ] ] ] ]);
                        break;
                }
            }

            if ($info['pid'] != $data['pid']) {
                if ($info[ 'level' ] == 2) {
                    model('goods')->update([
                        'category_json' => Db::raw("REPLACE(category_json, '[\"{$info['pid']},{$data[ 'category_id' ]},', '[\"{$data['pid']},{$data[ 'category_id' ]},')")
                    ], [ [ 'category_id', 'like', "%,{$info['pid']},{$data[ 'category_id' ]},%"], [ 'site_id', '=', $site_id ] ]);

                    model('goods')->update([
                        'category_json' => Db::raw("REPLACE(category_json, '[\"{$info['pid']},{$data[ 'category_id' ]}\"]', '[\"{$data['pid']},{$data[ 'category_id' ]}\"]')")
                    ], [ [ 'category_id', 'like', "%,{$info['pid']},{$data[ 'category_id' ]},%"], [ 'site_id', '=', $site_id ] ]);

                    model('goods')->update([
                        'category_id' => Db::raw("REPLACE(category_id, ',{$info['pid']},{$data[ 'category_id' ]},', ',{$data['pid']},{$data[ 'category_id' ]},')")
                    ], [ [ 'category_id', 'like', "%,{$info['pid']},{$data[ 'category_id' ]},%"], [ 'site_id', '=', $site_id ] ]);
                } else {
                    model('goods')->update([
                        'category_json' => Db::raw("REPLACE(category_json, '[\"{$info['category_id_1']},{$info['category_id_2']},{$info['category_id_3']}\"]', '[\"{$data['category_id_1']},{$data['category_id_2']},{$data['category_id_3']}\"]')")
                    ], [ [ 'category_id', 'like', "%,{$info['pid']},{$data[ 'category_id' ]},%"], [ 'site_id', '=', $site_id ] ]);

                    model('goods')->update([
                        'category_id' => Db::raw("REPLACE(category_id, ',{$info['category_id_1']},{$info[ 'category_id_2' ]},{$info[ 'category_id_3' ]},', ',{$data['category_id_1']},{$data[ 'category_id_2' ]},{$data[ 'category_id_3' ]},')")
                    ], [ [ 'category_id', 'like', "%,{$info['pid']},{$data[ 'category_id' ]},%"], [ 'site_id', '=', $site_id ] ]);
                }

            }

            $res = model('goods_category')->update($data, [ [ 'category_id', '=', $data[ 'category_id' ] ], [ 'site_id', '=', $site_id ] ]);
            Cache::tag("goods_category_" . $site_id)->clear();

            model('goods_category')->commit();
            return $this->success($res);

        } catch (\Exception $e) {

            model('goods_category')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 删除分类
     * @param $category_id
     * @return \multitype
     */
    public function deleteCategory($category_id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        //判断该分类下是否存在商品
        $goods_count = model('goods')->getCount([ [ 'category_id', 'like', '%,' . $category_id . ',%' ], [ 'site_id', '=', $site_id ] ]);
        if ($goods_count > 0) {
            return $this->error('', '该分类下存在商品，暂不能删除');
        }

        $goods_category_info = $this->getCategoryInfo([
            [ 'category_id', '=', $category_id ], [ 'site_id', '=', $site_id ]
        ], "level");
        $goods_category_info = $goods_category_info[ 'data' ];
        $field = "category_id_" . $goods_category_info[ 'level' ];
        $res = model('goods_category')->delete([ [ $field, '=', $category_id ], [ 'site_id', '=', $site_id ] ]);

        Cache::tag("goods_category_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 获取商品分类信息
     * @param array $condition
     * @param string $field
     */
    public function getCategoryInfo($condition, $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,keywords,description,attr_class_id,attr_class_name,category_id_1,category_id_2,category_id_3,category_full_name,commission_rate,image_adv')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field ]);
        $cache = Cache::get("goods_category_getCategoryInfo_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('goods_category')->getInfo($condition, $field);
        Cache::tag("goods_category_" . $site_id)->set("goods_category_getCategoryInfo_" . $site_id . "_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取商品分类列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryList($condition = [], $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,attr_class_id,attr_class_name,category_id_1,category_id_2,category_id_3,commission_rate,image_adv', $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_category_getCategoryList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_category')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_category_" . $site_id)->set("goods_category_getCategoryList_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品分类树结构
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryTree($condition = [], $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,attr_class_name,category_id_1,category_id_2,category_id_3,commission_rate', $order = 'sort asc,category_id desc', $limit = null)
    {

        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_category_getCategoryTree_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_category')->getList($condition, $field, $order, '', '', '', $limit);

        $goods_category_list = [];

        //遍历一级商品分类
        foreach ($list as $k => $v) {
            if ($v[ 'level' ] == 1) {
                $goods_category_list[] = $v;
                unset($list[ $k ]);
            }
        }

        $list = array_values($list);

        //遍历二级商品分类
        foreach ($list as $k => $v) {
            foreach ($goods_category_list as $ck => $cv) {
                if ($v[ 'level' ] == 2 && $cv[ 'category_id' ] == $v[ 'pid' ]) {
                    $goods_category_list[ $ck ][ 'child_list' ][] = $v;
                    unset($list[ $k ]);
                }
            }
        }

        $list = array_values($list);

        //遍历三级商品分类
        foreach ($list as $k => $v) {
            foreach ($goods_category_list as $ck => $cv) {

                if (!empty($cv[ 'child_list' ])) {
                    foreach ($cv[ 'child_list' ] as $third_k => $third_v) {

                        if ($v[ 'level' ] == 3 && $third_v[ 'category_id' ] == $v[ 'pid' ]) {
                            $goods_category_list[ $ck ][ 'child_list' ][ $third_k ][ 'child_list' ][] = $v;
                            unset($list[ $k ]);
                        }
                    }
                }
            }
        }

        Cache::tag("goods_category_" . $site_id)->set("goods_category_getCategoryTree_" . $site_id . "_" . $data, $goods_category_list);

        return $this->success($goods_category_list);
    }

    /**
     * 获取商品分类分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getCategoryPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,category_id_1,category_id_2,category_id_3,category_full_name,commission_rate')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $page, $page_size ]);
        $cache = Cache::get("goods_category_getCategoryPageList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_category')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("goods_category_" . $site_id)->set("goods_category_getCategoryPageList_" . $site_id . "_" . $data, $list);
        return $this->success($list);
    }

    /**
     * 获取商品分类列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getCategoryByParent($condition = [], $field = 'category_id,category_name,short_name,pid,level,is_show,sort,image,attr_class_id,attr_class_name,category_id_1,category_id_2,category_id_3,commission_rate', $order = '', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_category_getCategoryByParent_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_category')->getList($condition, $field, $order, '', '', '', $limit);
        foreach ($list as $k => $v) {
            $child_count = model('goods_category')->getCount([ 'pid' => $v[ 'category_id' ] ]);
            $list[ $k ][ 'child_count' ] = $child_count;
        }

        Cache::tag("goods_category_" . $site_id)->set("goods_category_getCategoryByParent_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $category_id
     */
    public function modifyGoodsCategorySort($sort, $category_id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_category')->update([ 'sort' => $sort ], [ [ 'category_id', '=', $category_id ], [ 'site_id', '=', $site_id ] ]);
        Cache::tag("goods_category_" . $site_id)->clear();
        return $this->success($res);
    }

}