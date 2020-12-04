<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\games;


use addon\coupon\model\Coupon;
use app\model\BaseModel;
use app\model\member\MemberAccount;
use app\model\system\Cron;
use think\Exception;
use app\model\system\Config as ConfigModel;

/**
 * 游戏
 */
class Games extends BaseModel
{

    /**
     * 添加游戏活动
     * @param $game_data
     * @param $award_json
     * @return array
     */
    public function addGames($game_data, $award_json)
    {
        $time = time();
        $game_data[ 'create_time' ] = $time;

        if ($time > $game_data[ 'start_time' ] && $time < $game_data[ 'end_time' ]) {
            $game_data[ 'status' ] = 1;
        } else {
            $game_data[ 'status' ] = 0;
        }
        model('promotion_games')->startTrans();
        try {

            $game_id = model('promotion_games')->add($game_data);

            //添加奖品
            $award_json_data = json_decode($award_json, true);
            $award_data = [];
            $award_winning_rate = 0;
            foreach ($award_json_data as $k => $v) {
                $item = [
                    'site_id' => $game_data[ 'site_id' ],
                    'game_id' => $game_id,
                    'award_name' => $v[ 'award_name' ],
                    'award_img' => isset($v[ 'award_img' ]) ? $v[ 'award_img' ] : '',
                    'award_type' => $v[ 'award_type' ],
                    'relate_id' => $v[ 'relate_id' ],
                    'relate_name' => isset($v[ 'relate_name' ]) ? $v[ 'relate_name' ] : '',
                    'point' => $v[ 'point' ],
                    'balance' => $v[ 'balance' ],
                    'award_num' => $v[ 'award_num' ],
                    'award_winning_rate' => $v[ 'award_winning_rate' ],
                    'remaining_num' => $v[ 'award_num' ],
                    'no_winning_img' => isset($v[ 'no_winning_img' ]) ? $v[ 'no_winning_img' ] : '',
                ];
                $award_data[ $k ] = $item;
            }

            model('promotion_games_award')->addList($award_data);

            $cron = new Cron();
            if ($game_data[ 'status' ] == 1) {//进行中

                $cron->addCron(1, 0, "游戏活动关闭", "CloseGame", $game_data[ 'end_time' ], $game_id);
            } else {//未进行
                $cron->addCron(1, 0, "游戏活动开启", "OpenGame", $game_data[ 'start_time' ], $game_id);
                $cron->addCron(1, 0, "游戏活动关闭", "CloseGame", $game_data[ 'start_time' ], $game_id);
            }

            model('promotion_games')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_games')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 编辑游戏活动
     * @param $condition
     * @param $game_data
     * @param $award_json
     * @return array
     */
    public function editGames($condition, $game_data, $award_json, $delete_award_ids)
    {
        $game_info = model('promotion_games')->getInfo($condition, 'game_id,status');
        if (in_array($game_info[ 'status' ], [ 2, 3 ])) {
            return $this->error('', '已关闭或已结束的活动不能编辑');
        }

        $game_id = $game_info[ 'game_id' ];

        $time = time();
        $game_data[ 'update_time' ] = $time;

        if ($time > $game_data[ 'start_time' ] && $time < $game_data[ 'end_time' ]) {
            $game_data[ 'status' ] = 1;
        } else {
            $game_data[ 'status' ] = 0;
        }
        model('promotion_games')->startTrans();
        try {

            model('promotion_games')->update($game_data, $condition);

            if (!empty($delete_award_ids)) {
                model('promotion_games_award')->delete([ [ 'award_id', 'in', $delete_award_ids ] ]);
            }

            //添加奖品
            $award_json_data = json_decode($award_json, true);
            foreach ($award_json_data as $k => $v) {
                $item = [
                    'site_id' => $game_data[ 'site_id' ],
                    'game_id' => $game_id,
                    'award_name' => $v[ 'award_name' ],
                    'award_img' => isset($v[ 'award_img' ]) ? $v[ 'award_img' ] : '',
                    'award_type' => $v[ 'award_type' ],
                    'relate_id' => $v[ 'relate_id' ],
                    'relate_name' => isset($v[ 'relate_name' ]) ? $v[ 'relate_name' ] : '',
                    'point' => $v[ 'point' ],
                    'balance' => $v[ 'balance' ],
                    'award_num' => $v[ 'award_num' ],
                    'award_winning_rate' => $v[ 'award_winning_rate' ],
                    'remaining_num' => $v[ 'award_num' ],
                    'no_winning_img' => isset($v[ 'no_winning_img' ]) ? $v[ 'no_winning_img' ] : '',
                ];

                if (isset($v[ 'award_id' ]) && $v[ 'award_id' ] > 0) {
                    model('promotion_games_award')->update($item, [ [ 'award_id', '=', $v[ 'award_id' ] ] ]);
                } else {
                    model('promotion_games_award')->add($item);
                }
            }

            $cron = new Cron();

            $cron->deleteCron([ [ 'event', '=', 'OpenGame' ], [ 'relate_id', '=', $game_id ] ]);
            $cron->deleteCron([ [ 'event', '=', 'CloseGame' ], [ 'relate_id', '=', $game_id ] ]);

            if ($game_data[ 'status' ] == 1) {//进行中

                $cron->addCron(1, 0, "游戏活动关闭", "CloseGame", $game_data[ 'end_time' ], $game_id);
            } else {//未进行
                $cron->addCron(1, 0, "游戏活动开启", "OpenGame", $game_data[ 'start_time' ], $game_id);
                $cron->addCron(1, 0, "游戏活动关闭", "CloseGame", $game_data[ 'start_time' ], $game_id);
            }

            model('promotion_games')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_games')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取游戏奖项
     * @param array $condition
     * @param string $field
     */
    public function getGameAward($condition = [], $field = '*')
    {
        $data = model('promotion_games_award')->getList($condition, $field);
        return $this->success($data);
    }


    /**
     * 获取游戏信息
     * @param array $condition
     * @param string $field
     */
    public function getGamesInfo($condition, $field = '*')
    {
        $res = model('promotion_games')->getInfo($condition, $field);
        return $this->success($res);
    }

    /**
     * 获取游戏详情
     * @param int $site_id
     */
    public function getGamesDetail($site_id, $game_id)
    {
        $res = model('promotion_games')->getInfo([ [ 'site_id', '=', $site_id ], [ 'game_id', '=', $game_id ] ], '*');

        if (!empty($res)) {
            $game_award = model('promotion_games_award')->getList([ [ 'site_id', '=', $site_id ], [ 'game_id', '=', $game_id ] ], '*');
            $res[ 'game_award' ] = $game_award;
        }

        return $this->success($res);
    }

    /**
     * 删除游戏
     * @param $site_id
     * @param $game_id
     * @return array
     */
    public function deleteGames($site_id, $game_id)
    {
        model('promotion_games')->startTrans();
        try {

            model('promotion_games')->delete([ [ 'site_id', '=', $site_id ], [ 'game_id', '=', $game_id ] ]);
            model('promotion_games_award')->delete([ [ 'site_id', '=', $site_id ], [ 'game_id', '=', $game_id ] ]);
            model('promotion_games')->commit();
            return $this->success();
        } catch (\Exception $e) {

            model('promotion_games')->rollback();
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 获取游戏列表
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param null $limit
     * @return array
     */
    public function getGamesList($condition = [], $field = '*', $order = '', $limit = null)
    {

        $list = model('promotion_games')->getList($condition, $field, $order, '', '', '', $limit);
        return $this->success($list);
    }

    /**
     * 获取游戏分页列表
     * @param array $condition
     * @param int $page
     * @param int $page_size
     * @param string $order
     * @param string $field
     * @return array
     */
    public function getGamesPageList($condition = [], $page = 1, $page_size = PAGE_LIST_ROWS, $order = '', $field = '*')
    {

        $list = model('promotion_games')->pageList($condition, $field, $order, $page, $page_size);

        return $this->success($list);
    }

    /**
     * 关闭游戏
     * @param $site_id
     * @param $game_id
     * @return array
     */
    public function finishGames($site_id, $game_id)
    {
        //团购信息
        $game_info = model('promotion_games')->getInfo([ [ 'game_id', '=', $game_id ], [ 'site_id', '=', $site_id ] ], 'status');
        if (!empty($game_info)) {

            if ($game_info[ 'status' ] != 3) {
                $res = model('promotion_games')->update([ 'status' => 3 ], [ [ 'game_id', '=', $game_id ] ]);
                if ($res) {
                    $cron = new Cron();
                    $cron->deleteCron([ [ 'event', '=', 'OpenGame' ], [ 'relate_id', '=', $game_id ] ]);
                    $cron->deleteCron([ [ 'event', '=', 'CloseGame' ], [ 'relate_id', '=', $game_id ] ]);
                }
                return $this->success($res);
            } else {
                $this->error('', '该游戏已关闭');
            }

        } else {
            $this->error('', '该游戏不存在');
        }
    }


    /**
     * 开启游戏
     * @param $game_id
     * @return array|\multitype
     */
    public function cronOpenGames($game_id)
    {
        $game_info = model('promotion_games')->getInfo([ [ 'game_id', '=', $game_id ] ], 'start_time,status');
        if (!empty($game_info)) {

            if ($game_info[ 'start_time' ] <= time() && $game_info[ 'status' ] == 0) {
                $res = model('promotion_games')->update([ 'status' => 1 ], [ [ 'game_id', '=', $game_id ] ]);
                return $this->success($res);
            } else {
                return $this->error("", "游戏已开启或者关闭");
            }

        } else {
            return $this->error("", "游戏不存在");
        }

    }

    /**
     * 关闭游戏
     * @param $game_id
     * @return array|\multitype
     */
    public function cronCloseGames($game_id)
    {
        $game_info = model('promotion_games')->getInfo([ [ 'game_id', '=', $game_id ] ], 'start_time,status');
        if (!empty($game_info)) {
            if ($game_info[ 'status' ] != 2) {
                $res = model('promotion_games')->update([ 'status' => 2 ], [ [ 'game_id', '=', $game_id ] ]);
                return $this->success($res);
            } else {
                return $this->error("", "该游戏已结束");
            }
        } else {
            return $this->error("", "游戏不存在");
        }
    }

    /**
     * 抽奖
     * @param $game_id
     * @param $member_id
     * @param $site_id
     */
    public function lottery($game_id, $member_id, $site_id)
    {
        $game_info = model('promotion_games')->getInfo([ [ 'game_id', '=', $game_id ], [ 'site_id', '=', $site_id ] ]);
        if (empty($game_info)) return $this->error("", "未获取到游戏信息");

        if ($game_info[ 'status' ] == 0) return $this->error("", "游戏尚未开始");
        if ($game_info[ 'status' ] == 2 || $game_info[ 'status' ] == 3) return $this->error("", "游戏已经结束");

        $member_info = model('member')->getInfo([ [ 'member_id', '=', $member_id ], [ 'site_id', '=', $site_id ], [ 'status', '=', 1 ] ], 'nickname,member_level,point');
        if (empty($member_info)) return $this->error("", "未获取到会员信息");

        if (!empty($game_info[ 'level_id' ])) {
            $level = explode(',', $game_info[ 'level_id' ]);
            if (!in_array($member_info[ 'member_level' ], $level)) {
                return $this->error("", "只有{$game_info['level_name']}等级的会员可参与该活动");
            }
        }

        if ($game_info[ 'join_type' ]) {
            // 每天
            $tody_start = strtotime(date("Y-m-d"), time());
            $luck_draw_num = model('promotion_games_draw_record')->getCount([ [ 'game_id', '=', $game_id ], [ 'member_id', '=', $member_id ], [ 'create_time', 'between', [ $tody_start, time() ] ] ]);
            if ($luck_draw_num > $game_info[ 'join_frequency' ]) return $this->error("", "您今日的抽奖次数已用完");
        } else {
            // 全程
            $luck_draw_num = model('promotion_games_draw_record')->getCount([ [ 'game_id', '=', $game_id ], [ 'member_id', '=', $member_id ] ]);
            if ($luck_draw_num > $game_info[ 'join_frequency' ]) return $this->error("", "您的抽奖次数已用完");
        }

        if ($game_info[ 'points' ] > 0 && $member_info[ 'point' ] < $game_info[ 'points' ]) return $this->error("", "积分不足");

        $lottery_result = $this->lotteryCalculate($game_info);

        model('promotion_games')->startTrans();
        try {
            $meber_account = new MemberAccount();
            if ($game_info[ 'points' ] > 0) {
                // 扣除积分
                $meber_account->addMemberAccount($site_id, $member_id, 'point', -$game_info[ 'points' ], $game_info[ 'game_type' ], $game_id, "{$game_info['game_type_name']}消耗积分");
            }
            model('promotion_games')->setInc([ [ 'game_id', '=', $game_id ] ], 'join_num'); // 抽奖人数
            $record = [
                'site_id' => $site_id,
                'game_id' => $game_id,
                'game_type' => $game_info[ 'game_type' ],
                'member_id' => $member_id,
                'member_nick_name' => $member_info[ 'nickname' ],
                'points' => $game_info[ 'points' ],
                'create_time' => time()
            ];

            if ($lottery_result[ 'is_winning' ]) {
                switch ( $lottery_result[ 'award_type' ] ) {
                    case 1:
                        // 积分
                        $meber_account->addMemberAccount($site_id, $member_id, 'point', $lottery_result[ 'point' ], $game_info[ 'game_type' ], $game_id, "{$game_info['game_type_name']}获得积分");
                        break;
                    case 2:
                        // 余额
                        $meber_account->addMemberAccount($site_id, $member_id, 'balance', $lottery_result[ 'balance' ], $game_info[ 'game_type' ], $game_id, "{$game_info['game_type_name']}获得余额");
                        break;
                    case 3:
                        // 优惠券
                        $coupon = new Coupon();
                        $receive_res = $coupon->receiveCoupon($lottery_result[ 'relate_id' ], $site_id, $member_id, '', 0, 0);
                        // 如果优惠券发放失败则本次抽奖为未中奖
                        if ($receive_res[ 'code' ] < 0) {
                            $lottery_result = [ 'is_winning' => 0 ];
                        }
                        break;
                    case 4:
                        // 赠品
                        break;
                }

                if ($lottery_result[ 'is_winning' ]) {
                    $record[ 'is_winning' ] = 1;
                    $record[ 'award_id' ] = $lottery_result[ 'award_id' ];
                    $record[ 'award_name' ] = $lottery_result[ 'award_name' ];
                    $record[ 'award_type' ] = $lottery_result[ 'award_type' ];
                    $record[ 'relate_id' ] = $lottery_result[ 'relate_id' ];
                    $record[ 'relate_name' ] = $lottery_result[ 'relate_name' ];
                    $record[ 'point' ] = $lottery_result[ 'point' ];
                    $record[ 'balance' ] = $lottery_result[ 'balance' ];

                    model('promotion_games')->setInc([ [ 'game_id', '=', $game_id ] ], 'winning_num'); // 中奖人数

                    model('promotion_games_award')->setDec([ [ 'award_id', '=', $lottery_result[ 'award_id' ] ] ], 'remaining_num'); // 剩余数量
                    model('promotion_games_award')->setInc([ [ 'award_id', '=', $lottery_result[ 'award_id' ] ] ], 'receive_num'); // 已领取数量
                }
            }
            model('promotion_games_draw_record')->add($record);
            model('promotion_games')->commit();
            return $this->success($lottery_result);
        } catch (\Exception $e) {
            model('promotion_games')->rollback();
            return $this->error("", $e->getMessage());
        }
    }

    /**
     * 中奖计算
     */
    private function lotteryCalculate($data)
    {
        $rand = mt_rand(1, 10000);
        $result = [ 'is_winning' => 0 ];
        if ($data[ 'winning_rate' ] > 0 && $rand <= ( $data[ 'winning_rate' ] * 100 )) {
            $award_list = model('promotion_games_award')->getList([ [ 'game_id', '=', $data[ 'game_id' ] ], [ 'remaining_num', '>', 0 ] ], 'award_id,award_name,award_type,relate_id,relate_name,point,balance,award_winning_rate', 'award_winning_rate asc');
            if (!empty($award_list)) {
                $rate_arr = [];
                foreach ($award_list as $item) {
                    $rate_arr[] = $item[ 'award_winning_rate' ];
                }
                $key = $this->get_rand($rate_arr);
                if (isset($award_list[ $key ])) {
                    $result = $award_list[ $key ];
                    $result[ 'is_winning' ] = 1;
                    unset($result[ 'award_winning_rate' ]);
                }
            } else {
                model('promotion_games')->update([ 'status' => 2 ], [ [ 'game_id', '=', $data[ 'game_id' ] ] ]);
            }
        }
        return $result;
    }

    /**
     * 获取随机奖励
     * @param $proArr
     * @return int|string
     */
    private function get_rand($proArr)
    {
        $result = '';
        //总权重
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }

    /**
     * 获取会员剩余可抽奖次数
     * @param $game_id
     * @param $member_id
     * @param $site_id
     */
    public function getMemberSurplusNum($game_id, $member_id, $site_id)
    {
        $num = 0;
        $game_info = model('promotion_games')->getInfo([ [ 'game_id', '=', $game_id ], [ 'site_id', '=', $site_id ], [ 'status', '=', 1 ] ], 'join_type,join_frequency');
        if (!empty($game_info)) {
            if ($game_info[ 'join_type' ]) {
                // 每天
                $tody_start = strtotime(date("Y-m-d"), time());
                $luck_draw_num = model('promotion_games_draw_record')->getCount([ [ 'game_id', '=', $game_id ], [ 'member_id', '=', $member_id ], [ 'create_time', 'between', [ $tody_start, time() ] ] ]);
                if ($luck_draw_num < $game_info[ 'join_frequency' ]) {
                    $num = $game_info[ 'join_frequency' ] - $luck_draw_num;
                }
            } else {
                // 全程
                $luck_draw_num = model('promotion_games_draw_record')->getCount([ [ 'game_id', '=', $game_id ], [ 'member_id', '=', $member_id ] ]);
                if ($luck_draw_num < $game_info[ 'join_frequency' ]) {
                    $num = $game_info[ 'join_frequency' ] - $luck_draw_num;
                }
            }
        }
        return $this->success($num);

    }

    /**
     * 游戏推广二维码
     * @param $game_id
     * @param $game_name
     * @param $url
     * @param $site_id
     * @param string $type
     * @return array
     */
    public function qrcode($game_id, $game_name, $url, $site_id, $type = "create")
    {
        $data = [
            'site_id' => $site_id,
            'app_type' => "all", // all为全部
            'type' => $type, // 类型 create创建 get获取
            'data' => [
                "id" => $game_id
            ],
            'page' => $url,
            'qrcode_path' => 'upload/qrcode/games',
            'qrcode_name' => "games_qrcode_" . $game_id
        ];

        event('Qrcode', $data, true);
        $app_type_list = config('app_type');
        $path = [];
        foreach ($app_type_list as $k => $v) {
            switch ( $k ) {
                case 'h5':
                    $wap_domain = getH5Domain();
                    $path[ $k ][ 'status' ] = 1;
                    $path[ $k ][ 'url' ] = $wap_domain . $data[ 'page' ] . '?id=' . $game_id;
                    $path[ $k ][ 'img' ] = "upload/qrcode/games/games_qrcode_" . $game_id . "_" . $k . ".png";
                    break;
                case 'weapp' :
                    $config = new ConfigModel();
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WEAPP_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信小程序';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }

                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信小程序';
                    }
                    break;

                case 'wechat' :
                    $config = new ConfigModel();
                    $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', 'shop' ], [ 'config_key', '=', 'WECHAT_CONFIG' ] ]);
                    if (!empty($res[ 'data' ])) {
                        if (empty($res[ 'data' ][ 'value' ][ 'qrcode' ])) {
                            $path[ $k ][ 'status' ] = 2;
                            $path[ $k ][ 'message' ] = '未配置微信公众号';
                        } else {
                            $path[ $k ][ 'status' ] = 1;
                            $path[ $k ][ 'img' ] = $res[ 'data' ][ 'value' ][ 'qrcode' ];
                        }
                    } else {
                        $path[ $k ][ 'status' ] = 2;
                        $path[ $k ][ 'message' ] = '未配置微信公众号';
                    }
                    break;
            }

        }

        $return = [
            'path' => $path,
            'game_name' => $game_name,
        ];

        return $this->success($return);
    }

}