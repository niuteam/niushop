<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace addon\manjian\shop\controller;

use app\shop\controller\BaseShop;
use addon\manjian\model\Manjian as ManjianModel;
use think\facade\Cache;

/**
 * 满减控制器
 */
class Manjian extends BaseShop
{
    protected $replace = [];    //视图输出字符串内容替换    相当于配置文件中的'view_replace_str'

    public function __construct()
    {
        parent::__construct();
        $this->replace = [
            'MANJIAN_IMG' => __ROOT__ . '/addon/manjian/shop/view/public/img',
            'MANJIAN_JS'  => __ROOT__ . '/addon/manjian/shop/view/public/js',
            'MANJIAN_CSS' => __ROOT__ . '/addon/manjian/shop/view/public/css',
        ];
    }

    /**
     * 满减列表
     */
    public function lists()
    {
        if (request()->isAjax()) {
            $page         = input('page', 1);
            $page_size    = input('page_size', PAGE_LIST_ROWS);
            $manjian_name = input('manjian_name', '');
            $status       = input('status', '');
            $condition    = [];
            $condition[]  = ['site_id', '=', $this->site_id];
            $condition[]  = ['manjian_name', 'like', '%' . $manjian_name . '%'];
            if ($status != null) {
                $condition[] = ['status', '=', $status];
            }
            $order = 'create_time desc';
            $field = 'manjian_id,manjian_name,start_time,end_time,create_time,status';

            $manjian_model = new ManjianModel();
            $res           = $manjian_model->getManjianPageList($condition, $page, $page_size, $order, $field);

            //获取状态名称
            $manjian_status_arr = $manjian_model->getManjianStatus();
            foreach ($res['data']['list'] as $key => $val) {
                $res['data']['list'][$key]['status_name'] = $manjian_status_arr[$val['status']];
            }
            return $res;

        } else {
            //满减状态
            $manjian_model      = new ManjianModel();
            $manjian_status_arr = $manjian_model->getManjianStatus();
            $this->assign('manjian_status_arr', $manjian_status_arr);

            return $this->fetch("manjian/lists");
        }
    }

    /**
     * 满减添加
     */
    public function add()
    {
        if (request()->isAjax()) {

            $data = [
                'site_id'      => $this->site_id,
                'manjian_name' => input('manjian_name', ''),
                'manjian_type' => input('manjian_type', ''),
                'type'         => input('type', 0),
                'goods_ids'    => input('goods_ids', ''),
                'start_time'   => strtotime(input('start_time', '')),
                'end_time'     => strtotime(input('end_time', '')),
                'rule_json'    => input('rule_json', ''),
                'remark'       => input('remark', '')
            ];

            $manjian_model = new ManjianModel();
            return $manjian_model->addManjian($data);
        } else {
            return $this->fetch("manjian/add", [], $this->replace);
        }
    }

    /**
     * 满减编辑
     */
    public function edit()
    {
        $manjian_model = new ManjianModel();
        if (request()->isAjax()) {

            $data = [
                'manjian_id'   => input('manjian_id', 0),
                'site_id'      => $this->site_id,
                'manjian_name' => input('manjian_name', ''),
                'manjian_type' => input('manjian_type', ''),
                'type'         => input('type', 0),
                'goods_ids'    => input('goods_ids', ''),
                'start_time'   => strtotime(input('start_time', '')),
                'end_time'     => strtotime(input('end_time', '')),
                'rule_json'    => input('rule_json', ''),
                'remark'       => input('remark', '')
            ];
            return $manjian_model->editManjian($data);

        } else {

            $manjian_id = input('manjian_id', 0);
            $this->assign('manjian_id', $manjian_id);

            $manjian_info = $manjian_model->getManjianDetail($manjian_id, $this->site_id);

            $this->assign('manjian_info', $manjian_info['data']);

            return $this->fetch("manjian/edit", [], $this->replace);
        }
    }

    /**
     * 满减详情
     */
    public function detail()
    {
        $manjian_id    = input('manjian_id', 0);
        $manjian_model = new ManjianModel();
        $manjian_info  = $manjian_model->getManjianDetail($manjian_id, $this->site_id);

        $this->assign('manjian_info', $manjian_info['data']);
        return $this->fetch('manjian/detail');

    }

    /**
     * 满减关闭
     */
    public function close()
    {
        if (request()->isAjax()) {
            $manjian_id    = input('manjian_id', 0);
            $manjian_model = new ManjianModel();
            return $manjian_model->closeManjian($manjian_id, $this->site_id);
        }
    }

    /**
     * 满减删除
     */
    public function delete()
    {
        if (request()->isAjax()) {
            $manjian_id    = input('manjian_id', 0);
            $manjian_model = new ManjianModel();
            return $manjian_model->deleteManjian($manjian_id, $this->site_id);
        }
    }

    /**
     * 活动冲突商品
     */
    public function conflict()
    {
        $key           = input('key', '');
        $conflict_data = Cache::get($key);
        $this->assign('conflict_data', $conflict_data);
        return $this->fetch('manjian/conflict');
    }
}