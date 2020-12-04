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

use app\model\express\ExpressCompany;
use app\model\express\ExpressCompanyTemplate;

/**
 * 增加默认物流公司数据：
 */
class AddSiteExpressCompany
{
    public function handle($param)
    {
        if (!empty($param['site_id'])) {
            $template_model        = new ExpressCompanyTemplate();
            $express_company_model = new ExpressCompany();

            $template_data = [
                [
                    'company_name'       => '顺丰速运',
                    'sort'               => 1,
                    'logo'               => 'upload/default/express/shunfeng.png',
                    'url'                => 'http://www.sf-express.com',
                    'express_no'         => 'SF',
                    'express_no_kd100'   => 'shunfeng',
                    'express_no_cainiao' => 'SF',
                    'content_json'       => '[]',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 1,
                    'print_style'        => '[{"template_name":"二联 150 新","template_size":"15001"},{"template_name":"二联 180 新","template_size":"180"},{"template_name":"三联 210 新","template_size":"21001"}]'
                ],
                [
                    'company_name'       => '韵达快递',
                    'sort'               => 2,
                    'logo'               => 'upload/default/express/yunda.png',
                    'url'                => 'http://www.yundaex.com',
                    'express_no'         => 'YD',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '[]',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ],
                [
                    'company_name'       => '百世快递',
                    'sort'               => 3,
                    'logo'               => 'upload/default/express/huitongkuaidi.png',
                    'url'                => 'http://www.800bestex.com/',
                    'express_no'         => 'HTKY',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ],
                [
                    'company_name'       => '圆通速递',
                    'sort'               => 4,
                    'logo'               => 'upload/default/express/yuantong.png',
                    'url'                => 'http://www.yto.net.cn/',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ],
                [
                    'company_name'       => '中通快递',
                    'sort'               => 5,
                    'logo'               => 'upload/default/express/zhongtong.png',
                    'url'                => 'https://www.zto.com/',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ],
                [
                    'company_name'       => '申通快递',
                    'sort'               => 6,
                    'logo'               => 'upload/default/express/shentong.png',
                    'url'                => 'http://www.sto.cn/',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ],
                [
                    'company_name'       => '邮政国内标快',
                    'sort'               => 7,
                    'logo'               => 'upload/default/express/youzhengguonei.png',
                    'url'                => 'http://yjcx.chinapost.com.cn/qps/yjcx',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 1,
                    'print_style'        => '[{"template_name":"二联 150","template_size":""}]'
                ],
                [
                    'company_name'       => '邮政快递包裹',
                    'sort'               => 8,
                    'logo'               => 'upload/default/express/youzhengkd.png',
                    'url'                => 'http://yjcx.chinapost.com.cn/qps/yjcx',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 1,
                    'print_style'        => '[{"template_name":"二联 180","template_size":""},{"template_name":"二联 180 新","template_size":"180"}]'
                ],
                [
                    'company_name'       => '天天快递',
                    'sort'               => 9,
                    'logo'               => 'upload/default/express/tiantian.png',
                    'url'                => 'https://www.ttkdex.com/',
                    'express_no'         => '',
                    'express_no_kd100'   => '',
                    'express_no_cainiao' => '',
                    'content_json'       => '',
                    'background_image'   => '',
                    'font_size'          => 14,
                    'width'              => 766,
                    'height'             => 510,
                    'scale'              => 1.00,
                    'create_time'        => time(),
                    'is_electronicsheet' => 0,
                    'print_style'        => ''
                ]
            ];

            foreach ($template_data as $item) {
                $item['site_id'] = $param['site_id'];
                $res             = $template_model->addExpressCompanyTemplate($item);
                if ($res['code'] >= 0) {
                    $express_company_model->addExpressCompany(['site_id' => $param['site_id'], 'company_id' => $res['data']]);
                }
            }
        }
    }

}