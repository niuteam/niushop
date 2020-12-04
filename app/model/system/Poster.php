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
use extend\Poster as PosterExtend;

/**
 * 海报生成类
 */
class Poster extends BaseModel
{
    /**
     * 商品海报
     */
    public function goods($app_type, $page, $qrcode_param, $promotion_type = 'null', $site_id)
    {
        try {
            $goods_info = $this->getGoodsInfo($qrcode_param['sku_id']);
            if (empty($goods_info)) return $this->error('未获取到商品信息');

            $qrcode_info = $this->getGoodsQrcode($app_type, $page, $qrcode_param, $promotion_type, $site_id);
            if ($qrcode_info['code'] < 0) return $qrcode_info;

            if (!empty($qrcode_param['source_member'])) {
                $member_info = $this->getMemberInfo($qrcode_param['source_member']);
            }

            $poster_width  = 740;
            $poster_height = !empty($member_info) ? 1120 : 1000;

            $poster = new PosterExtend($poster_width, $poster_height);
            $option = [
                [
                    'action' => 'setBackground', // 设背景色
                    'data'   => [255, 255, 255]
                ],
                [
                    'action' => 'imageCopy', // 写入商品图
                    'data'   => [
                        $goods_info['sku_image'],
                        20,
                        20,
                        700,
                        700
                    ]
                ],
                [
                    'action' => 'imageText', // 写入商品名称
                    'data'   => [
                        $goods_info['sku_name'],
                        22,
                        [0, 0, 0],
                        20,
                        !empty($member_info) ? 895 : 775,
                        490,
                        2,
                        true
                    ]
                ],
                [
                    'action' => 'imageCopy', // 写入商品二维码
                    'data'   => [
                        $qrcode_info['data']['path'],
                        510,
                        !empty($member_info) ? 860 : 740,
                        210,
                        210
                    ]
                ],
                [
                    'action' => 'imageText', // 写入提示
                    'data'   => [
                        '长按扫码购买',
                        16,
                        [102, 102, 102],
                        555,
                        !empty($member_info) ? 1100 : 980,
                        490,
                        1
                    ]
                ],
                [
                    'action' => 'imageText', // 写入商品推广语
                    'data'   => [
                        $goods_info['introduction'],
                        18,
                        [102, 102, 102],
                        20,
                        !empty($member_info) ? 975 : 855,
                        490,
                        1
                    ]
                ],
                [
                    'action' => 'imageText', // 写入商品价格
                    'data'   => [
                        '¥' . $goods_info['discount_price'],
                        30,
                        [255, 0, 0],
                        20,
                        !empty($member_info) ? 1065 : 945,
                        490,
                        2,
                        true
                    ]
                ],
            ];
            if (!empty($member_info)) {
                $member_option = [
                    [
                        'action' => 'imageCircularCopy', // 写入用户头像
                        'data'   => [
                            !empty($member_info['headimg']) ? $member_info['headimg'] : 'upload/uniapp/default_headimg.png',
                            20,
                            740,
                            100,
                            100
                        ]
                    ],
                    [
                        'action' => 'imageText', // 写入分享人昵称
                        'data'   => [
                            $member_info['nickname'],
                            22,
                            [10, 10, 10],
                            140,
                            790,
                            580,
                            1
                        ]
                    ],
                    [
                        'action' => 'imageText', // 写入分享人昵称
                        'data'   => [
                            '分享给你一个商品',
                            18,
                            [102, 102, 102],
                            140,
                            825,
                            580,
                            1
                        ]
                    ]
                ];
                $option        = array_merge($option, $member_option);
            }

            $option_res = $poster->create($option);
            if (is_array($option_res)) return $option_res;

            $res = $option_res->jpeg('upload/poster/goods', 'goods_' . $promotion_type . '_' . $qrcode_param['sku_id'] . '_' . $qrcode_param['source_member'] . '_' . $app_type);
            return $res;
        } catch (\Exception $e) {
            return $this->error($e->getMessage() . $e->getFile() . $e->getLine());
        }
    }

    /**
     * 获取用户信息
     * @param unknown $member_id
     */
    private function getMemberInfo($member_id)
    {
        $info = model('member')->getInfo(['member_id' => $member_id], 'nickname,headimg');
        return $info;
    }

    /**
     * 获取商品信息
     * @param unknown $sku_id
     */
    private function getGoodsInfo($sku_id)
    {
        $info = model('goods_sku')->getInfo(['sku_id' => $sku_id], 'sku_name,introduction,price,discount_price,sku_image,collect_num');
        return $info;
    }

    /**
     * 获取商品二维码
     * @param unknown $app_type 请求类型
     * @param unknown $page uniapp页面路径
     * @param unknown $qrcode_param 二维码携带参数
     * @param string $promotion_type 活动类型 null为无活动
     */
    private function getGoodsQrcode($app_type, $page, $qrcode_param, $promotion_type = 'null', $site_id)
    {
        $res = event('Qrcode', [
            'site_id'     => $site_id,
            'app_type'    => $app_type,
            'type'        => 'create',
            'data'        => $qrcode_param,
            'page'        => $page,
            'qrcode_path' => 'upload/qrcode/goods',
            'qrcode_name' => 'goods_' . $promotion_type . '_' . $qrcode_param['sku_id'] . '_' . $qrcode_param['source_member'] . '_' . $site_id,
        ], true);
        return $res;
    }
}