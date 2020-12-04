<?php
/**
 * NiuShop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com
 */

namespace addon\niusms\model;

use app\model\BaseModel;


class Template extends BaseModel
{

    /**
     * 获取模板信息
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getTemplateInfo($site_id, $keywords, $field = "*")
    {
        $info = model('sms_template')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ], $field);
        //获取message信息
        $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ]);
        if (empty($message)) {
            $data = [
                'keywords' => $keywords,
                'site_id' => $site_id,
                'sms_is_open' => 0,
            ];
            model('message')->add($data);
            $message = model('message')->getInfo([ [ 'keywords', '=', $keywords ], [ 'site_id', '=', $site_id ] ]);
        }
        $info = array_merge($info, $message);

        return $this->success($info);
    }
}