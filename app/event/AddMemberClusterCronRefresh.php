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

namespace app\event;

use app\model\member\MemberCluster as MemberClusterModel;

/**
 * 初始化添加会员群体定时刷新事件
 */
class AddMemberClusterCronRefresh
{
    // 行为扩展的执行入口必须是run
    public function handle()
    {
        $member_cluster_model = new MemberClusterModel();
        $result = $member_cluster_model->addMemberClusterCronRefresh();
        return $result;
    }
}