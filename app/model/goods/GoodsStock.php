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

use app\model\BaseModel;
use think\facade\Cache;
use think\facade\Db;

/**
 * 商品库存
 */
class GoodsStock extends BaseModel
{

    /**
     * 增加库存
     * @param $param
     */
    public function incStock($param)
    {
        $condition = array(
            ["sku_id", "=", $param["sku_id"]]
        );
        $num       = $param["num"];
        $sku_info  = model("goods_sku")->getInfo($condition, "goods_id,stock");
        if (empty($sku_info))
            return $this->error(-1, "");

        //编辑sku库存
        $result = model("goods_sku")->setInc($condition, "stock", $num);

        //编辑商品总库存(暂不考虑查询判断)
        $goods_condition = array(
            ["goods_id", "=", $sku_info["goods_id"]]
        );
        $res             = model("goods")->setInc($goods_condition, "goods_stock", $num);
        return $this->success($result);
    }

    /**
     * 减少库存
     * @param $param
     */
    public function decStock($param)
    {
        
        $num       = $param["num"];
        $condition = array(
            ["sku_id", "=", $param["sku_id"]]
        );            
        $sku_info = Db::name("goods_sku")->where($condition)->field("goods_id,stock,sku_name")->lock(true)->find();
        if (empty($sku_info))
        {
            return $this->error();
        }
        if ($sku_info["stock"] < $num)
        {
            return $this->error('', $sku_info["sku_name"] . "库存不足!");
        }
        //编辑sku库存
        $result = model("goods_sku")->setDec($condition, "stock", $num);
        if ($result === false)
        {
            return $this->error();
        }

        //编辑商品总库存(暂不考虑查询判断)
        $goods_condition = array(
            ["goods_id", "=", $sku_info["goods_id"]]
        );
        $res             = model("goods")->setDec($goods_condition, "goods_stock", $num);
        return $this->success($res);
    }

}