<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use think\facade\Cache;
use think\Session;
use think\facade\Db;
use app\model\BaseModel;

/**
 * 访问统计
 */
class Visit extends BaseModel
{

    /**
     * 获取访问信息(以日为基本单位)
     * @param $condition
     * @return \multitype
     */
    public function getVisitInfo($condition)
    {
        $site_id = isset($condition["site_id"]) ? $condition["site_id"] : 0;
        $cache   = Cache::get("visit_info_" . $site_id . "_" . $condition["type"] . "_" . $condition["module"] . "_" . $condition["addon"] . "_" . $condition["date"]);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $visit_model = model("nc_visit");//访问统计记录表
        $info        = $visit_model->getInfo($condition);
        Cache::tag("visit_info" . $condition["date"])->set("visit_info_" . $site_id . "_" . $condition["type"] . "_" . $condition["module"] . "_" . $condition["addon"] . "_" . $condition["date"], $info);
        return $this->success($info);
    }

    /**
     * 获取访问ip信息(以日为基本单位)
     * @param $condition
     * @return \multitype
     */
    public function getVisitIpInfo($condition)
    {
        $site_id = isset($condition["site_id"]) ? $condition["site_id"] : 0;
        $cache   = Cache::get("visit_ip_info_" . $site_id . "_" . $condition["type"] . "_" . $condition["module"] . "_" . $condition["addon"] . "_" . $condition["ip"] . "_" . $condition["date"]);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $visit_ip_model = model("nc_visit_ip");//访问统计记录表
        $info           = $visit_ip_model->getInfo($condition);
        Cache::tag("visit_ip_info" . $condition["date"])->set("visit_ip_info_" . $site_id . "_" . $condition["type"] . "_" . $condition["module"] . "_" . $condition["addon"] . "_" . $condition["ip"] . "_" . $condition["date"], $info);
        return $this->success($info);
    }

    /**
     * 获取用户访问记录
     * @param $condition
     * @return \multitype
     */
    public function getVisitUserInfo($condition)
    {

        $site_id = isset($condition["site_id"]) ? $condition["site_id"] : 0;
        $cache   = Cache::get("visit_user_info_" . $site_id . "_" . $condition["uid"] . "_" . $condition["module"] . "_" . $condition["addon"]);
        if (!empty($cache)) {
            return $this->success($cache);
        }
        $visit_user_model = model("nc_visit_user");//用户访问记录表
        $info             = $visit_user_model->getInfo($condition);
        Cache::tag("visit_user_info" . $condition["site_id"])->set("visit_user_info_" . $site_id . "_" . $condition["uid"] . "_" . $condition["module"] . "_" . $condition["addon"], $info);
        return $this->success($info);
    }

    /**
     * 当日的访问数据写入
     * @param array $param
     */
    public function todayVisit($param = [])
    {
        //加入防止写入过多无效访问
        $now_time           = time();
        $today_date         = date("Ymd");
        $expire_time        = 1800;//过期的周期时长
        $visit_session_name = "visit_" . $param["site_id"] . "_" . $param["type"] . "_" . $param["module"] . "_" . $param["addon"] . "_" . $today_date;
        if (!empty(Session::get($visit_session_name)) && (Session::get($visit_session_name) + $expire_time) > $now_time) {
            return $this->success();
        }
        Session::set($visit_session_name, $now_time);//设置访问记录,存入时间
        $yesterday = date("Ymd", strtotime('-1 days'));
        Cache::clear("visit_info" . $yesterday);//清理昨天的缓存
        Cache::clear("visit_ip_info" . $yesterday);//清理昨天的缓存

        $visit_model      = model("nc_visit");//访问统计记录表
        $visit_ip_model   = model("nc_visit_ip");//ip访问记录表
        $visit_user_model = model("nc_visit_user");//用户模块访问记录表
        // 启动事务

        $ip_count = 0;
        //ip访问记录
        $ip                 = ip2long(getip());
        $vivit_ip_condition = array(
            "date"    => $today_date,
            "site_id" => $param["site_id"],
            "type"    => $param["type"],
            "module"  => $param["module"],
            "ip"      => $ip,
            "addon"   => $param["addon"]
        );
        $visit_ip_result    = $this->getVisitIpInfo($vivit_ip_condition);
        $visit_ip_info      = $visit_ip_result["data"];
        $ip_data            = array(
            "date"    => $today_date,
            "site_id" => $param["site_id"],
            "type"    => $param["type"],
            "module"  => $param["module"],
            "ip"      => $ip,
            "addon"   => $param["addon"]
        );
        if (empty($visit_ip_info)) {
            $ip_count            += 1;
            $ip_data["ip_count"] = 1;
            $visit_ip_res        = $visit_ip_model->add($ip_data);
        } else {
            $ip_data["ip_count"] = $visit_ip_info["ip_count"] + 1;
            $visit_ip_res        = $visit_ip_model->update($ip_data, $vivit_ip_condition);
        }
        Cache::tag("visit_ip_info" . $today_date)->set("visit_ip_info_" . $param["site_id"] . "_" . $param["type"] . "_" . $param["module"] . "_" . $param["addon"] . "_" . $ip["ip"] . "_" . $today_date, $ip_data);

        //用户模块访问记录
        if ($param["uid"] > 0) {
            $visit_user_condition = array(
                "uid"     => $param["uid"],
                "site_id" => $param["site_id"],
                "module"  => $param["module"],
                "addon"   => $param["addon"]
            );

            $visit_user_result = $this->getVisitUserInfo($visit_user_condition);
            $visit_user_info   = $visit_user_result["data"];
            $visit_user_data   = array(
                "uid"     => $param["uid"],
                "site_id" => $param["site_id"],
                "module"  => $param["module"],
                "addon"   => $param["addon"]
            );
            if (empty($visit_user_info)) {
                $visit_user_data["create_time"] = time();
                $visit_user_result              = $visit_user_model->add($visit_user_data);
            } else {
                $visit_user_data["update_time"] = time();

                $visit_user_result = $visit_user_model->update($visit_user_data, $visit_user_condition);
            }
            Cache::tag("visit_user_info" . $param["site_id"])->set("visit_user_info_" . $param["site_id"] . "_" . $param["uid"] . "_" . $param["module"] . "_" . $param["addon"], $visit_user_data);
        }

        //访问记录
        $vivit_condition = array(
            "date"    => $today_date,
            "site_id" => $param["site_id"],
            "type"    => $param["type"],
            "module"  => $param["module"],
            "addon"   => $param["addon"]
        );

        $visit_result = $this->getVisitInfo($vivit_condition);
        $visit_info   = $visit_result["data"];
        //如果当前日不存在访问统计数据,则需要创建
        $data = array(
            "date"    => $today_date,
            "site_id" => $param["site_id"],
            "type"    => $param["type"],
            "module"  => $param["module"],
            "addon"   => $param["addon"]
        );
        if (empty($visit_info)) {
            $data["count"]    = 1;
            $data["ip_count"] = $ip_count;
            $res              = $visit_model->add($data);
        } else {
            $data["count"]    = $visit_info["count"] + 1;
            $data["ip_count"] = $visit_info["ip_count"] + $ip_count;
            $res              = $visit_model->update($data, $vivit_condition);
        }
        Cache::tag("visit_info" . $today_date)->set("visit_info_" . $param["site_id"] . "_" . $param["type"] . "_" . $param["module"] . "_" . $param["addon"] . "_" . $today_date, $data);
        return $res;
    }


    /**
     * 查询统计  访问数据
     * @param array $param
     */
    public function getVisitStatisticsData($param = [])
    {
        $visit_model = model("nc_visit");//访问统计记录表
        $date_range  = isset($param["date_range"]) ? $param["date_range"] : [];//时间范围
        $date_type   = $param["date_type"];//日期类型  用于查询方式
        $type        = $param["type"];//访问类型查询
        if (empty($type) && !in_array($type, array('HOME', 'APP', 'API', 'ALL'))) {
            $type = "ALL";
        }
        $condition = array();

        switch ($type) {
            case "HOME":
                $condition["type"] = ["in", ["admin", "sitehome"]];
                break;
            case "APP":
                $condition["type"] = ["in", ["wap", "web"]];
                break;
            case "API":
                $condition["type"] = ["in", ["api"]];
                break;
        }

        //站点id
        if (!empty($param["site_id"])) {
            $condition["site_id"] = $param["site_id"];
        }
        $today_date = date('Ymd');//当前日日期
        $today_time = strtotime($today_date);
        switch ($date_type) {
            case 'today':
                $date_condition = $today_date;
                $date_x         = periodGroup($today_time, $today_time);
                break;
            case 'yesterday':
                $yesterday      = strtotime(date("Ymd", strtotime('-1 days')));
                $date_condition = date('Ymd', $yesterday);
                $date_x         = periodGroup($yesterday, $yesterday);
                break;
            case 'week':
                $week           = strtotime(date("Ymd", strtotime('-6 days')));
                $date_condition = ["between", [date('Ymd', $week), $today_date]];
                $date_x         = periodGroup($week, $today_date);
                break;
            case 'month':
                $month          = strtotime(date("Ymd", strtotime('-29 days')));
                $date_condition = ["between", [date('Ymd', $month), $today_date]];
                $date_x         = periodGroup($month, $today_time);
                break;
            case 'daterange':
                $start_time     = strtotime($date_range['start_date']);
                $end_time       = strtotime($date_range['end_date']);
                $start_date     = date('Ymd', $start_time);//开始日期
                $end_date       = date('Ymd', $end_time);//结束日期
                $date_x         = periodGroup($start_time, $end_time);
                $date_condition = ["between", [$start_date, $end_date]];
                break;
        }


        if (!empty($date_condition)) {
            $condition["date"] = $date_condition;
        }

        $data1 = $visit_model->getList($condition, "*,sum(count) as visit_count", '', '', '', "date");

        $visit_ip_model = model("nc_visit_ip");//访问统计记录表
        $data2          = $visit_ip_model->getList($condition, "*,count( DISTINCT ip ) as visit_ip_count", '', '', '', "date");
        $visit_data     = [];
        $ip_visit_data  = [];
        foreach ($date_x as $k => $v) {
            $visit_count    = 0;
            $visit_ip_count = 0;
            foreach ($data1 as $data1_k => $data1_v) {
                if ($data1_v["date"] == $v) {
                    $visit_count = $data1_v["visit_count"];
                    continue;
                }
            }
            foreach ($data2 as $data2_k => $data2_v) {
                if ($data2_v["date"] == $v) {
                    $visit_ip_count = $data2_v["visit_ip_count"];
                    continue;
                }
            }
            $visit_data[]    = $visit_count;
            $ip_visit_data[] = $visit_ip_count;

        }
        $data = array(
            "date" => $date_x,
            "data" => array(
                "count_data"    => $visit_data,
                "ip_count_data" => $ip_visit_data,
            )
        );
        return $this->success($data);
    }

    /**
     * 统计一段时间内的总访问量
     * @param $param
     * @return \multitype
     */
    public function getVisitCountData($param)
    {
        $visit_model = Db::table("nc_visit");//访问统计记录表
        $date_range  = isset($param["date_range"]) ? $param["date_range"] : [];//时间范围
        $date_type   = $param["date_type"];//日期类型  用于查询方式
        $type        = isset($param["type"]) ? $param["type"] : '';//访问类型查询
        if (empty($type) && !in_array($type, array('HOME', 'APP', 'API', 'ALL'))) {
            $type = "ALL";
        }
        $condition = array();
        if ($type != "ALL") {
            $condition["type"] = $type;
            $visit_model       = $visit_model->where("type", $type);
        }
        //站点id
        if (!empty($param["site_id"])) {
            $condition["site_id"] = $param["site_id"];
            $visit_model          = $visit_model->where("site_id", $param["site_id"]);
        }
        $today_date = date('Ymd');//当前日日期
        switch ($date_type) {
            case 'today':
                $visit_model = $visit_model->where("date", $today_date);
                break;
            case 'yesterday':
                $visit_model = $visit_model->where("date", strtotime('-1 days'));
                break;
            case 'week':
                $visit_model = $visit_model->whereBetween("date", date('Ymd', strtotime('-6 days')), $today_date);
                break;
            case 'month':
                $visit_model = $visit_model->whereBetween("date", date('Ymd', strtotime('-29 days')), $today_date);
                break;
            case 'daterange':
                $start_date  = date('Ymd', strtotime($date_range['start_date']));//开始日期
                $end_date    = date('Ymd', strtotime($date_range['end_date']));//结束日期
                $visit_model = $visit_model->whereBetween("date", $start_date, $end_date);
                break;
        }

        $visit_count     = $visit_model->count();
        $visit_ip_model  = model("nc_visit_ip");//访问统计记录表
        $visit_ip_result = $visit_ip_model->getInfo($condition, "count( DISTINCT ip ) as ip_count");
        $visit_ip_count  = $visit_ip_result["ip_count"];
        $data            = array(
            "visit_count"    => $visit_count,
            "visit_ip_count" => $visit_ip_count
        );
        return $this->success($data);

    }

    public function test()
    {
        $arr = array('HOME', 'APP', 'API');
        for ($i = 0; $i <= 100; $i++) {
            $param["type"]    = $arr[array_rand($arr)];
            $param["site_id"] = rand(11111, 12000);
            $param["module"]  = "";
            $num              = sprintf("%02d", rand(1, 30));
            $today_date       = date("Ym" . $num);
            $visit_model      = model("nc_visit");//访问统计记录表
            $visit_ip_model   = model("nc_visit_ip");//ip访问记录表
            // 启动事务

            $ip_count = 0;
            //ip访问记录

            $ip                 = ip2long($this->get_rand_ip());
            $vivit_ip_condition = array(
                "date"    => $today_date,
                "site_id" => $param["site_id"],
                "type"    => $param["type"],
                "module"  => $param["module"],
                "ip"      => $ip
            );
            $visit_ip_info      = $visit_ip_model->getInfo($vivit_ip_condition);
            if (empty($visit_ip_info)) {
                $ip_count     += 1;
                $ip_data      = array(
                    "date"     => $today_date,
                    "site_id"  => $param["site_id"],
                    "type"     => $param["type"],
                    "module"   => $param["module"],
                    "ip"       => $ip,
                    "ip_count" => 1
                );
                $visit_ip_res = $visit_ip_model->add($ip_data);
            } else {
                $ip_data      = array(
                    "ip_count" => $visit_ip_info["ip_count"] + 1
                );
                $visit_ip_res = $visit_ip_model->update($ip_data, $vivit_ip_condition);
            }

            //访问记录
            $vivit_condition = array(
                "date"    => $today_date,
                "site_id" => $param["site_id"],
                "type"    => $param["type"],
                "module"  => $param["module"]
            );
            $visit_info      = $visit_model->getInfo($vivit_condition);
            //如果当前日不存在访问统计数据,则需要创建
            if (empty($visit_info)) {
                $data = array(
                    "date"     => $today_date,
                    "site_id"  => $param["site_id"],
                    "type"     => $param["type"],
                    "module"   => $param["module"],
                    "count"    => 1,
                    "ip_count" => $ip_count
                );
                $res  = $visit_model->add($data);
            } else {
                $data = array(
                    "count"    => $visit_info["count"] + 1,
                    "ip_count" => $visit_info["ip_count"] + $ip_count
                );
                $visit_model->update($data, $vivit_condition);
            }

        }

    }

    function get_rand_ip()
    {
        $arr_1   = array("218", "218", "66", "66", "218", "218", "60", "60", "202", "204", "66", "66", "66", "59", "61", "60", "222", "221", "66", "59", "60", "60", "66", "218", "218", "62", "63", "64", "66", "66", "122", "211");
        $randarr = mt_rand(0, count($arr_1));
        //        $ip1id = $arr_1[$randarr];
        $ip1id = "218";
        $ip2id = 600000 / 10000;
        $ip3id = 2550000 / 10000;
        $ip4id = 2550000 / 10000 - rand(0, 10);
        return $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
    }

    /**
     * 获取时间段内分组
     */
    public function periodGroup($srart_time, $end_time)
    {
        $type_time = 3600 * 24;
        $format    = 'Ymd';
        $data      = [];
        for ($i = $srart_time; $i <= $end_time; $i += $type_time) {
            $data[] = date($format, $i);
        }
        return $data;
    }

    /**
     * 删除站点
     * @param unknown $site_id
     */
    public function deleteSite($site_id)
    {
        $visit_model      = model("nc_visit");//访问统计记录表
        $visit_ip_model   = model("nc_visit_ip");//ip访问记录表
        $visit_user_model = model("nc_visit_user");//用户模块访问记录表
        $visit_model->delete(['site_id' => $site_id]);
        $visit_ip_model->delete(['site_id' => $site_id]);
        $visit_user_model->delete(['site_id' => $site_id]);
        return $this->success();
    }

}