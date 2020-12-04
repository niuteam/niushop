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

/**
 * 卡券商品
 * Class Cardgoods
 * @package app\shop\controller
 */
class Cardgoods extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 商品列表
     * @return mixed
     */
    public function lists()
    {
        return $this->fetch("cardgoods/lists");
    }

    /**
     * 添加商品
     * @return mixed
     */
    public function addGoods()
    {
        return $this->fetch("cardgoods/add_goods");
    }

    /**
     * 编辑商品
     * @return mixed
     */
    public function editGoods()
    {
        return $this->fetch("cardgoods/edit_goods");
    }

}