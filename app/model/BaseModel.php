<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model;

use \think\facade\Cache;

/**
 * 基础model
 * @author Administrator
 *
 */
class BaseModel
{
    public $lang;

    public function __construct()
    {
    }

    /**
     * 操作成功返回值函数
     * @param string $data
     * @param string $code_var
     * @return array
     */
    public function success($data = '', $code_var = 'SUCCESS')
    {
        $lang_array = $this->getLang();
        $lang_var   = isset($lang_array[$code_var]) ? $lang_array[$code_var] : $code_var;

        if ($code_var == 'SUCCESS') {
            $code_var = 0;
        } else {
            $code_array = array_keys($lang_array);
            $code_index = array_search($code_var, $code_array);
            if ($code_index != false) {
                $code_var = 10000 + $code_index;
            }
        }

        return success($code_var, $lang_var, $data);
    }

    /**
     * 操作失败返回值函数
     * @param string $data
     * @param string $code_var
     * @return array
     */
    public function error($data = '', $code_var = 'FAIL')
    {

        $lang_array = $this->getLang();

        if (isset($lang_array[$code_var])) {
            $lang_var = $lang_array[$code_var];
        } else {
            $lang_var = $code_var;
            $code_var = 'FAIL';
        }
        $code_array = array_keys($lang_array);
        $code_index = array_search($code_var, $code_array);
        if ($code_index != false) {
            $code_var = -10000 - $code_index;
        }
        return error($code_var, $lang_var, $data);
    }

    /**
     * 获取语言包数组
     * @return Ambigous <multitype:, unknown>
     */
    public function getLang()
    {
        $default_lang = config("lang.default_lang");
        $cache_common = Cache::get("lang_app/lang/" . $default_lang . '/model.php');
        if (empty($cache_common)) {
            $cache_common = include 'app/lang/' . $default_lang . '/model.php';
            Cache::tag("lang")->set("lang_app/lang/" . $default_lang, $cache_common);
        }
        $lang_path = isset($this->lang) ? $this->lang : '';
        if (!empty($lang_path)) {
            $cache_path = Cache::get("lang_" . $lang_path . "/" . $default_lang . '/model.php');
            if (empty($cache_path)) {
                $cache_path = include $lang_path . "/" . $default_lang . '/model.php';
                Cache::tag("lang")->set("lang_" . $lang_path . "/" . $default_lang, $cache_path);
            }
            $lang = array_merge($cache_common, $cache_path);
        } else {
            $lang = $cache_common;
        }
        return $lang;

    }


}