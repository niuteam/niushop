<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\model\goods\GoodsAttribute as GoodsAttributeModel;

/**
 * 商品类型/属性管理 控制器
 */
class Goodsattr extends BaseShop
{
    /**
     * 商品类型列表
     */
    public function lists()
    {
        if (request()->isAjax()) {

            $page_index = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_keys = input('search_keys', "");
            $condition = [];
            $condition[] = [ 'site_id', '=', $this->site_id ];
            if (!empty($search_keys)) {
                $condition[] = [ 'class_name', 'like', '%' . $search_keys . '%' ];
            }
            $goods_attr_model = new GoodsAttributeModel();
            $list = $goods_attr_model->getAttrClassPageList($condition, $page_index, $page_size);
            return $list;

        } else {

            return $this->fetch('goodsattr/lists');
        }
    }

    /**
     * 商品类型添加
     */
    public function addAttr()
    {
        if (request()->isAjax()) {
            $class_name = input('class_name', '');
            $sort = input('sort', 0);
            $data = [
                'site_id' => $this->site_id,
                'class_name' => $class_name,
                'sort' => $sort
            ];
            $goods_attr_model = new GoodsAttributeModel();
            $res = $goods_attr_model->addAttrClass($data);
            return $res;
        }
    }

    /**
     * 商品类型编辑
     */
    public function editAttr()
    {
        $goods_attr_model = new GoodsAttributeModel();
        if (request()->isAjax()) {

            $class_id = input("class_id", 0);
            $class_name = input('class_name', '');
            $sort = input('sort', 0);
            $data = [
                'class_id' => $class_id,
                'site_id' => $this->site_id,
                'class_name' => $class_name,
                'sort' => $sort
            ];
            $res = $goods_attr_model->editAttrClass($data);
            return $res;

        } else {
            $class_id = input("class_id", 0);
            $this->assign("class_id", $class_id);

            //商品类型信息
            $attr_class_info = $goods_attr_model->getAttrClassInfo([ [ 'class_id', '=', $class_id ], [ 'site_id', '=', $this->site_id ] ]);
            $attr_class_info = $attr_class_info[ 'data' ];
            $this->assign("attr_class_info", $attr_class_info);

            return $this->fetch('goodsattr/edit_attr');
        }
    }

    /**
     * 修改商品类型排序
     */
    public function modifySort()
    {
        if (request()->isAjax()) {

            $sort = input('sort', 0);
            $class_id = input('class_id', 0);
            $goods_attr_model = new GoodsAttributeModel();
            return $goods_attr_model->modifyAttrClassSort($sort, $class_id, $this->site_id);
        }
    }

    /**
     * 商品类型删除
     */
    public function deleteAttr()
    {
        if (request()->isAjax()) {

            $class_id = input("class_id", 0);
            $goods_attr_model = new GoodsAttributeModel();
            $result = $goods_attr_model->deleteAttrClass($class_id, $this->site_id);
            return $result;
        }
    }

    /**
     * 添加商品属性
     */
    public function addAttribute()
    {
        if (request()->isAjax()) {

            $attr_name = input('attr_name', "");// 属性名称
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_class_name = input('attr_class_name', "");// 商品类型名称
            $attr_value_list = input('attr_value_list', "");// 属性值列表（'',''隔开注意键值对）
            $attr_type = input('attr_type', 0);// 属性类型  （1.单选 2.多选3. 输入 注意输入不参与筛选）
            $site_id = $this->site_id;// 站点id

            $data = [
                'attr_name' => $attr_name,
                'attr_class_id' => $attr_class_id,
                'attr_class_name' => $attr_class_name,
                'attr_value_list' => $attr_value_list,
                'attr_type' => $attr_type,
                'site_id' => $site_id,
            ];

            $goods_attr_model = new GoodsAttributeModel();
            return $goods_attr_model->addAttribute($attr_class_id, $data);
        }

    }

    /**
     * 修改商品属性
     */
    public function editAttribute()
    {
        if (request()->isAjax()) {

            $attr_id = input('attr_id', "");// 属性id
            $attr_name = input('attr_name', "");// 属性名称
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_class_name = input('attr_class_name', "");// 商品类型名称
            $attr_value_list = input('attr_value_list', "");// 属性值列表（'',''隔开注意键值对）
            $attr_type = input('attr_type', 0);// 属性类型  （1.单选 2.多选3. 输入 注意输入不参与筛选）

            $data = [
                'attr_id' => $attr_id,
                'attr_name' => $attr_name,
                'attr_class_id' => $attr_class_id,
                'attr_class_name' => $attr_class_name,
                'attr_value_list' => $attr_value_list,
                'attr_type' => $attr_type,
                'site_id' => $this->site_id
            ];
            $goods_attr_model = new GoodsAttributeModel();
            return $goods_attr_model->editAttribute($attr_class_id, $data);
        }

    }

    /**
     * 删除属性、属性值
     * @return \multitype
     */
    public function deleteAttribute()
    {
        if (request()->isAjax()) {
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_id = input('attr_id', 0);// 属性id
            $goods_attr_model = new GoodsAttributeModel();
            $res = $goods_attr_model->deleteAttribute($attr_class_id, $attr_id, $this->site_id);
            return $res;
        }
    }

    /**
     * 获取属性、属性值详情
     * @return \multitype
     */
    public function getAttributeDetail()
    {
        if (request()->isAjax()) {
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_id = input('attr_id', 0);// 属性id

            $goods_attr_model = new GoodsAttributeModel();
            $attr_info = $goods_attr_model->getAttributeInfo([ [ 'attr_class_id', '=', $attr_class_id ], [ 'attr_id', '=', $attr_id ], [ 'site_id', '=', $this->site_id ] ]);
            $attr_info = $attr_info[ 'data' ];
            if (!empty($attr_info)) {
                $attr_value_list = $goods_attr_model->getAttributeValueList([ [ 'attr_class_id', '=', $attr_class_id ], [ 'attr_id', '=', $attr_id ] ]);
                $attr_value_list = $attr_value_list[ 'data' ];
                $attr_info[ 'value' ] = $attr_value_list;
                return success(0, '', $attr_info);
            } else {
                return error(-1, "未查询到属性信息");
            }
        }
    }

    /**
     * 获取商品属性列表
     * @return \multitype
     */
    public function getAttributeList()
    {
        if (request()->isAjax()) {
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $goods_attr_model = new GoodsAttributeModel();
            return $goods_attr_model->getAttributeList([ [ 'attr_class_id', '=', $attr_class_id ], [ 'site_id', '=', $this->site_id ] ]);
        }
    }

    /**
     * 添加属性值
     * @return \multitype
     */
    public function addAttributeValue()
    {

        if (request()->isAjax()) {
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $value = input('value', "");
            if (!empty($value)) {
                $value = json_decode($value, true);
                $data = [];
                foreach ($value as $k => $v) {
                    $item = [
                        'attr_value_name' => $v[ 'attr_value_name' ],
                        'attr_id' => $v[ 'attr_id' ],
                        'attr_class_id' => $v[ 'attr_class_id' ],
                        'sort' => $v[ 'sort' ]
                    ];
                    $data[] = $item;
                }
                $goods_attr_model = new GoodsAttributeModel();
                $res = $goods_attr_model->addAttributeValue($attr_class_id, $data);
                return $res;
            }
        } else {
            return error(-1, "缺少value");
        }
    }

    /**
     * 修改商品属性值
     */
    public function editAttributeValue()
    {
        if (request()->isAjax()) {

            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $data = input('data', "");// 属性值数组对象
            if (!empty($data)) {
                $data = json_decode($data, true);
                $goods_attr_model = new GoodsAttributeModel();
                foreach ($data as $k => $v) {
                    $item = [
                        'attr_value_id' => $v[ 'attr_value_id' ],
                        'attr_value_name' => $v[ 'attr_value_name' ],
                        'attr_id' => $v[ 'attr_id' ],
                        'attr_class_id' => $v[ 'attr_class_id' ],
                        'sort' => $v[ 'sort' ],
                    ];
                    $res = $goods_attr_model->editAttributeValue($attr_class_id, $item);
                }
                return $res;
            } else {
                return error(-1, "缺少data");
            }

        }

    }

    /**
     * 删除属性值
     * @return \multitype
     */
    public function deleteAttributeValue()
    {

        if (request()->isAjax()) {
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_value_id_arr = input('attr_value_id_arr', 0);
            $goods_attr_model = new GoodsAttributeModel();
            $res = $goods_attr_model->deleteAttributeValue($attr_class_id, [ [ 'attr_value_id', 'in', $attr_value_id_arr ] ]);
            return $res;
        }
    }

    /**
     * 修改商品属性值排序
     */
    public function modifyAttributeSort()
    {
        if (request()->isAjax()) {

            $sort = input('sort', 0);
            $attr_class_id = input('attr_class_id', 0);// 商品类型id
            $attr_id = input('attr_id', 0);
            $goods_attr_model = new GoodsAttributeModel();
            return $goods_attr_model->modifyAttributeSort($sort, $attr_class_id, $attr_id, $this->site_id);
        }
    }

}