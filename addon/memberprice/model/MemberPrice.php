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

namespace addon\memberprice\model;

use app\model\BaseModel;

class MemberPrice extends BaseModel
{

    /**
     * @param $condition
     * @param $data
     * @param $member_price
     * @return array
     */
    public function editGoodsMemberPrice($condition, $data, $member_price)
    {

        model('goods')->startTrans();
        try {

            model('goods')->update($data, $condition);
            if ($data['discount_config'] == 1) {
                foreach ($member_price as $k => $v) {
                    $sku_condition        = $condition;
                    $data['member_price'] = json_encode($v);
                    $sku_condition[]      = ['sku_id', '=', $k];
                    model('goods_sku')->update($data, $sku_condition);
                }

            } else {
                $data['member_price'] = '';
                model('goods_sku')->update($data, $condition);
            }
            model('goods')->commit();
            return $this->success();

        } catch (\Exception $e) {

            model('goods')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

}