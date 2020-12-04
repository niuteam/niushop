<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\event;

use app\model\games\Games;

/**
 * 关闭小游戏
 * @author Administrator
 *
 */
class CloseGame
{
    public function handle($param)
    {
        $model  = new Games();
        $result = $model->cronCloseGames($param['relate_id']);
        return $result;
    }
}
