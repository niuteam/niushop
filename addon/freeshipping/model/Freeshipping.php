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

namespace addon\freeshipping\model;

use app\model\BaseModel;

class Freeshipping extends BaseModel
{
    /**
     * 添加满额包邮
     * @param $groupbuy_data
     * @return array|\multitype
     */
    public function addFreeshipping($data)
    {
        $data['create_time'] = time();
        $area_ids            = json_decode($data['area_ids'], true);
        if (!empty($area_ids)) {
            foreach ($area_ids['2'] as $k => $v) {
                if (!empty($area_ids['2'])) {
                    foreach ($v as $area_id) {

                        //判断该城市是否已存在
                        $count = model('promotion_freeshipping')->getCount(
                            [
                                ['site_id', '=', $data['site_id']],
                                ['area_ids', 'like', '%' . $area_id . '%'],
                            ]
                        );
                        if ($count > 0) {
                            return $this->error('', '指定地区城市不能重复');
                        }
                    }
                }

            }
        }

        $res = model('promotion_freeshipping')->add($data);

        return $this->success($res);

    }

    /**
     * 编辑满额包邮
     * @param $groupbuy_id
     * @param $site_id
     * @param $groupbuy_data
     * @return array|\multitype
     */
    public function editFreeshipping($data)
    {
        $freeshipping_id = $data['freeshipping_id'];
        unset($data['freeshipping_id']);
        $data['update_time'] = time();
        $area_ids            = json_decode($data['area_ids'], true);
        if (!empty($area_ids)) {
            foreach ($area_ids['2'] as $k => $v) {
                if (!empty($area_ids['2'])) {
                    foreach ($v as $area_id) {

                        //判断该城市是否已存在
                        $count = model('promotion_freeshipping')->getCount(
                            [
                                ['site_id', '=', $data['site_id']],
                                ['area_ids', 'like', '%' . $area_id . '%'],
                                ['freeshipping_id', '<>', $freeshipping_id]
                            ]
                        );
                        if ($count > 0) {
                            return $this->error('', '指定地区城市不能重复');
                        }
                    }
                }

            }
        }

        $res = model('promotion_freeshipping')->update($data,
            [['site_id', '=', $data['site_id']], ['freeshipping_id', '=', $freeshipping_id]]
        );
        return $this->success($res);
    }

    /**
     * 删除满额包邮活动
     * @param $groupbuy_id
     * @param $site_id
     * @return array|\multitype
     */
    public function deleteFreeshipping($freeshipping_id, $site_id)
    {
        $list = model('promotion_freeshipping')->delete([['freeshipping_id', '=', $freeshipping_id], ['site_id', '=', $site_id]]);
        return $this->success($list);
    }

    /**
     * 获取信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getFreeshippingInfo($condition = [], $field = '*')
    {
        $res = model('promotion_freeshipping')->getInfo($condition, $field);
        return $this->success($res);
    }

    /**
     * 获取满额包邮分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getFreeshippingPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('promotion_freeshipping')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }


    /********************************************************************* 订单核验是否符合地区 start*****************************************************************************/

    /**
     * 是否符合满额包邮
     * @param $money
     * @param $city_id
     * @param $site_id
     * @return array
     */
    public function calculate($money, $city_id, $site_id)
    {
        $condition = array(
            ['price', "<=", $money],
            ['site_id', "=", $site_id],
            ['area_ids', 'like', '%"' . $city_id . '"%']
        );

        $info = model('promotion_freeshipping')->getInfo($condition, '*');
        if (!empty($info)) {
            return $this->success($info);
        } else {
            return $this->error();
        }
    }
    /********************************************************************* 订单核验是否符合地区 end*****************************************************************************/

}