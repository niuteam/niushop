<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\member;

use app\model\BaseModel;
use think\facade\Db;
use addon\coupon\model\Coupon;
use app\model\system\Cron;

/**
 * 会员群体
 */
class MemberCluster extends BaseModel
{
    public $basic = [
        'member_level' => '会员等级',
        'member_label' => '会员标签',
        'sex' => '性别',
        'birthday' => '生日',
        'reg_time' => '注册时间',
        'point' => '当前积分',
        'balance' => '当前余额',
        'growth' => '当前成长值',
        'sign_days_series' => '连续签到次数',
        'mobile' => '会员手机',
    ];

    public $consume = [
        'order_money' => '付款金额',
        'order_complete_money' => '消费金额',
        'order_num' => '付款次数',
        'order_complete_num' => '消费次数',
        'recharge_total' => '累计充值',
        'recharge_time' => '充值次数',
    ];

    public $promotion = [
        'coupon_num' => '优惠券数',
    ];

    /**
     * 查询规则
     */
    public $rule = [
        'member_level' => ['field' => "member_level",'query_method' => "=", "table" => "member"],
        'member_label' => ['field' => "member_label",'query_method' => "FIND_IN_SET", "table" => "member"],
        'sex' => ['field' => "sex",'query_method' => "in", "table" => "member"],
        'birthday' => ['field' => "birthday",'query_method' => "between time", "table" => "member"],
        'reg_time' => ['field' => "reg_time",'query_method' => "between time", "table" => "member"],
        'point' => ['field' => "point",'query_method' => "between", "table" => "member"],
        'balance' => ['field' => "balance",'query_method' => "between", "table" => "member"],
        'growth' => ['field' => "growth",'query_method' => "between", "table" => "member"],
        'sign_days_series' => ['field' => "sign_days_series",'query_method' => "between", "table" => "member"],
        'mobile' => ['field' => "mobile",'query_method' => "like", "table" => "member"],
        'order_money' => ['field' => "order_money",'query_method' => "between", "table" => "member"],
        'order_complete_money' => ['field' => "order_complete_money",'query_method' => "between", "table" => "member"],
        'order_num' => ['field' => "order_num",'query_method' => "between", "table" => "member"],
        'order_complete_num' => ['field' => "order_complete_num",'query_method' => "between", "table" => "member"],
        'recharge_total' => ['field' => "recharge_total",'query_method' => "between", "table" => "member_recharge_order"],
        'recharge_time' => ['field' => "recharge_time",'query_method' => "between", "table" => "member_recharge_order"],
        'coupon_num' => ['field' => "coupon_num",'query_method' => "between", "table" => "promotion_coupon"]
    ];

    /**
     * 添加会员群体
     * @param $data
     * @return array
     */
    public function addMemberCluster($data)
    {
        //重新计算符合会员群体的会员
        $calculate_data = $this->calculate($data);

        $data['member_num'] = $calculate_data['data']['member_num'];
        $data['member_ids'] = $calculate_data['data']['member_ids'];

        $res = model('member_cluster')->add($data);
        return $this->success($res);
    }

    /**
     * 编辑会员群体
     * @param $data
     * @param $condition
     * @return array
     */
    public function editMemberCluster($data, $condition)
    {
        //重新计算符合会员群体的会员
        $calculate_data = $this->calculate($data);

        $data['member_num'] = $calculate_data['data']['member_num'];
        $data['member_ids'] = $calculate_data['data']['member_ids'];

        $res = model('member_cluster')->update($data, $condition);
        return $this->success($res);
    }

    /**
     * 删除会员群体
     * @param $condition
     * @return array
     */
    public function deleteMemberCluster($condition)
    {
        $res = model('member_cluster')->delete($condition);
        return $this->success($res);
    }

    /**
     * 会员群体信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getMemberClusterInfo($condition = [], $field = '*')
    {
        $info = model('member_cluster')->getInfo($condition, $field);
        return $this->success($info);
    }

    /**
     * 会员群体详情
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getMemberClusterDetail($condition = [], $field = '*')
    {
        $info = model('member_cluster')->getInfo($condition, $field);
        $info['rule_arr'] = json_decode($info['rule_json'],true);

        //获取标签
        $member_label_content = $info['rule_arr']['basic']['member_label']['content'];
        $info['rule_arr']['basic']['member_label']['content_name'] = '';
        if(!empty($member_label_content)){
            $member_label_list = model('member_label')->getColumn([ ["label_id", "in", $member_label_content] ],'label_name');
            $info['rule_arr']['basic']['member_label']['content_name'] = implode(",",$member_label_list);
        }
        //获取等级
        $member_level_content = $info['rule_arr']['basic']['member_level']['content'];
        $info['rule_arr']['basic']['member_level']['content_name'] = '';
        if(!empty($member_level_content)) {
            $member_level_list = model('member_level')->getColumn([ ["level_id", "in", $member_level_content] ],'level_name');
            $info['rule_arr']['basic']['member_level']['content_name'] = implode(",", $member_level_list);
        }

        //获取性别
        $member_sex_content = $info['rule_arr']['basic']['sex']['content'];
        $info['rule_arr']['basic']['sex']['content_arr'] = [];
        if(!empty($member_sex_content)) {
            $info['rule_arr']['basic']['sex']['content_arr'] = explode(",", $member_sex_content);
        }
        return $this->success($info);
    }

    /**
     * 会员群体列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getMemberClusterList($condition = [], $field = '*', $order = 'cluster_id asc', $limit = null)
    {
        $list = model('member_cluster')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 会员群体分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getMemberClusterPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = 'cluster_id asc', $field = '*')
    {
        $list = model('member_cluster')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 计算人数
     * @param $data
     * @return array
     */
    public function calculate($data)
    {
        //根据规则获得条件
        $condition = $this->handleRule($data['rule_json']);

        $condition[] = ["site_id",'=',$data['site_id']];
        //只查询正常用户
        $condition[] = ['is_delete', '=', 0];

        $member_arr = model('member')->getColumn($condition,'member_id');
        $member_ids = implode(',',$member_arr);
        $member_num = model('member')->getCount($condition);

        return $this->success(["member_num" => $member_num, "member_ids" => $member_ids]);

    }

    /**
     * 处理规则条件
     * @param $rule_json
     * @return array
     */
    public function handleRule($rule_json)
    {
        $rule_arr = json_decode($rule_json,true);

        $all_field = array_merge($this->basic,$this->consume,$this->promotion);

        $condition = [];
        foreach ($rule_arr as $key => $value){
            //获取键
            $keys = array_keys($value);
            foreach ($keys as $key) {

                if (array_key_exists($key, $all_field)) {
                    $values = $value[$key];
                    $query_method = $this->rule[$key]['query_method'];
                    $start = isset($values['start']) ? $values['start'] : '';
                    $end = isset($values['end']) ? $values['end'] : '';
                    $content = isset($values['content']) ? $values['content'] : '';
                    $include = $values['include'] == 2 ? "not " : "";
                    $is_show = $values['is_show'];
                    if($is_show == 1){
                        switch ($query_method) {
                            case "between":
                                $condition[] = [$key, $include.'between', [$start,$end]];
                                break;
                            case "between time":
                                if($values['include'] == 1){
                                    //注册时间
                                    if ($start != '' && $end != '') {
                                        $condition[] = [ $key, 'between', [ strtotime($start), strtotime($end) ] ];
                                    } else if ($start != '' && $end == '') {
                                        $condition[] = [ $key, '>=', strtotime($start) ];
                                    } else if ($start == '' && $end != '') {
                                        $condition[] = [ $key, '<=', strtotime($end) ];
                                    }
                                }else if($values['include'] == 2){
                                    //注册时间
                                    if ($start != '' && $end != '') {
                                        $condition[] = [ $key, $include.'between', [ strtotime($start), strtotime($end) ] ];
                                    } else if ($start != '' && $end == '') {
                                        $condition[] = [ $key, '<', strtotime($start) ];
                                    } else if ($start == '' && $end != '') {
                                        $condition[] = [ $key, '>', strtotime($end) ];
                                    }
                                }
                                break;
                            case "in":
                                $condition[] = [$key, $include.'in', $content];
                                break;
                            case "like":
                                $condition[] = [$key, $include.'like', "%" . $content . "%"];
                                break;
                            case "FIND_IN_SET":
                                //使用like搜索 暂不使用find_in_set 不可用包含不包含
//                                $content_arr = explode(",",$content);
//                                $temp_sql = '';
//                                foreach ($content_arr as $content_value){
//                                    if(empty($temp_sql)){
//                                        $temp_sql .= "FIND_IN_SET({$content_value}, member_label)";
//                                    }else{
//                                        $temp_sql .= " or FIND_IN_SET({$content_value}, member_label)";
//                                    }
//                                }
//                                $condition[] = [ "", 'exp', Db::raw($temp_sql) ];
                                $content_arr = explode(",",$content);
                                if($values['include'] == 1){
                                    $find_in_set = "or";
                                    $find_in_set_method = "like";
                                }else if($values['include'] == 2){
                                    $find_in_set = "and";
                                    $find_in_set_method = "not like";
                                }
                                $temp_arr = [];
                                foreach ($content_arr as $content_value){
                                    $content_condition = [ $content_value, '%' . $content_value . ',%', '%' . $content_value, '%,' . $content_value . ',%' ];
                                    $temp_arr = array_merge($content_condition,$temp_arr);
                                }
                                $condition[] = [ $key, $find_in_set_method, $temp_arr, $find_in_set ];
                                break;
                            case 4://其他表数据

                                break;
                        }
                    }
                }
            }
        }
        return $condition;
    }


    /**
     * 自动定时刷新数据
     * @return array
     */
    public function refreshMemberCluster()
    {
        $list = model('member_cluster')->getList([],'rule_json,site_id,cluster_id');
        //循环刷新事件
        foreach ($list as $value){
            $calculate_data = $this->calculate($value)['data'];
            model("member_cluster")->update(["member_num" => $calculate_data['member_num'], "member_ids" => $calculate_data['member_ids'], "update_time" => time()],["cluster_id" => $value['cluster_id']]);
        }

        return $this->success();

    }

    /**
     * 发放积分
     * @param $point
     * @param $cluster_id
     * @param $remark
     * @return array
     */
    public function sendPoint($point, $cluster_id, $remark)
    {
        $member_cluster_info = model("member_cluster")->getInfo(["cluster_id" => $cluster_id],"member_ids");

        $member_list = model("member")->getList([ ["member_id", "in", $member_cluster_info["member_ids"]] ],'site_id,member_id');
        $member_account_model = new MemberAccount();
        model('member_account')->startTrans();
        try {
            foreach ($member_list as $value){
                $member_account_model->addMemberAccount($value[ 'site_id' ], $value['member_id'], 'point', $point, 'adjust', '会员群体发放积分' . $point, $remark);
            }
            model('member_account')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('member_account')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 发放余额
     * @param $balance
     * @param $cluster_id
     * @param $remark
     * @return array
     */
    public function sendBalance($balance, $cluster_id, $remark)
    {
        $member_cluster_info = model("member_cluster")->getInfo(["cluster_id" => $cluster_id],"member_ids");

        $member_list = model("member")->getList([ ["member_id", "in", $member_cluster_info["member_ids"]] ],'site_id,member_id');
        $member_account_model = new MemberAccount();
        model('member_account')->startTrans();
        try {
            foreach ($member_list as $value){
                $member_account_model->addMemberAccount($value[ 'site_id' ], $value['member_id'], 'balance', $balance, 'adjust', '会员群体发放红包' . $balance,  $remark);
            }
            model('member_account')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('member_account')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 发放优惠券
     * @param $coupon
     * @param $cluster_id
     * @return array
     */
    public function sendCoupon($coupon, $cluster_id)
    {
        $member_cluster_info = model("member_cluster")->getInfo(["cluster_id" => $cluster_id],"member_ids");

        $member_list = model("member")->getList([ ["member_id", "in", $member_cluster_info["member_ids"]] ],'site_id,member_id');
        model('promotion_coupon')->startTrans();
        try {
            foreach ($member_list as $value){
                $coupon_model = new Coupon();
                $coupon_array = explode(',', $coupon);
                foreach ($coupon_array as $k => $v) {
                    $coupon_model->receiveCoupon($v, $value[ 'site_id' ], $value['member_id'], 3);
                }
            }
            model('promotion_coupon')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_coupon')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 店铺初始化的时候添加定时任务
     */
    public function addMemberClusterCronRefresh()
    {
        //添加会员群体刷新时间
        $cron_model = new Cron();
        $execute_time = time() + 60;
        $res = $cron_model->addCron(2, 1, "会员群体定时刷新", "CronMemberClusterRefresh", $execute_time, 0);
        return $this->success($res);
    }

}