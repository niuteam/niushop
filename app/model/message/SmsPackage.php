<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 */

namespace app\model\message;

use app\model\BaseModel;

/**
 * 短信管理类
 */
class SmsPackage extends BaseModel
{
    /**
     * 添加短信套餐
     * @param $data
     */
    public function addSmsPackage($data)
    {
        $res = model('sys_sms_package')->add($data);
        if ($res === false) {
            return $this->error();
        }
        return $this->success();
    }

    /**
     * 编辑短信套餐
     * @param $data
     * @param $condition
     */
    public function editSmsPackage($data, $condition)
    {
        $res = model('sys_sms_package')->update($data, $condition);
        if ($res === false) {
            return $this->error();
        }
        return $this->success();
    }

    /**
     * 删除短信套餐
     * @param $condition
     */
    public function deleteSmsPackage($condition)
    {
        $res = model('sys_sms_package')->delete($condition);
        if ($res === false) {
            return $this->error();
        }
        return $this->success();
    }


    /**
     * 短信套餐详情
     * @param $condition
     * @param string $field
     * @return \multitype
     */
    public function getSmsPackageInfo($condition, $field = "*")
    {
        $info = model("sys_sms_package")->getInfo($condition, $field);
        return $this->success($info);
    }


    /**
     * 短信套餐列表
     * @param array $condition
     * @param bool $field
     * @param string $order
     * @param null $limit
     */
    public function getSmsPackageList($condition = [], $field = true, $order = '', $limit = null)
    {
        $list = model('sys_sms_package')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 短信套餐分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return \multitype
     */
    public function getSmsPackagePageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('sys_sms_package')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }


    /**************************************************************************** 有关订单 start ****************************************************************************/

    /**
     * 短信充值订单
     * @param $order_info
     */
    public function orderPay($order_info)
    {
        $sms_num = 0;
        if ($order_info["sms_package_id"] > 0 && $order_info['sms_num'] > 0) {
            $sms_num = $order_info['sms_package_num'] * $order_info['sms_num'];
        }
        //判断有无套餐免费短信
        if ($order_info['group_sms_num'] > 0) {
            $sms_num = $order_info['group_sms_num'];
        }
        //将要赠送的短信数
        if ($sms_num > 0) {
            $result = $this->smsInc($order_info['site_id'], $sms_num);
            return $result;
        }
        return $this->success();
    }

    /**************************************************************************** 有关订单 end ****************************************************************************/


    /**
     * @param $site_id
     * @return array
     */
    public function getSiteSmsNum($site_id)
    {
        $result = model('site')->getInfo([['site_id', '=', $site_id]], 'sms_num');
        return $this->success($result['sms_num'] ?? 0);
    }

    /**
     * 增加短信
     * @param $sys_uid
     * @param $num
     * @return array
     */
    public function smsInc($site_id, $num)
    {
        //增加用户的短信数
        $result = model('site')->setInc([['site_id', '=', $site_id]], 'sms_num', $num);//增加短信数
        if ($result === false)
            return $this->error();

        return $this->success();
    }

    /**
     * 扣除用户的短信条数
     */
    public function smsDec($site_id, $num = 1)
    {
        //扣除用户的短信数
        $result = model('site')->setDec([['site_id', '=', $site_id]], 'sms_num', $num);//减少短信数
        $result = model('site')->setInc([['site_id', '=', $site_id]], 'sms_used_num', $num);//增加已使用短信数
        if ($result === false)
            return $this->error();

        return $this->success();
    }
}