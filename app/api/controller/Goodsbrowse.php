<?php

namespace app\api\controller;

use app\model\goods\GoodsBrowse as GoodsBrowseModel;
use app\model\goods\Goods as GoodsModel;

/**
 * 商品浏览历史
 * @package app\api\controller
 */
class Goodsbrowse extends BaseApi
{
    /**
     * 添加信息
     */
    public function add()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $goods_id = isset($this->params['goods_id']) ? $this->params['goods_id'] : 0;
        $sku_id   = isset($this->params['sku_id']) ? $this->params['sku_id'] : 0;

        if (empty($goods_id)) {
            return $this->response($this->error('', 'REQUEST_GOODS_ID'));
        }

        if (empty($sku_id)) {
            return $this->response($this->error('', 'REQUEST_SKU_ID'));
        }
        $goods_browse_model = new GoodsBrowseModel();
        $data               = [
            'member_id' => $token['data']['member_id'],
            'goods_id'  => $goods_id,
            'sku_id'    => $sku_id,
            'site_id'   => $this->site_id,
        ];
        $res                = $goods_browse_model->addBrowse($data);
        return $this->response($res);

    }

    /**
     * 删除信息
     */
    public function delete()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $id = isset($this->params['id']) ? $this->params['id'] : '';
        if (empty($id)) {
            return $this->response($this->error('', 'REQUEST_ID'));
        }
        $goods_browse_model = new GoodsBrowseModel();
        $res                = $goods_browse_model->deleteBrowse($id, $token['data']['member_id']);
        return $this->response($res);
    }

    /**
     * 分页列表
     */
    public function page()
    {
        $token = $this->checkToken();
        if ($token['code'] < 0) return $this->response($token);

        $page               = isset($this->params['page']) ? $this->params['page'] : 1;
        $page_size          = isset($this->params['page_size']) ? $this->params['page_size'] : PAGE_LIST_ROWS;
        $goods_browse_model = new GoodsBrowseModel();
        $condition          = [
            ['ngb.member_id', '=', $token['data']['member_id']]
        ];

        $alias = 'ngb';
        $field = 'ngb.id,ngb.member_id,ngb.browse_time,ngb.sku_id,ngs.sku_image,ngs.discount_price,ngs.sku_name,ng.goods_id,ng.goods_name,ng.goods_image,(ngs.sale_num + ngs.virtual_sale) as sale_num,ngs.is_free_shipping,ngs.promotion_type,ngs.member_price,ngs.price,ngs.market_price,ngs.is_virtual,ng.goods_image,ngs.unit';
        $join  = [
            [
                'goods ng',
                'ngb.goods_id = ng.goods_id',
                'inner'
            ],
            [
                'goods_sku ngs',
                'ngb.sku_id = ngs.sku_id',
                'inner'
            ]
        ];

        $list = $goods_browse_model->getBrowsePageList($condition, $page, $page_size, 'ngb.browse_time desc', $field, $alias, $join);

        $goods = new GoodsModel();
        $token = $this->checkToken();
        if (!empty($list['data']['list'])) {
            foreach ($list['data']['list'] as $k => $v) {

                if ($token['code'] >= 0) {
                    // 是否参与会员等级折扣
                    $goods_member_price = $goods->getGoodsPrice($v['sku_id'], $this->member_id);
                    $goods_member_price = $goods_member_price['data'];
                    if (!empty($goods_member_price['member_price'])) {
                        $list['data']['list'][$k]['member_price'] = $goods_member_price['price'];
                    }
                }
            }
        }
        return $this->response($list);
    }

}