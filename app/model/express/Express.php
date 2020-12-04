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


use app\model\BaseModel;
use think\facade\Db;

/**
 * 物流配送
 */
class Express extends BaseModel
{
    const express_type = [
        'express' => ["name" => "express", "title" => "物流配送"],
        'store'   => ["name" => "store", "title" => "门店自提"],
        'local'   => ["name" => "local", "title" => "外卖配送"],
    ];

    /**
     * 计算费用
     * @param array $shop_goods
     * @param array $data
     */
    public function calculate($shop_goods, $data)
    {

        //模板分组
        $template_array = [];
        foreach ($shop_goods['goods_list'] as $k => $v) {
            if ($v['is_free_shipping'] == 1) {
                continue;
            }
            if (isset($template_array[$v['shipping_template']])) {
                $template_array[$v['shipping_template']] = [
                    'num'    => $template_array[$v['shipping_template']]['num'] + $v['num'],
                    'weight' => $template_array[$v['shipping_template']]['weight'] + $v['weight'] * $v['num'],
                    'volume' => $template_array[$v['shipping_template']]['volume'] + $v['volume'] * $v['num'],
                ];
            } else {
                $template_array[$v['shipping_template']] = [
                    'num'    => $v['num'],
                    'weight' => $v['weight'] * $v['num'],
                    'volume' => $v['volume'] * $v['num'],
                ];
            }
        }
        $express_template = new ExpressTemplate();
        $price            = 0;
        foreach ($template_array as $k_template => $v_template) {
            if ($k_template == 0) {
                //默认模板
                $template_info = $express_template->getDefaultTemplate($shop_goods['site_id']);

            } else {
                //默认模板
                $template_info = $express_template->getExpressTemplateInfo($k_template, $shop_goods['site_id']);
            }

            //判断模板是否配置完善
            if (empty($template_info["data"])) {
                //                continue;
                return $this->error([], "TEMPLATE_EMPTY");
            }

            $template_info = $template_info["data"];

            //开始计算
            $is_exist_template = false;
            foreach ($template_info['template_item'] as $k_item => $v_item) {
                if (strpos($v_item['area_ids'], '"' . $data['member_address']['district_id'] . '"') !== false) {
                    $is_exist_template = true;
                    //运算方式
                    switch ($template_info['fee_type']) {

                        case 1:
                            $tag = $v_template['weight'];
                            break;
                        case 2:
                            $tag = $v_template['volume'];
                            break;
                        case 3:
                            $tag = $v_template['num'];
                            break;
                        default:
                            break;
                    }
                    //开始计算
                    if ($tag <= $v_item['snum']) {
                        $price += $v_item['sprice'];
                    } else {
                        $ext_tag = $tag - $v_item['snum'];
                        if ($v_item['xnum'] == 0) {
                            $v_item['xnum'] = 1;
                        }
                        if (($ext_tag * 100) % ($v_item['xnum'] * 100) == 0) {
                            $ext_data = $ext_tag / $v_item['xnum'];
                        } else {
                            $ext_data = floor($ext_tag / $v_item['xnum']) + 1;
                        }
                        $price += $v_item['sprice'] + $ext_data * $v_item['xprice'];
                    }
                    break;
                }

            }
            if ($is_exist_template == false) {
                return $this->error('', "TEMPLATE_AREA_EXIST");
            }
        }
        return $this->success(["delivery_fee" => $price]);
    }


    /**
     * 区域是否支持配送
     * @param $condition
     */
    public function isSupportDelivery($area_id, $site_id)
    {

        $condition = array(
            ['ati.area_ids', 'like', '"' . $area_id . '"'],
            ['et.site_id', '=', $site_id]
        );

        $alias = 'ati';
        $join  = [
            [
                'express_template et',
                'et.template_id = ati.template_id',
                'left'
            ]
        ];
        $field = 'ati.template_id';

        $list = model('express_template_item')->getList($condition, $field, '', $alias, $join);
        if (empty($list)) {
            return $this->error('', "TEMPLATE_AREA_EXIST");
        } else {
            return $this->success();
        }
    }

}