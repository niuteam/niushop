<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\manjian\model;

use app\model\system\Cron;
use app\model\BaseModel;
use think\facade\Cache;
use think\facade\Db;

/**
 * 满减
 */
class Manjian extends BaseModel
{
    //满减送状态
    private $manjian_status = [
        0  => '未开始',
        1  => '进行中',
        2  => '已结束',
        -1 => '已关闭',
    ];

    public function getManjianStatus()
    {
        return $this->manjian_status;
    }

    /**
     * 添加满减
     * @param unknown $data
     */
    public function addManjian($data)
    {
        //时间检测
        if ($data['end_time'] < time()) {
            return $this->error('', '结束时间不能早于当前时间');
        }

        if ($data['manjian_type'] == 1) {
            $manjian_activity_info = model('promotion_manjian')->getInfo([
                ['status', 'in', "0,1"],
                ['site_id', '=', $data['site_id']],
                ['manjian_type', '=', 1],
                ['', 'exp', Db::raw('not ( (`start_time` > ' . $data['end_time'] . ' and `start_time` > ' . $data['start_time'] . ' )  or (`end_time` < ' . $data['start_time'] . ' and `end_time` < ' . $data['end_time'] . '))')]
            ], 'manjian_name,start_time,end_time');
            if (!empty($manjian_activity_info)) {
                $key = 'manjian' . random_keys(8) . $data['site_id'];
                Cache::set($key, ['list' => [$manjian_activity_info], 'type' => 'activity', 'promotion' => '满减送', 'start_time' => $data['start_time'], 'end_time' => $data['end_time']], 3600);
                return $this->error(['key' => $key], 'GOODS_EXIST_MANJIAN');
            }
        }

        $join = [
            ['promotion_manjian pm', 'pm.manjian_id = pmg.manjian_id', 'left'],
            ['goods g', 'g.goods_id = pmg.goods_id', 'left']
        ];

        // 查询存在交集的满减活动商品
        $condition_bing = [
            ['pmg.status', 'in', "0,1"],
            ['pmg.site_id', '=', $data['site_id']],
            ['', 'exp', Db::raw('not ( (pmg.start_time > ' . $data['end_time'] . ' and pmg.start_time > ' . $data['start_time'] . ' )  or (pmg.end_time < ' . $data['start_time'] . ' and pmg.end_time < ' . $data['end_time'] . '))')]
        ];
        if ($data['manjian_type'] != 1) $condition_bing[] = ['pmg.goods_id', 'in', $data['goods_ids']];
        $manjian_count = model('promotion_manjian_goods')->getList($condition_bing, 'pmg.start_time,pmg.end_time,pm.manjian_name,g.goods_name', '', 'pmg', $join);
        if (!empty($manjian_count)) {
            $key = 'manjian' . random_keys(8) . $data['site_id'];
            Cache::set($key, ['list' => $manjian_count, 'type' => 'goods', 'promotion' => '满减送', 'start_time' => $data['start_time'], 'end_time' => $data['end_time']], 3600);
            return $this->error(['key' => $key], 'GOODS_EXIST_MANJIAN');
        }

        $data['create_time'] = time();
        if ($data['start_time'] <= time()) {
            $data['status'] = 1;//直接启动
        } else {
            $data['status'] = 0;
        }
        model('promotion_manjian')->startTrans();
        try {

            $manjian_id = model('promotion_manjian')->add($data);
            if ($data['manjian_type'] == 1) {//全部商品参与

                //获取商品id
                $goods_ids = model('goods')->getColumn([['site_id', '=', $data['site_id']], ['goods_state', '=', 1]], 'goods_id');
                if (!empty($goods_ids)) {
                    foreach ($goods_ids as $v) {
                        $goods_data = [
                            'manjian_id'   => $manjian_id,
                            'site_id'      => $data['site_id'],
                            'goods_id'     => $v,
                            'manjian_type' => $data['manjian_type'],
                            'status'       => $data['status'],
                            'rule_json'    => $data['rule_json'],
                            'start_time'   => $data['start_time'],
                            'end_time'     => $data['end_time']
                        ];
                        model('promotion_manjian_goods')->add($goods_data);
                    }
                } else {
                    model('promotion_manjian')->rollback();
                    return $this->error('', '请先添加商品');
                }

            } else {
                $goods_ids = explode(',', $data['goods_ids']);

                foreach ($goods_ids as $v) {
                    $goods_data = [
                        'manjian_id'   => $manjian_id,
                        'site_id'      => $data['site_id'],
                        'goods_id'     => $v,
                        'manjian_type' => $data['manjian_type'],
                        'status'       => $data['status'],
                        'rule_json'    => $data['rule_json'],
                        'start_time'   => $data['start_time'],
                        'end_time'     => $data['end_time']
                    ];
                    model('promotion_manjian_goods')->add($goods_data);
                }
            }

            $cron = new Cron();
            if ($data['start_time'] <= time()) {
                $cron->addCron(1, 0, "满减关闭", "CloseManjian", $data['end_time'], $manjian_id);
            } else {
                $cron->addCron(1, 0, "满减开启", "OpenManjian", $data['start_time'], $manjian_id);
                $cron->addCron(1, 0, "满减关闭", "CloseManjian", $data['end_time'], $manjian_id);
            }

            model('promotion_manjian')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_manjian')->rollback();
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 修改满减
     * @param unknown $data
     * @return multitype:string
     */
    public function editManjian($data)
    {
        $manjian_id = $data['manjian_id'];
        unset($data['manjian_id']);
        $manjian_status = model('promotion_manjian')->getInfo([['site_id', '=', $data['site_id']], ['manjian_id', '=', $manjian_id]], 'status');
        if ($manjian_status['status'] != 0) {
            return $this->error('', '只有未开始的满减活动才能进行修改');
        }
        //时间检测
        if ($data['end_time'] < time()) {
            return $this->error('', '结束时间不能早于当前时间');
        }

        if ($data['manjian_type'] == 1) {
            $manjian_activity_info = model('promotion_manjian')->getInfo([
                ['status', 'in', "0,1"],
                ['site_id', '=', $data['site_id']],
                ['manjian_type', '=', 1],
                ['manjian_id', '<>', $manjian_id],
                ['', 'exp', Db::raw('not ( (`start_time` > ' . $data['end_time'] . ' and `start_time` > ' . $data['start_time'] . ' )  or (`end_time` < ' . $data['start_time'] . ' and `end_time` < ' . $data['end_time'] . '))')]
            ], 'manjian_name,start_time,end_time');
            if (!empty($manjian_activity_info)) {
                $key = 'manjian' . random_keys(8) . $data['site_id'];
                Cache::set($key, ['list' => [$manjian_activity_info], 'type' => 'activity', 'promotion' => '满减送', 'start_time' => $data['start_time'], 'end_time' => $data['end_time']], 3600);
                return $this->error(['key' => $key], 'GOODS_EXIST_MANJIAN');
            }
        }

        $join = [
            ['promotion_manjian pm', 'pm.manjian_id = pmg.manjian_id', 'left'],
            ['goods g', 'g.goods_id = pmg.goods_id', 'left']
        ];
        // 查询存在交集的满减活动商品
        $condition_jiao = [
            ['pmg.status', 'in', "0,1"],
            ['pmg.site_id', '=', $data['site_id']],
            ['pmg.manjian_id', '<>', $manjian_id],
            ['', 'exp', Db::raw('not ( (pmg.start_time > ' . $data['end_time'] . ' and pmg.start_time > ' . $data['start_time'] . ' )  or (pmg.end_time < ' . $data['start_time'] . ' and pmg.end_time < ' . $data['end_time'] . '))')]
        ];
        if ($data['manjian_type'] != 1) $condition_jiao[] = ['pmg.goods_id', 'in', $data['goods_ids']];
        $manjian_goods_count = model('promotion_manjian_goods')->getList($condition_jiao, 'pmg.start_time,pmg.end_time,pm.manjian_name,g.goods_name', '', 'pmg', $join);
        if (!empty($manjian_goods_count)) {
            $key = 'manjian' . random_keys(8) . $data['site_id'];
            Cache::set($key, ['list' => $manjian_goods_count, 'type' => 'goods', 'promotion' => '满减送', 'start_time' => $data['start_time'], 'end_time' => $data['end_time']], 3600);
            return $this->error(['key' => $key], 'GOODS_EXIST_MANJIAN');
        }

        if ($data['start_time'] <= time()) {
            $data['status'] = 1;//直接启动
        } else {
            $data['status'] = 0;
        }
        model('promotion_manjian')->startTrans();
        try {

            model('promotion_manjian')->update($data, [['site_id', '=', $data['site_id']], ['manjian_id', '=', $manjian_id]]);

            model('promotion_manjian_goods')->delete([
                ['site_id', '=', $data['site_id']],
                ['manjian_id', '=', $manjian_id]
            ]);

            if ($data['manjian_type'] == 1) {//全部商品参与

                //获取商品id
                $goods_ids = model('goods')->getColumn([['site_id', '=', $data['site_id']], ['goods_state', '=', 1]], 'goods_id');
                if (!empty($goods_ids)) {
                    foreach ($goods_ids as $v) {
                        $goods_data = [
                            'manjian_id'   => $manjian_id,
                            'site_id'      => $data['site_id'],
                            'goods_id'     => $v,
                            'manjian_type' => $data['manjian_type'],
                            'status'       => $data['status'],
                            'rule_json'    => $data['rule_json'],
                            'start_time'   => $data['start_time'],
                            'end_time'     => $data['end_time']
                        ];
                        model('promotion_manjian_goods')->add($goods_data);
                    }
                } else {
                    model('promotion_manjian')->rollback();
                    return $this->error('', '请先添加商品');
                }

            } else {
                $goods_ids = explode(',', $data['goods_ids']);

                foreach ($goods_ids as $v) {
                    $goods_data = [
                        'manjian_id'   => $manjian_id,
                        'site_id'      => $data['site_id'],
                        'goods_id'     => $v,
                        'manjian_type' => $data['manjian_type'],
                        'status'       => $data['status'],
                        'rule_json'    => $data['rule_json'],
                        'start_time'   => $data['start_time'],
                        'end_time'     => $data['end_time']
                    ];
                    model('promotion_manjian_goods')->add($goods_data);
                }
            }

            $cron = new Cron();

            $cron->deleteCron([['event', '=', 'CloseManjian'], ['relate_id', '=', $manjian_id]]);
            $cron->deleteCron([['event', '=', 'OpenManjian'], ['relate_id', '=', $manjian_id]]);

            if ($data['start_time'] <= time()) {

                $cron->addCron(1, 0, "满减关闭", "CloseManjian", $data['end_time'], $manjian_id);
            } else {
                $cron->addCron(1, 0, "满减开启", "OpenManjian", $data['start_time'], $manjian_id);
                $cron->addCron(1, 0, "满减关闭", "CloseManjian", $data['end_time'], $manjian_id);
            }

            model('promotion_manjian')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_manjian')->rollback();
            return $this->error('', $e->getMessage());
        }


    }

    /**
     * 删除满减
     * @param unknown $manjian_id
     */
    public function deleteManjian($manjian_id, $site_id)
    {
        $condition = [
            ['manjian_id', '=', $manjian_id],
            ['site_id', '=', $site_id]
        ];
        $res       = model('promotion_manjian')->delete($condition);
        if ($res) {

            model('promotion_manjian_goods')->delete($condition);
            $cron = new Cron();
            $cron->deleteCron([['event', '=', 'OpenManjian'], ['relate_id', '=', $manjian_id]]);
            $cron->deleteCron([['event', '=', 'CloseManjian'], ['relate_id', '=', $manjian_id]]);
            return $this->success($res);
        } else {
            return $this->error();
        }
    }

    /**
     * 获取满减信息
     * @param unknown $condition
     * @param string $field
     */
    public function getManjianInfo($condition, $field = '*')
    {
        $res = model('promotion_manjian')->getInfo($condition, $field);
        return $this->success($res);
    }

    /**
     * 满减详情
     * @param $manjian_id
     * @param $site_id
     * @param string $field
     * @return array
     */
    public function getManjianDetail($manjian_id, $site_id, $field = '*')
    {
        $res = model('promotion_manjian')->getInfo([['manjian_id', '=', $manjian_id], ['site_id', '=', $site_id]], $field);
        if (!empty($res)) {
            //获取商品信息
            if ($res['manjian_type'] == 2) {//指定商品

                $field = 'g.goods_id,g.goods_name,g.goods_stock,g.price';
                $alias = 'mg';
                $join  = [
                    [
                        'goods g',
                        'g.goods_id = mg.goods_id',
                        'inner'
                    ]
                ];

                $goods_list = model('promotion_manjian_goods')->getList([['mg.manjian_id', '=', $manjian_id], ['mg.site_id', '=', $site_id]], $field, '', $alias, $join);
            }

            if (isset($res['rule_json'])) {
                $rule = json_decode($res['rule_json'], true);
                foreach ($rule as $key => $item) {
                    if (isset($item['coupon']) && !empty($item['coupon'])) {
                        $coupon                    = model('promotion_coupon_type')->getInfo([['coupon_type_id', '=', $item['coupon']]], 'coupon_name,type,at_least,money,discount');
                        $rule[$key]['coupon_data'] = $coupon;
                    }
                }
                $res['rule'] = $rule;
            }
        }
        $res['goods_list'] = isset($goods_list) ? $goods_list : [];
        return $this->success($res);
    }

    /**
     * 获取满减列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getManjianList($condition = [], $field = '*', $order = 'manjian_id desc', $limit = null)
    {
        $list = model('promotion_manjian')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取满减列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param string $limit
     */
    public function getManjianGoodsList($condition = [], $field = '', $order = 'id desc', $limit = null)
    {
        $list = model('promotion_manjian_goods')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取最新一条商品满减活动
     * @param int $goods_id
     * @param int $site_id
     */
    public function getGoodsManjianInfo($goods_id, $site_id)
    {
        $condition  = [
            ['site_id', '=', $site_id],
            ['status', '=', 1],
            ['goods_ids', 'like', [$goods_id, '%' . $goods_id . ',%', '%' . $goods_id, '%,' . $goods_id . ',%', ''], 'or'],
            ['end_time', '>', time()]
        ];
        $first_info = model('promotion_manjian')->getFirstData($condition, 'manjian_id,site_id,manjian_name,manjian_type,type,goods_ids,status,start_time,end_time,rule_json', 'create_time desc');
        if (!empty($first_info)) {
            $rule = json_decode($first_info['rule_json'], true);
            foreach ($rule as $key => $item) {
                if (isset($item['coupon']) && !empty($item['coupon'])) {
                    $coupon                    = model('promotion_coupon_type')->getInfo([['coupon_type_id', '=', $item['coupon']]], 'coupon_name,type,at_least,money,discount');
                    $rule[$key]['coupon_data'] = $coupon;
                }
            }
            $first_info['rule_json'] = $rule;
        }
        return $this->success($first_info);
    }

    /**
     * 获取满减分页列表
     * @param array $condition
     * @param number $page
     * @param string $page_size
     * @param string $order
     * @param string $field
     */
    public function getManjianPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {
        $list = model('promotion_manjian')->pageList($condition, $field, $order, $page, $page_size);
        return $this->success($list);
    }

    /**
     * 启动满减
     * @param unknown $manjian_id
     */
    public function cronOpenManjian($manjian_id)
    {
        $manjian_info = model('promotion_manjian')->getInfo([['manjian_id', '=', $manjian_id]], 'start_time,status');
        if (!empty($manjian_info)) {
            if ($manjian_info['start_time'] <= time() && $manjian_info['status'] == 0) {

                if ($manjian_info['status'] == 1) {

                    model('promotion_manjian')->startTrans();
                    try {

                        model('promotion_manjian')->update(['status' => 1], [['manjian_id', '=', $manjian_id]]);
                        model('promotion_manjian_goods')->update(['status' => 1], [['manjian_id', '=', $manjian_id]]);

                        model('promotion_manjian')->commit();
                        return $this->success();
                    } catch (\Exception $e) {

                        model('promotion_manjian')->rollback();
                        return $this->error('', $e->getMessage());
                    }

                } else {
                    return $this->error("", "满减活动已关闭");
                }
            } else {
                return $this->error("", "满减活动已开启或者关闭");
            }

        } else {
            return $this->error("", "满减活动不存在");
        }
    }

    /**
     * 结束满减 自动事件
     * @param unknown $manjian_id
     */
    public function cronCloseManjian($manjian_id)
    {
        $manjian_info = model('promotion_manjian')->getInfo([['manjian_id', '=', $manjian_id]], 'status');
        if (!empty($manjian_info)) {
            if ($manjian_info['status'] == 1) {

                model('promotion_manjian')->startTrans();
                try {

                    model('promotion_manjian')->update(['status' => 2], [['manjian_id', '=', $manjian_id]]);
                    model('promotion_manjian_goods')->update(['status' => 2], [['manjian_id', '=', $manjian_id]]);

                    model('promotion_manjian')->commit();
                    return $this->success();
                } catch (\Exception $e) {

                    model('promotion_manjian')->rollback();
                    return $this->error('', $e->getMessage());
                }

            } else {
                return $this->error("", "满减活动已关闭");
            }
        } else {
            return $this->error("", "满减活动不存在");
        }
    }

    /**
     * 关闭满减 手动关闭
     * @param unknown $manjian_id
     */
    public function closeManjian($manjian_id, $site_id)
    {
        $condition    = array(
            ['manjian_id', '=', $manjian_id],
            ['site_id', "=", $site_id]
        );
        $manjian_info = model('promotion_manjian')->getInfo($condition, 'start_time,end_time,status');
        if (!empty($manjian_info)) {
            if ($manjian_info['status'] == 1) {

                if ($manjian_info['status'] == 1) {

                    model('promotion_manjian')->startTrans();
                    try {

                        model('promotion_manjian')->update(['status' => -1], [['manjian_id', '=', $manjian_id], ['site_id', "=", $site_id]]);
                        model('promotion_manjian_goods')->update(['status' => -1], [['manjian_id', '=', $manjian_id], ['site_id', "=", $site_id]]);

                        model('promotion_manjian')->commit();
                        return $this->success();
                    } catch (\Exception $e) {

                        model('promotion_manjian')->rollback();
                        return $this->error('', $e->getMessage());
                    }

                } else {
                    return $this->error("", "满减活动已关闭");
                }

            } else {
                return $this->error("", "满减活动已关闭");
            }
        } else {
            return $this->error("", "满减活动不存在");
        }
    }

}