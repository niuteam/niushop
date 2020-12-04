<?php

namespace app\api\controller;

use app\model\goods\Goods as GoodsModel;
use app\model\system\Poster;
use app\model\goods\Config as GoodsConfigModel;
use app\model\web\Config as ConfigModel;

class Goods extends BaseApi
{

    /**
     * 修改商品点击量
     * @return string
     */
    public function modifyclicks()
    {
        $sku_id = isset($this->params[ 'sku_id' ]) ? $this->params[ 'sku_id' ] : 0;

        if (empty($sku_id)) {
            return $this->response($this->error('', 'REQUEST_SKU_ID'));
        }

        $token = $this->checkToken();
        if ($token[ 'code' ] < 0) return $this->response($token);

        $goods_model = new GoodsModel();
        $res = $goods_model->modifyClick($sku_id, $this->site_id);
        return $this->response($res);
    }

    /**
     * 获取商品海报
     */
    public function poster()
    {
        if (!empty($qrcode_param)) return $this->response($this->error('', '缺少必须参数qrcode_param'));

        $promotion_type = 'null';
        $qrcode_param = json_decode($this->params[ 'qrcode_param' ], true);
        $qrcode_param[ 'source_member' ] = $qrcode_param[ 'source_member' ] ?? 0;
        $poster = new Poster();
        $res = $poster->goods($this->params[ 'app_type' ], $this->params[ 'page' ], $qrcode_param, $promotion_type, $this->site_id);
        return $this->response($res);
    }

    /**
     * 售后保障
     * @return false|string
     */
    public function aftersale()
    {
        $goods_config_model = new GoodsConfigModel();
        $res = $goods_config_model->getAfterSaleConfig($this->site_id);
        return $this->response($res);
    }

    /**
     * 获取热门搜索关键词
     */
    public function hotSearchWords()
    {
        $config_model = new ConfigModel();
        $info = $config_model->getHotSearchWords($this->site_id, $this->app_module);
        return $this->response($this->success($info[ 'data' ][ 'value' ]));
    }

    /**
     * 获取默认搜索关键词
     */
    public function defaultSearchWords()
    {
        $config_model = new ConfigModel();
        $info = $config_model->getDefaultSearchWords($this->site_id, $this->app_module);
        return $this->response($this->success($info[ 'data' ][ 'value' ]));
    }
}