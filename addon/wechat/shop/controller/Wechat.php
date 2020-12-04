<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+
namespace addon\wechat\shop\controller;

use addon\wechat\model\Config as ConfigModel;
use addon\wechat\model\Qrcode;

/**
 * 微信公众号基础功能
 */
class Wechat extends BaseWechat
{

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();

    }

    /**
     * 功能设置
     */
    public function setting()
    {
        $setting_arr = [
            [
                'url'     => addon_url('wechat://shop/wechat/config'),
                'img'     => 'config_wechat_icon.png',
                'title'   => '公众号管理',
                'content' => '公众号管理',
            ],
            [
                'url'     => addon_url('wechat://shop/material/lists'),
                'img'     => 'config_material_icon.png',
                'title'   => '消息素材',
                'content' => '消息素材',
            ],
            [
                'url'     => addon_url('wechat://shop/fans/lists'),
                'img'     => 'config_material_icon.png',
                'title'   => '粉丝列表',
                'content' => '粉丝列表',
            ],
            [
                'url'     => addon_url('wechat://shop/menu/menu'),
                'img'     => 'config_menu_icon.png',
                'title'   => '菜单管理',
                'content' => '菜单管理',
            ],
//            [
//                'url' => addon_url('wechat://shop/wechat/qrcode'),
//                'img' => 'config_qrcode_icon.png',
//                'title' => '推广二维码',
//                'content' => '推广二维码管理',
//            ],
            [
                'url'     => addon_url('wechat://shop/wechat/share'),
                'img'     => 'config_share_icon.png',
                'title'   => '分享内容设置',
                'content' => '分享内容设置',
            ],
            [
                'url'     => addon_url('wechat://shop/replay/replay'),
                'img'     => 'config_replay_icon.png',
                'title'   => '回复设置',
                'content' => '回复设置',
            ],
//            [
//                'url' => addon_url('wechat://shop/wechat/mass'),
//                'img' => 'config_mass_icon.png',
//                'title' => '群发设置',
//                'content' => '群发设置',
//            ],
            [
                'url'     => addon_url('wechat://shop/message/config'),
                'img'     => 'config_message_icon.png',
                'title'   => '模板消息',
                'content' => '模板消息设置',
            ],
        ];
        $this->assign('setting_arr', $setting_arr);
        return $this->fetch('wechat/setting', [], $this->replace);
    }


    /**
     * 公众号配置
     */
    public function config()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $wechat_name     = input('wechat_name', '');//公众号名称 (备注: 公众号名称,尽量与公众号平台保持一致)
            $wechat_original = input('wechat_original', '');//公众号原始id (备注: 公众号原始id,如：gh_111111111111)
            $appid           = input('appid', '');//gh_845581623321AppID (备注: AppID 请注意需要与微信公众号平台保持一致，且注意信息安全，不要随意透露给第三方)
            $appsecret       = input('appsecret', '');//AppSecret (备注: AppSecret密钥需要与微信公众号平台保持一致，没有特别原因不要随意修改，也不要随意透露给第三方)
            $token           = input('token', 'TOKEN');//Token (备注: 自定义的Token值、确保后台与公众号平台填写的一致)
            $encodingaeskey  = input('encodingaeskey', '');//EncodingAESKey (备注: 由开发者手动填写或随机生成，将用作消息体加解密密钥)
            $is_use          = input('is_use', 1);//是否启用
            $qrcode          = input('qrcode', '');//二维码
            $headimg         = input('headimg', '');//头像
            $data            = array(
                "wechat_name"     => $wechat_name,
                "wechat_original" => $wechat_original,
                "appid"           => $appid,
                "appsecret"       => $appsecret,
                "token"           => $token,
                "encodingaeskey"  => $encodingaeskey,
                'qrcode'          => $qrcode,
                'headimg'         => $headimg,
            );

            $res = $config_model->setWechatConfig($data, $is_use, $this->site_id);
            return $res;
        } else {
            $config_result = $config_model->getWechatConfig($this->site_id);
            $config        = $config_result["data"];
            $is_authopen   = $config_result['data']['value']['is_authopen'] ?? 0;
            if ($is_authopen == 1) {
                $config['value'] = [];
            }
            $this->assign("config", $config);
            // 获取当前域名
            $url = __ROOT__;
            // 去除链接的http://头部
            $url_top = str_replace("https://", "", $url);
            $url_top = str_replace("http://", "", $url_top);
            // 去除链接的尾部/?s=
            $url_top       = str_replace('/?s=', '', $url_top);
            $call_back_url = addon_url("wechat://api/auth/relateweixin");
            $this->assign("url", $url_top);
            $this->assign("call_back_url", $call_back_url);

            return $this->fetch('wechat/config');
        }
    }

    /**
     * 推广二维码模板
     */
    public function qrcode()
    {
        $qrcode_model  = new Qrcode();
        $template_list = $qrcode_model->getQrcodePageList(['is_remove' => 0]);
        $this->assign("template_list", $template_list['data']);
        return $this->fetch('wechat/qrcode', [], $this->replace);
    }

    /**
     * 推广二维码
     */
    public function addQrcode()
    {
        if (request()->isAjax()) {
            $data         = array(
                'background'      => input("background", ''),
                'nick_font_color' => input("nick_font_color", '#000'),
                'nick_font_size'  => input("nick_font_size", '12'),
                'is_logo_show'    => input("is_logo_show", '1'),
                'header_left'     => input("header_left", '59') . 'px',
                'header_top'      => input("header_top", '15') . 'px',
                'name_left'       => input("name_left", '128') . 'px',
                'name_top'        => input("name_top", '23') . 'px',
                'logo_left'       => input("logo_left", '60') . 'px',
                'logo_top'        => input("logo_top", '200') . 'px',
                'code_left'       => input("code_left", '70') . 'px',
                'code_top'        => input("code_top", '300') . 'px',
            );
            $qrcode_model = new Qrcode();
            $result       = $qrcode_model->addQrcode($data);
            return $result;
        } else {
            return $this->fetch('wechat/add_qrcode', [], $this->replace);
        }
    }

    /**
     * 编辑二维码模板
     * @return mixed
     */
    public function editQrcode()
    {
        $id           = input("id", 0);
        $qrcode_model = new Qrcode();
        $condition    = array(
            "id" => $id
        );
        if (request()->isAjax()) {
            $data = array(
                'background'      => input("background", ''),
                'nick_font_color' => input("nick_font_color", '#000'),
                'nick_font_size'  => input("nick_font_size", '12'),
                'is_logo_show'    => input("is_logo_show", '1'),
                'header_left'     => input("header_left", '59') . 'px',
                'header_top'      => input("header_top", '15') . 'px',
                'name_left'       => input("name_left", '128') . 'px',
                'name_top'        => input("name_top", '23') . 'px',
                'logo_left'       => input("logo_left", '60') . 'px',
                'logo_top'        => input("logo_top", '200') . 'px',
                'code_left'       => input("code_left", '70') . 'px',
                'code_top'        => input("code_top", '300') . 'px',
            );

            $result = $qrcode_model->editQrcode($data, $condition);
            return $result;
        } else {
            $info_result = $qrcode_model->getQrcodeInfo($condition);
            $info        = $info_result["data"];
            $this->assign("info", $info);
            return $this->fetch('wechat/edit_qrcode', [], $this->replace);
        }
    }

    /**
     * 设置默认推广二维码
     */
    public function qrcodeDefault()
    {
        if (request()->isAjax()) {
            $id           = input('id', 0);
            $qrcode_model = new Qrcode();
            $result       = $qrcode_model->modifyQrcodeDefault(['id' => $id]);
            return $result;
        }
    }

    /**
     * 删除默认推广二维码
     */
    public function deleteQrcode()
    {
        if (request()->isAjax()) {
            $id           = input('id', 0);
            $qrcode_model = new Qrcode();
            $result       = $qrcode_model->deleteQrcode(['id' => $id]);
            return $result;
        }
    }

    /**
     * 群发消息
     */
    public function mass()
    {
        return $this->fetch('wechat/mass', [], $this->replace);
    }

    /**
     * 分享内容设置
     */
    public function share()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            $qrcode_param_1 = input('qrcode_param_1', '');
            $qrcode_param_2 = input('qrcode_param_2', '');
            $goods_param_1  = input('goods_param_1', '');
            $goods_param_2  = input('goods_param_2', '');
            $shop_param_1   = input('shop_param_1', '');
            $shop_param_2   = input('shop_param_2', '');
            $shop_param_3   = input('shop_param_3', '');

            $data = array(
                'qrcode_param_1' => $qrcode_param_1,
                'qrcode_param_2' => $qrcode_param_2,
                'goods_param_1'  => $goods_param_1,
                'goods_param_2'  => $goods_param_2,
                'shop_param_1'   => $shop_param_1,
                'shop_param_2'   => $shop_param_2,
                'shop_param_3'   => $shop_param_3,
            );

            $res = $config_model->setShareConfig($data, 1, $this->site_id);
            return $res;
        } else {
            $config_result = $config_model->getShareConfig($this->site_id);
            $this->assign("info", $config_result["data"]['value']);
            return $this->fetch('wechat/share', [], $this->replace);
        }
    }

    /**
     * 访问统计
     */
    public function stat()
    {
        return $this->fetch('wechat/stat', [], $this->replace);
    }


    /**
     * 公众号设置
     */
    public function configSetting()
    {
        $config_model  = new ConfigModel();
        $config_result = $config_model->getWechatConfig($this->site_id);
        $config        = $config_result["data"];
        if (!empty($config["value"])) {
            //是否是开放平台授权
            $is_authopen = $config_result['data']['value']['is_authopen'] ?? 0;
            if ($is_authopen > 0) {
                $this->redirect(addon_url("wxoplatform://shop/oplatform/wechat"));
            } else {
                $this->redirect(addon_url("wechat://shop/wechat/config"));
            }
        } else {
            $this->redirect(addon_url("wxoplatform://shop/oplatform/wechatsettled"));
        }

    }

}