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

namespace addon\weapp\model;

use app\model\BaseModel;
use think\facade\Cache;

/**
 * 微信小程序数据统计与分析
 */
class Stat extends BaseModel
{

    /**
     * 小程序 访问日趋势
     * @param $from
     * @param $to
     */
    public function dailyVisitTrend($begin_date, $end_date)
    {
        $info = Cache::get("weapp_daily_visit_trend" . "_" . $begin_date . "_" . $end_date);
        if (!empty($info)) {
            return success($info);
        }
        $wepp_model = new Weapp();
        $result     = $wepp_model->dailyVisitTrend($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("weapp_visit")->set("weapp_daily_visit_trend" . "_" . $begin_date . "_" . $end_date, $result["data"]);
        return $result;
    }

    /**
     * 小程序 访问周趋势
     * @param $from
     * @param $to
     */
    public function weeklyVisitTrend($begin_date, $end_date)
    {
        $info = Cache::get("weapp_weekly_visit_trend" . "_" . $begin_date . "_" . $end_date);
        if (!empty($info)) {
            return success($info);
        }
        $wepp_model = new Weapp();
        $result     = $wepp_model->weeklyVisitTrend($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("weapp_visit")->set("weapp_weekly_visit_trend" . "_" . $begin_date . "_" . $end_date, $result["data"]);
        return $result;
    }

    /**
     * 小程序 访问月趋势
     * @param $from
     * @param $to
     */
    public function monthlyVisitTrend($begin_date, $end_date)
    {
        $info = Cache::get("weapp_monthly_visit_trend" . "_" . $begin_date . "_" . $end_date);
        if (!empty($info)) {
            return success($info);
        }
        $wepp_model = new Weapp();
        $result     = $wepp_model->monthlyVisitTrend($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("weapp_visit")->set("weapp_monthly_visit_trend" . "_" . $begin_date . "_" . $end_date, $result["data"]);
        return $result;
    }

    /**
     * 小程序 访问日趋势
     * @param $from
     * @param $to
     */
    public function visitPage($begin_date, $end_date)
    {
        $info = Cache::get("weapp_visit_page" . "_" . $begin_date . "_" . $end_date);
        if (!empty($info)) {
            return success($info);
        }
        $wepp_model = new Weapp();
        $result     = $wepp_model->dailyVisitTrend($begin_date, $end_date);
        if ($result["code"] < 0)
            return $result;

        Cache::tag("weapp_visit")->set("weapp_visit_page" . "_" . $begin_date . "_" . $end_date, $result["data"]);
        return $result;
    }

    /**
     * 查询微信小程序访问数据
     * @param $date_type
     * @param $daterange
     */
    public function visitData($date_type)
    {
        $result = [];

        switch ($date_type) {
            case 'yesterday':
                $begin_date = date('Ymd', strtotime('-1 days'));
                $end_date   = date('Ymd', strtotime('-1 days'));
                $result     = $this->dailyVisitTrend($begin_date, $end_date);
                break;
            case 'month':
                $begin_date = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 month'));
                $end_date   = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 day'));
                $result     = $this->monthlyVisitTrend($begin_date, $end_date);
                break;
        }

        return $result;
    }

    /**
     * 获取微信小程序  数据分析统计
     */
    public function visitStatistics($daterange)
    {
        if (empty($daterange))
            return $this->success([]);

        $is_error               = true;
        $daterange_array        = explode(" 至 ", $daterange);
        $start_date             = date_format(date_create($daterange_array[0]), "Ymd");
        $end_date               = date_format(date_create($daterange_array[1]), "Ymd");
        $date_x                 = periodGroup(strtotime($start_date), strtotime($end_date));
        $session_cnt_data       = [];//打开次数
        $visit_pv_data          = [];//访问次数
        $visit_uv_data          = [];//访问人数
        $visit_uv_new_data      = [];//新用户数
        $stay_time_uv_data      = [];//人均停留时长 (浮点型，单位：秒)
        $stay_time_session_data = [];//次均停留时长 (浮点型，单位：秒)
        $visit_depth_data       = [];//平均访问深度 (浮点型)
        foreach ($date_x as $k => $v) {
            $session_cnt       = 0;//打开次数
            $visit_pv          = 0;//访问次数
            $visit_uv          = 0;//访问人数
            $visit_uv_new      = 0;//新用户数
            $stay_time_uv      = 0;//人均停留时长 (浮点型，单位：秒)
            $stay_time_session = 0;//次均停留时长 (浮点型，单位：秒)
            $visit_depth       = 0;//平均访问深度 (浮点型)
            if ($is_error) {
//                $temp_daterange = array(
//                    "begin_date" => $v,
//                    "end_date" => $v,
//                    "site_id" => $site_id
//                );
                $result    = $this->dailyVisitTrend($v, $v);
                $temp_data = $result["data"];
                if (!empty($temp_data)) {
                    $session_cnt       = $temp_data["session_cnt"];//打开次数
                    $visit_pv          = $temp_data["visit_pv"];//访问次数
                    $visit_uv          = $temp_data["visit_uv"];//访问人数
                    $visit_uv_new      = $temp_data["visit_uv_new"];//新用户数
                    $stay_time_uv      = $temp_data["stay_time_uv"];//人均停留时长 (浮点型，单位：秒)
                    $stay_time_session = $temp_data["stay_time_session"];//次均停留时长 (浮点型，单位：秒)
                    $visit_depth       = $temp_data["visit_depth"];//平均访问深度 (浮点型)
                } else {
                    $is_error = false;
                }
            }

            $session_cnt_data[]       = $session_cnt;//打开次数
            $visit_pv_data[]          = $visit_pv;//访问次数
            $visit_uv_data[]          = $visit_uv;//访问人数
            $visit_uv_new_data[]      = $visit_uv_new;//新用户数
            $stay_time_uv_data[]      = $stay_time_uv;//人均停留时长 (浮点型，单位：秒)
            $stay_time_session_data[] = $stay_time_session;//次均停留时长 (浮点型，单位：秒)
            $visit_depth_data[]       = $visit_depth;//平均访问深度 (浮点型)
        }

        $statistics_data = array(
            "date" => $date_x,
            "data" => array(
                "session_cnt_data"       => $session_cnt_data,
                "visit_pv_data"          => $visit_pv_data,
                "visit_uv_data"          => $visit_uv_data,
                "visit_uv_new_data"      => $visit_uv_new_data,
                "stay_time_uv_data"      => $stay_time_uv_data,
                "stay_time_session_data" => $stay_time_session_data,
                "visit_depth_data"       => $visit_depth_data,
            )
        );
        return $this->success($statistics_data);
    }
}