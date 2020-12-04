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

use app\model\system\Qrcode as QrcodeModel;

/**
 * 生成二维码
 * @author Administrator
 *
 */
class Qrcode
{
    public function handle($param)
    {
        if (in_array($param["app_type"], ['h5', 'all', 'wechat'])) {
            $param["app_type"] = 'h5';
            $qrcode            = new QrcodeModel();
            $res               = $qrcode->createQrcode($param);
            return $res;
        }
    }

}
