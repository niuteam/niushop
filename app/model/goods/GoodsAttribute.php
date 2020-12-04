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

/**
 * 商品类型、属性
 */
class GoodsAttribute extends BaseModel
{

    /************************************************************商品类型*********************************************/

    /**
     * 添加商品类型
     * @param $data
     * @return \multitype
     */
    public function addAttrClass($data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $class_id = model("goods_attr_class")->add($data);
        Cache::tag("goods_attr_class_" . $site_id)->clear();
        return $this->success($class_id);
    }

    /**
     * 编辑商品类型
     * @param $data
     * @return \multitype
     */
    public function editAttrClass($data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model("goods_attr_class")->update($data, [ [ 'class_id', '=', $data[ 'class_id' ] ], [ 'site_id', '=', $data[ 'site_id' ] ] ]);
        if (!empty($data[ 'class_name' ])) {
            //修改属性表
            model("goods_attribute")->update([ 'attr_class_name' => $data[ 'class_name' ] ], [ [ 'attr_class_id', '=', $data[ 'class_id' ] ] ]);
        }
        //预留修改商品
        Cache::tag("goods_attr_class_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 删除商品类型
     * @param $class_id
     * @return \multitype
     */
    public function deleteAttrClass($class_id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_attr_class')->delete([ [ 'class_id', '=', $class_id ], [ 'site_id', '=', $site_id ] ]);
        if ($res) {

            // 删除商品属性
            model('goods_attribute')->delete([ [ 'attr_class_id', '=', $class_id ] ]);
            Cache::tag("goods_attribute_" . $site_id . "_" . $class_id)->clear();

        }
        Cache::tag("goods_attr_class_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 修改排序
     * @param int $sort
     * @param int $class_id
     */
    public function modifyAttrClassSort($sort, $class_id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_attr_class')->update([ 'sort' => $sort ], [ [ 'class_id', '=', $class_id ], [ 'site_id', '=', $site_id ] ]);
        Cache::tag("goods_attr_class_" . $site_id)->clear();
        return $this->success($res);
    }

    /**
     * 获取商品类型信息
     * @param array $condition
     * @param string $field
     */
    public function getAttrClassInfo($condition, $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field ]);
        $cache = Cache::get("goods_attr_class_getAttrClassInfo_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('goods_attr_class')->getInfo($condition, $field);
        Cache::tag("goods_attr_class_" . $site_id)->set("goods_attr_class_getAttrClassInfo_" . $site_id . "_" . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取商品类型列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getAttrClassList($condition = [], $field = 'class_id,class_name,sort', $order = 'class_id desc', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_attr_class_getAttrClassList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_attr_class')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_attr_class_" . $site_id)->set("goods_attr_class_getAttrClassList_" . $site_id . "_" . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品类型分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getAttrClassPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'sort asc', $field = 'class_id,class_name,sort')
    {
        $check_condition = array_column($condition, 2, 0);
        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $page, $page_size ]);
        $cache = Cache::get("goods_attr_class_getAttrClassPageList_" . $site_id . "_" . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $list = model('goods_attr_class')->pageList($condition, $field, $order, $page, $page_size);
        Cache::tag("goods_attr_class_" . $site_id)->set("goods_attr_class_getAttrClassPageList_" . $site_id . "_" . $data, $list);
        return $this->success($list);
    }


    /************************************************************商品属性*********************************************/

    /**
     * 添加商品属性
     * @param $attr_class_id
     * @param $data
     * @return \multitype
     */
    public function addAttribute($attr_class_id, $data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $attr_id = model("goods_attribute")->add($data);
        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->clear();
        return $this->success($attr_id);
    }

    /**
     * 编辑商品属性
     * @param $attr_class_id
     * @param $data
     * @return \multitype
     */
    public function editAttribute($attr_class_id, $data)
    {
        $site_id = isset($data[ 'site_id' ]) ? $data[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model("goods_attribute")->update($data, [ [ 'attr_id', '=', $data[ 'attr_id' ] ], [ 'attr_class_id', '=', $attr_class_id ], [ 'site_id', '=', $site_id ] ]);
        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->clear();
        return $this->success($res);
    }

    /**
     * 删除属性
     * @param $attr_class_id
     * @param $attr_id
     * @return \multitype
     */
    public function deleteAttribute($attr_class_id, $attr_id, $site_id)
    {
        $site_id = isset($site_id) ? $site_id : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $res = model('goods_attribute')->delete([ [ 'attr_id', '=', $attr_id ], [ 'attr_class_id', '=', $attr_class_id ], [ 'site_id', '=', $site_id ] ]);

        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->clear();
        return $this->success($res);
    }

    /**
     * 修改排序
     * @param $sort
     * @param $attr_class_id
     * @param $attr_id
     * @param $site_id
     * @return array
     */
    public function modifyAttributeSort($sort, $attr_class_id, $attr_id, $site_id)
    {
        $res = model('goods_attribute')->update([ 'sort' => $sort ], [ [ 'attr_id', '=', $attr_id ], [ 'site_id', '=', $site_id ] ]);
        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->clear();
        return $this->success($res);
    }


    /**
     * 获取属性信息
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getAttributeInfo($condition, $field = '*')
    {
        $check_condition = array_column($condition, 2, 0);
        $attr_class_id = isset($check_condition[ 'attr_class_id' ]) ? $check_condition[ 'attr_class_id' ] : '';
        if ($attr_class_id === '') {
            return $this->error('', 'REQUEST_GOODS_ATTRIBUTE_ID');
        }

        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field ]);
        $cache = Cache::get("goods_attribute_getAttributeInfo_" . $site_id . "_" . $attr_class_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $res = model('goods_attribute')->getInfo($condition, $field);
        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->set("goods_attribute_getAttributeInfo_" . $site_id . "_" . $attr_class_id . '_' . $data, $res);
        return $this->success($res);
    }

    /**
     * 获取商品属性列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getAttributeList($condition = [], $field = '*', $order = 'sort asc', $limit = null)
    {
        $check_condition = array_column($condition, 2, 0);
        $attr_class_id = isset($check_condition[ 'attr_class_id' ]) ? $check_condition[ 'attr_class_id' ] : '';
        if ($attr_class_id === '') {
            return $this->error('', 'REQUEST_GOODS_ATTRIBUTE_ID');
        }

        $site_id = isset($check_condition[ 'site_id' ]) ? $check_condition[ 'site_id' ] : '';
        if ($site_id === '') {
            return $this->error('', 'REQUEST_SITE_ID');
        }

        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_attribute_getAttributeList_" . $site_id . "_" . $attr_class_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('goods_attribute')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_attribute_" . $site_id . "_" . $attr_class_id)->set("goods_attribute_getAttributeList_" . $site_id . "_" . $attr_class_id . '_' . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品规格列表，暂时不加缓存
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getSpecList($condition = [], $field = 'attr_id,attr_name,attr_class_id,sort,is_query,is_spec,attr_value_list,attr_value_list,attr_type,site_id', $order = 'sort asc', $limit = null)
    {
        $list = model('goods_attribute')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /************************************************************商品属性值*********************************************/

    /**
     * 添加属性值
     * @param $attr_class_id
     * @param $data
     * @return \multitype
     */
    public function addAttributeValue($attr_class_id, $data)
    {
        $attr_value_id = model("goods_attribute_value")->addList($data);
        if ($attr_value_id) {
//			刷新属性值JSON格式
            $this->refreshAttrValueFormat($attr_class_id, $data[ 0 ][ 'attr_id' ]);
            Cache::tag("goods_attribute_value_" . $attr_class_id)->clear();
            return $this->success($attr_value_id);
        } else {
            return $this->error();
        }
    }

    /**
     * 编辑商品属性值
     * @param $attr_class_id
     * @param $data
     * @return \multitype
     */
    public function editAttributeValue($attr_class_id, $data)
    {
        $res = model("goods_attribute_value")->update($data, [ [ 'attr_value_id', '=', $data[ 'attr_value_id' ] ] ]);
        if ($res) {
//			刷新属性值JSON格式
            $this->refreshAttrValueFormat($attr_class_id, $data[ 'attr_id' ]);
            Cache::tag("goods_attribute_value_" . $attr_class_id)->clear();
            return $this->success($res);
        } else {
            return $this->error();
        }
    }

    /**
     * 刷新属性值JSON格式
     * @param $attr_class_id
     * @param $attr_id
     */
    private function refreshAttrValueFormat($attr_class_id, $attr_id)
    {
        $list = model('goods_attribute_value')->getList([ [ 'attr_id', '=', $attr_id ] ], 'attr_value_id,attr_value_name');
        if (!empty($list)) {
            $attr_value_format = [];
            foreach ($list as $k => $v) {
                $item = [
                    'attr_value_id' => $v[ 'attr_value_id' ],
                    'attr_value_name' => $v[ 'attr_value_name' ]
                ];
                $attr_value_format[] = $item;
            }
            $res = model("goods_attribute")->update([ 'attr_value_format' => json_encode($attr_value_format) ], [ [ 'attr_id', '=', $attr_id ], [ 'attr_class_id', '=', $attr_class_id ] ]);
            Cache::tag("goods_attribute_" . $attr_class_id)->clear();
            return $this->success($res);
        }
    }

    /**
     * 删除属性值
     * @param $attr_class_id
     * @param $condition
     * @return \multitype
     */
    public function deleteAttributeValue($attr_class_id, $condition)
    {
        $res = model('goods_attribute_value')->delete($condition);
        Cache::tag("goods_attribute_value_" . $attr_class_id)->clear();
        return $this->success($res);
    }

    /**
     * 获取商品属性值列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getAttributeValueList($condition = [], $field = 'attr_value_id,attr_value_name,attr_id,attr_class_id,sort', $order = '', $limit = null)
    {

        $check_condition = array_column($condition, 2, 0);
        $attr_class_id = isset($check_condition[ 'attr_class_id' ]) ? $check_condition[ 'attr_class_id' ] : '';
        if ($attr_class_id === '') {
            return $this->error('', 'REQUEST_GOODS_ATTRIBUTE_ID');
        }
        $data = json_encode([ $condition, $field, $order, $limit ]);
        $cache = Cache::get("goods_attribute_value_getAttributeValueList_" . $attr_class_id . '_' . $data);
        if (!empty($cache)) {
            return $this->success($cache);
        }

        $list = model('goods_attribute_value')->getList($condition, $field, $order, '', '', '', $limit);
        Cache::tag("goods_attribute_value_" . $attr_class_id)->set("goods_attribute_value_getAttributeValueList_" . $attr_class_id . '_' . $data, $list);

        return $this->success($list);
    }

    /**
     * 获取商品规格值列表，暂时不加缓存
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return \multitype
     */
    public function getSpecValueList($condition = [], $field = 'attr_value_id,attr_value_name,attr_id,attr_class_id,sort', $order = 'attr_value_id desc', $limit = null)
    {
        $list = model('goods_attribute_value')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

}