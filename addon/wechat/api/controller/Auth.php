<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\wechat\api\controller;

use addon\wechat\model\Material as MaterialModel;
use addon\wechat\model\Wechat as WechatModel;
use app\Controller;
use think\facade\Log;

class Auth extends Controller
{

    public $wechat;
    public $config;

    public function __construct()
    {
        parent::__construct();
        $site_id      = request()->siteid();
        $this->wechat = new WechatModel($site_id);
    }


    /**
     * ************************************************************************微信公众号消息相关方法 开始******************************************************
     */

    /**
     * 关联公众号微信unserialize
     */
    public function relateWeixin()
    {
        Log::write('微信公众号消息');
        $this->wechat->app = $this->wechat->app();
        $this->wechat->relateWeixin();

    }

    /**
     * ************************************************************************微信公众号消息相关方法 结束******************************************************
     */

    /**
     * 关联公众号微信unserialize
     */
    public function wechatArticle()
    {
        $id             = input('id', '');
        $index          = input('i', 0);
        $material_model = new MaterialModel();
        $info           = $material_model->getMaterialInfo(['id' => $id]);
        if (!empty($info['data']['value']) && json_decode($info['data']['value'], true)) {
            $info['data']['value'] = json_decode($info['data']['value'], true);
        }
        $this->assign('info', $info['data']);
        $this->assign('index', $index);
        $replace = [
            'WECHAT_CSS' => __ROOT__ . '/addon/wechat/admin/view/public/css',
            'WECHAT_JS'  => __ROOT__ . '/addon/wechat/admin/view/public/js',
            'WECHAT_IMG' => __ROOT__ . '/addon/wechat/admin/view/public/img',
        ];
        return $this->fetch('wechat/article', [], $replace);
    }

}