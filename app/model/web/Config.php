<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\web;

use app\model\system\Config as ConfigModel;
use app\model\BaseModel;
use app\model\system\Upgrade;

/**
 * 网站系统性设置
 */
class Config extends BaseModel
{
    //缓存类型
    private $cache_list = [
        [
            'name' => '数据缓存',
            'desc' => '数据缓存',
            'key' => 'content',
            'icon' => 'public/static/img/cache/data.png'
        ],
        [
            'name' => '数据表缓存',
            'desc' => '数据表缓存',
            'key' => 'data_table_cache',
            'icon' => 'public/static/img/cache/data_table.png'
        ],
        [
            'name' => '模板缓存',
            'desc' => '模板缓存',
            'key' => 'template_cache',
            'icon' => 'public/static/img/cache/template.png'
        ],
    ];

    /**
     * 验证码设置
     * array $data
     */
    public function setCaptchaConfig($data, $site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '验证码设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'CAPTCHA_CONFIG' ] ]);
        return $res;
    }

    /**
     * 查询验证码设置
     */
    public function getCaptchaConfig($site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'CAPTCHA_CONFIG' ] ]);

        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'shop_login' => 1,
                'shop_reception_login' => 1
            ];
        } else {
            if (isset($res[ 'data' ][ 'value' ][ 'shop_reception_login' ]) === false) {
                $res[ 'data' ][ 'value' ][ 'shop_reception_login' ] = 1;
            }
        }
        return $res;
    }

    /**
     * 默认图上传配置
     * array $data
     */
    public function setDefaultImg($data, $site_id = 0, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '默认图设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'DEFAULT_IMAGE' ] ]);
        return $res;
    }

    /**
     * 默认图查询上传配置
     */
    public function getDefaultImg($site_id, $app_model = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_model ], [ 'config_key', '=', 'DEFAULT_IMAGE' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                "default_goods_img" => "upload/default/default_img/goods.png",
                "default_headimg" => "upload/default/default_img/head.png"
            ];
        }
        return $res;
    }

    /**
     * 获取缓存类型
     */
    public function getCacheList()
    {
        return $this->cache_list;
    }

    public function setCopyright($data, $site_id = 1, $app_model = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '版权设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_model ], [ 'config_key', '=', 'COPYRIGHT' ] ]);
        return $res;
    }

    /**
     * 获取版权信息
     * @return array
     */
    public function getCopyright($site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'COPYRIGHT' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'logo' => '',
                'company_name' => '',
                'copyright_link' => '',
                'copyright_desc' => '',
                'icp' => '',
                'gov_record' => '',
                'gov_url' => '',
                'market_supervision_url' => ''
            ];
        } else {
            $upgrade_model = new Upgrade();
            $auth_info = $upgrade_model->authInfo();
            if (is_null($auth_info) || $auth_info[ 'code' ] != 0) {
                $res[ 'data' ][ 'value' ][ 'logo' ] = '';
                $res[ 'data' ][ 'value' ][ 'company_name' ] = '';
                $res[ 'data' ][ 'value' ][ 'copyright_link' ] = '';
                $res[ 'data' ][ 'value' ][ 'copyright_desc' ] = '';
            }
        }
        return $res;
    }

    /**
     * 授权设置
     * @param $data
     * @param int $site_id
     * @param string $app_model
     * @return array
     */
    public function setAuth($data, $site_id = 1, $app_model = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '授权设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_model ], [ 'config_key', '=', 'AUTH' ] ]);
        return $res;
    }

    /**
     * 获取授权设置
     * @return array
     */
    public function getAuth($site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'AUTH' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'code' => '',
            ];
        }
        return $res;
    }

    /**
     * 地图设置
     * @param $data
     * @param int $site_id
     * @param string $app_model
     * @return array
     */
    public function setMapConfig($data, $site_id = 1, $app_model = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '地图设置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_model ], [ 'config_key', '=', 'MAP_CONFIG' ] ]);
        return $res;
    }

    /**
     * 获取地图设置
     * @return array
     */
    public function getMapConfig($site_id = 1, $app_module = 'shop')
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'MAP_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'tencent_map_key' => '',
            ];
        }
        return $res;
    }

    /**
     * h5域名配置
     */
    public function seth5DomainName($data, $site_id = 1, $app_modle = 'shop')
    {

        $config = new ConfigModel();
        $res = $config->setConfig($data, 'H5域名配置', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_modle ], [ 'config_key', '=', 'H5_DOMAIN_NAME' ] ]);

        return $res;
    }

    /**
     * 获取h5域名配置
     */
    public function geth5DomainName($site_id = 1, $app_module = 'shop')
    {

        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'H5_DOMAIN_NAME' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'domain_name_h5' => ROOT_URL . '/h5',
            ];
        } else {
            if ($res[ 'data' ][ 'value' ][ 'domain_name_h5' ] == '') {
                $res[ 'data' ][ 'value' ] = [
                    'domain_name_h5' => ROOT_URL . '/h5',
                ];
            }
        }
        return $res;
    }

    /**
     * 设置热门搜索关键词
     * @param $data
     * @param $site_id
     * @param $app_module
     * @return array
     */
    public function setHotSearchWords($data, $site_id, $app_module)
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '商品热门搜索关键词', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'GOODS_HOT_SEARCH_WORDS_CONFIG' ] ]);
        return $res;
    }

    /**
     * 获取热门搜索关键词
     * @param $site_id
     * @param $app_module
     * @return array
     */
    public function getHotSearchWords($site_id, $app_module)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'GOODS_HOT_SEARCH_WORDS_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'words' => ''
            ];
        }
        return $res;
    }

    /**
     * 设置默认搜索关键词
     * @param $data
     * @param $site_id
     * @param $app_module
     * @return array
     */
    public function setDefaultSearchWords($data, $site_id, $app_module)
    {
        $config = new ConfigModel();
        $res = $config->setConfig($data, '默认搜索关键词', 1, [ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'GOODS_DEFAULT_SEARCH_WORDS_CONFIG' ] ]);
        return $res;
    }

    /**
     * 获取默认搜索关键词
     * @param $site_id
     * @param $app_module
     * @return array
     */
    public function getDefaultSearchWords($site_id, $app_module)
    {
        $config = new ConfigModel();
        $res = $config->getConfig([ [ 'site_id', '=', $site_id ], [ 'app_module', '=', $app_module ], [ 'config_key', '=', 'GOODS_DEFAULT_SEARCH_WORDS_CONFIG' ] ]);
        if (empty($res[ 'data' ][ 'value' ])) {
            $res[ 'data' ][ 'value' ] = [
                'words' => '搜索 商品'
            ];
        }
        return $res;
    }

}