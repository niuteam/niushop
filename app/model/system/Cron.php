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

use app\model\BaseModel;

/**
 * 计划任务管理
 * @author Administrator
 *
 */
class Cron extends BaseModel
{

    /**
     * 添加计划任务
     * @param unknown $type 任务类型  1.固定任务 2.循环任务
     * @param unknown $period 执行周期
     * @param unknown $name 任务名称
     * @param unknown $event 执行事件
     * @param unknown $execute_time 待执行时间
     * @param unknown $relate_id 关联id
     * @param unknown $period_type 周期类型
     */
    public function addCron($type = 1, $period = 0, $name, $event, $execute_time, $relate_id, $period_type = 0)
    {
        $data = [
            'type'         => $type,
            'period'       => $period,
            'period_type'  => $period_type,
            'name'         => $name,
            'event'        => $event,
            'execute_time' => $execute_time,
            'relate_id'    => $relate_id,
            'create_time'  => time()
        ];
        $res  = model("cron")->add($data);
        return $this->success($res);
    }

    /**
     * 删除计划任务
     * @param unknown $condition
     */
    public function deleteCron($condition)
    {
        $res = model("cron")->delete($condition);
        return $this->success($res);
    }

    /**
     * 执行任务
     */
    public function execute()
    {
        $list = model("cron")->getList([['execute_time', '<=', time()]]);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                try {
                    $res = event($v['event'], ['relate_id' => $v['relate_id']]);
                } catch (\Exception $e) {
                    $res = $this->error($e->getMessage());
                }

                $data_log = [
                    'name'         => $v['name'],
                    'event'        => $v['event'],
                    'execute_time' => time(),
                    'relate_id'    => $v['relate_id'],
                    'message'      => json_encode($res)
                ];
                //model("cron_log")->add($data_log);
                //循环任务
                if ($v['type'] == 2) {
                    $period = $v['period'] == 0 ? 1 : $v['period'];
                    switch ($v['period_type']) {
                        case 0://分

                            $execute_time = $v['execute_time'] + $period * 60;
                            break;
                        case 1://天

                            $execute_time = strtotime("+" . $period . "day", $v['execute_time']);
                            break;
                        case 2://周

                            $execute_time = strtotime("+" . $period . "week", $v['execute_time']);
                            break;
                        case 3://月

                            $execute_time = strtotime("+" . $period . "month", $v['execute_time']);
                            break;
                    }
                    model("cron")->update(['execute_time' => $execute_time], [['id', '=', $v['id']]]);

                } else {
                    model("cron")->delete([['id', '=', $v['id']]]);
                }
            }
        }

    }

}