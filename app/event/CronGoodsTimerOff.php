<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */
namespace app\event;

use app\model\goods\Goods;

/**
 * 定时下架商品
 * @author Administrator
 *
 */
class CronGoodsTimerOff
{
    public function handle($param)
    {

        $goods_model = new Goods();
        $condition = [
            [ 'goods_id', '=', $param['relate_id'] ]
        ];
        $res = $goods_model->cronModifyGoodsState($condition,0);
        return $res;
    }
}
