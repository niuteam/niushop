<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */


namespace addon\niusms\event;

use addon\niusms\model\Sms;

/**
 * 短信发送
 */
class SendSms
{
    /**
     * 短信发送方式方式及配置
     * @param $param
     * @return array|mixed
     * @throws \Overtrue\EasySms\Exceptions\InvalidArgumentException
     */
    public function handle($param)
    {
        $sms = new Sms();
        $res = $sms->send($param);
        return $res;
    }
}