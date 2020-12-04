<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace addon\wechat\model;

use app\model\BaseModel;
use think\facade\Cache;

/**
 * 数据统计与分析
 */
class Stat extends BaseModel
{

    /**
     * 获取用户增减数据, 最大时间跨度：7
     * @param $begin_date
     * @param $end_date
     * @return array|\multitype
     */
    public function userSummary($begin_date, $end_date)
    {
        $cache = Cache::get("wechat_user_summary_" . "_" . $begin_date . "_" . $end_date);
        if (!empty($cache))
            return $this->success($cache);

        $wechat_model = new Wechat();
        $result       = $wechat_model->userSummary($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("wechat_visit")->set("wechat_user_summary_" . "_" . $begin_date . "_" . $end_date);
        return $result;
    }

    /**
     * 获取累计用户数据, 最大时间跨度：7;
     * @param $begin_date
     * @param $end_date
     * @return array|\multitype
     */
    public function userCumulate($begin_date, $end_date)
    {
        $cache = Cache::get("wechat_user_cumulate_" . "_" . $begin_date . "_" . $end_date);
        if (!empty($cache))
            return $this->success($cache);

        $wechat_model = new Wechat();
        $result       = $wechat_model->userCumulate($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("wechat_visit")->set("wechat_user_cumulate_" . "_" . $begin_date . "_" . $end_date);
        return $result;
    }

    /**
     * 获取接口分析分时数据, 最大时间跨度：1;
     * @param $begin_date
     * @param $end_date
     * @return array|\multitype
     */
    public function interfaceSummaryHourly($begin_date, $end_date)
    {
        $cache = Cache::get("wechat_interface_summary_hourly_" . "_" . $begin_date . "_" . $end_date);
        if (!empty($cache))
            return $this->success($cache);

        $wechat_model = new Wechat();
        $result       = $wechat_model->interfaceSummaryHourly($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("wechat_visit")->set("wechat_interface_summary_hourly_" . "_" . $begin_date . "_" . $end_date);
        return $result;
    }

    /**
     * 获取接口分析数据, 最大时间跨度：30;
     * @param $begin_date
     * @param $end_date
     * @return array|\multitype
     */
    public function interfaceSummary($begin_date, $end_date)
    {
//        $cache = Cache::get("wechat_interface_summary_" . "_" . $begin_date."_" . $end_date);
//        if (!empty($cache))
//            return $this->success($cache);

        $wechat_model = new Wechat();
        $result       = $wechat_model->interfaceSummary($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("wechat_visit")->set("wechat_interface_summary_" . "_" . $begin_date . "_" . $end_date);
        return $result;
    }

    /**
     * 获取微信粉丝统计(以天为单位)
     * @param unknown $param
     */
    public function fans($begin_date, $end_date)
    {
//        $cache = Cache::get("wechat_fans_statistics_"  . "_" . $begin_date."_" . $end_date);
//        if (!empty($cache)) {
//            return $this->success($cache);
//        }
//        $data = [ 'begin_date' => $param['begin_date'], 'end_date' => $param['end_date'] ];
        $user_summary_result = $this->userSummary($begin_date, $end_date);
        if ($user_summary_result["code"] < 0) {
            return $user_summary_result;
        }
        $user_cumulate_result = $this->userCumulate($begin_date, $end_date);
        if ($user_cumulate_result["code"] < 0) {
            return $user_cumulate_result;
        }
        $list = [];
        foreach ($user_cumulate_result["data"] as $cumulate_k => $cumulate_v) {
            $temp_item                  = $cumulate_v;
            $temp_item['cumulate_user'] = empty($cumulate_v['cumulate_user']) ? 0 : $cumulate_v['cumulate_user'];
            $new_user                   = 0;
            $cancel_user                = 0;
            $net_growth_user            = 0;
            foreach ($user_summary_result['data'] as $key => $item) {
                if ($item["ref_date"] == $cumulate_v["ref_date"]) {
                    $new_user        += $item['new_user'];
                    $cancel_user     += $item['cancel_user'];
                    $net_growth_user += $item["new_user"] - $item["cancel_user"];
                }
            }
            $temp_item['new_user']        = $new_user;
            $temp_item['cancel_user']     = $cancel_user;
            $temp_item['net_growth_user'] = $net_growth_user;
            $list[]                       = $temp_item;
        }
        Cache::tag("wechat_visit")->set("wechat_fans_statistics_" . "_" . $begin_date . "_" . $end_date, $list);
        return $this->success($list);
    }

    /**
     * 接口访问数据图
     * @param $date_type
     * @return array
     */
    public function interfaceSummaryStatistics($date_type)
    {
        $date_data              = $this->getDaterange($date_type);
        $is_error               = true;
        $callback_count_data    = [];
        $fail_count_data        = [];
        $average_time_cost_data = [];
        $max_time_cost_data     = [];
        foreach ($date_data["date_list"] as $k => $v) {
            $callback_count    = 0;
            $fail_count        = 0;
            $average_time_cost = 0;
            $max_time_cost     = 0;
            if ($is_error) {
                $temp_data = $this->interfaceSummary($v, $v);
                if (!empty($temp_data["data"])) {
                    $temp_date_item    = $temp_data["data"];
                    $callback_count    = $temp_date_item[0]["callback_count"];
                    $fail_count        = $temp_date_item[0]["fail_count"];
                    $average_time_cost = $temp_date_item[0]["total_time_cost"] / $temp_date_item[0]["callback_count"];
                    $max_time_cost     = $temp_date_item[0]["max_time_cost"];
                } else {
                    $is_error = false;
                }
            }
            $callback_count_data[]    = $callback_count;
            $fail_count_data[]        = $fail_count;
            $average_time_cost_data[] = $average_time_cost;
            $max_time_cost_data[]     = $max_time_cost;
        }
        $return_data = array(
            "date" => $date_data["date_list"],
            "data" => array(
                "callback_count_data"    => $callback_count_data,
                "fail_count_data"        => $fail_count_data,
                "average_time_cost_data" => $average_time_cost_data,
                "max_time_cost_data"     => $max_time_cost_data
            )
        );
        return $this->success($return_data);
    }

    /**
     * 用户访问统计图
     * @param $date_type
     * @return array
     */
    public function userSummaryStatistics($date_type)
    {
        $is_error             = true;
        $date_data            = $this->getDaterange($date_type);
        $new_user_data        = [];
        $cancel_user_data     = [];
        $net_growth_user_data = [];
        $cumulate_user_data   = [];
        foreach ($date_data["date_list"] as $k => $v) {
            $new_user        = 0;
            $cancel_user     = 0;
            $net_growth_user = 0;
            $cumulate_user   = 0;
            if ($is_error) {
                $temp_data = $this->fans($v, $v);
                if (!empty($temp_data["data"])) {
                    $temp_date_item  = $temp_data["data"];
                    $new_user        = $temp_date_item[0]["new_user"];
                    $cancel_user     = $temp_date_item[0]["cancel_user"];
                    $net_growth_user = $temp_date_item[0]["net_growth_user"];
                    $cumulate_user   = $temp_date_item[0]["cumulate_user"];
                } else {
                    $is_error = false;
                }
            }

            $new_user_data[]        = $new_user;
            $cancel_user_data[]     = $cancel_user;
            $net_growth_user_data[] = $net_growth_user;
            $cumulate_user_data[]   = $cumulate_user;
        }
        $return_data = array(
            "date" => $date_data["date_list"],
            "data" => array(
                "new_user_data"        => $new_user_data,
                "cancel_user_data"     => $cancel_user_data,
                "net_growth_user_data" => $net_growth_user_data,
                "cumulate_user_data"   => $cumulate_user_data
            )
        );
        return $this->success($return_data);
    }

    /**
     * 获取时间间隔
     * @param $date_type
     * @return array
     */
    public function getDaterange($date_type)
    {
        $yesterday = strtotime('-1 days');
        switch ($date_type) {
            case 'yesterday':
                $yesterday  = strtotime('-1 days');
                $begin_time = $yesterday;
                $end_time   = $yesterday;
                break;
            case 'week':
                $week       = strtotime('-7 days');
                $begin_time = $week;
                $end_time   = $yesterday;
                break;
            case 'month':
                $month      = strtotime('-30 days');
                $begin_time = $month;
                $end_time   = $yesterday;
                break;
        }
        $date_x     = periodGroup($begin_time, $end_time, "Y-m-d");
        $begin_date = date("Ymd", $begin_time);
        $end_date   = date("Ymd", $end_time);
        $data       = array(
            "begin_date" => $begin_date,
            "end_date"   => $end_date,
            "date_list"  => $date_x,
        );
        return $data;
    }

}