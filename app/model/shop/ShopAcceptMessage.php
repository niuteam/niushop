<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\shop;

use app\model\BaseModel;

/**
 * 商家接受消息设置
 */
class ShopAcceptMessage extends BaseModel
{

    /**
     * 添加商家消息接收会员
     * @param $member_id
     * @param $site_id
     * @return array
     */
    public function addShopAcceptMessage($member_id,$site_id)
    {
        //获取会员信息
        $member_count = model('member')->getCount([['member_id','=',$member_id]]);
        if(empty($member_count)){
            return $this->error('','该会员不存在');
        }

        $count = model('shop_accept_message')->getCount([['member_id','=',$member_id]]);
        if($count > 0){
            return $this->error('','已经添加过该会员');
        }

        $data = [
            'site_id' => $site_id,
            'member_id' => $member_id,
            'create_time' => time()
        ];

        $res = model('shop_accept_message')->add($data);
        return $this->success($res);
    }

    /**
     * 删除商家消息接收会员
     * @param $condition
     * @return array
     */
    public function deleteShopAcceptMessage($condition)
    {
        $res = model('shop_accept_message')->delete($condition);
        return $this->success($res);
    }


    /**
     * 获取商家消息接收会员
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getShopAcceptMessageList($condition = [], $order = '')
    {
        $field = 'sam.*,m.mobile,m.wx_openid,m.nickname,m.headimg,m.username';
        $alias = 'sam';
        $join = [
            [
                'member m',
                'm.member_id = sam.member_id',
                'left'
            ]
        ];
        $list = model('shop_accept_message')->getList($condition, $field, $order, $alias, $join);
        return $this->success($list);
    }


    /**
     * 获取商家消息接收会员分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getShopAcceptMessagePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'id desc')
    {

        $field = 'sam.*,m.mobile,m.wx_openid,m.nickname,m.headimg,m.username';
        $alias = 'sam';
        $join = [
            [
                'member m',
                'm.member_id = sam.member_id',
                'left'
            ]
        ];

        $list = model('shop_accept_message')->pageList($condition, $field, $order, $page, $page_size,$alias,$join);
        return $this->success($list);
    }

}