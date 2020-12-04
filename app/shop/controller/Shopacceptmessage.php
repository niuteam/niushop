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

use app\model\shop\ShopAcceptMessage as ShopAcceptMessageModel;
use app\model\member\Member as MemberModel;

/**
 * 商家接受会员消息管理
 * Class Shopacceptmessage
 * @package app\shop\controller
 */
class Shopacceptmessage extends BaseShop
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
    }

    /**
     * 商家接受会员消息列表
     */
    public function lists()
    {
        if (request()->isAjax()) {

            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);

            $search_text_type = input('search_text_type', 'nickname');
            $search_text = input('search_text', '');

            $condition = [];
            if ($search_text) {
                $condition[] = [ 'm.' . $search_text_type, 'like', '%' . $search_text . '%' ];
            }

            $model = new ShopAcceptMessageModel();
            $list = $model->getShopAcceptMessagePageList($condition, $page, $page_size);

            return $list;
        } else {
            return $this->fetch('shopacceptmessage/lists');
        }
    }

    /**
     * 添加
     */
    public function add()
    {
        if (request()->isAjax()) {

            $model = new ShopAcceptMessageModel();

            $member_id = input('member_id', 0);
            $res = $model->addShopAcceptMessage($member_id, $this->site_id);
            return $res;
        }
    }

    /**
     * 删除
     */
    public function delete()
    {
        if (request()->isAjax()) {

            $model = new ShopAcceptMessageModel();

            $member_id = input('member_id', 0);
            $res = $model->deleteShopAcceptMessage([ [ 'member_id', '=', $member_id ], [ 'site_id', '=', $this->site_id ] ]);
            return $res;
        }

    }

    /**
     *  会员列表
     */
    public function memberList()
    {
        if (request()->isAjax()) {
            $page = input('page', 1);
            $page_size = input('page_size', PAGE_LIST_ROWS);
            $search_text = input('search_text', '');
            $search_text_type = input('search_text_type', 'nickname');//可以传nickname mobile

            $condition[] = [ 'site_id', '=', $this->site_id ];
            //下拉选择
            if ($search_text_type) {
                $condition[] = [ $search_text_type, 'like', "%" . $search_text . "%" ];
            }

            $order = 'reg_time desc';
            $field = 'member_id,headimg,nickname,mobile,wx_openid';

            $member_model = new MemberModel();
            $list = $member_model->getMemberPageList($condition, $page, $page_size, $order, $field);
            return $list;
        } else {
            return $this->fetch('shopacceptmessage/member_list');
        }
    }

}