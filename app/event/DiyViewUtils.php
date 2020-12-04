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

/**
 * 自定义模板组件渲染
 */
class DiyViewUtils
{
    // 行为扩展的执行入口必须是run
    public function handle($data)
    {
        $port = ['app', 'addon'];
        if (!empty($data['controller'])) {
            $class_name = '';
            $is_exist   = false;
            foreach ($port as $k => $v) {
                if (!empty($data['addon_name'])) {
                    $class_name = $v . '\\' . $data['addon_name'] . '\\component\\controller\\' . $data['controller'];
                } else {
                    $class_name = $v . '\\component\\controller\\' . $data['controller'];
                }
                if (class_exists($class_name)) {
                    $is_exist = true;
                    break;
                }
            }
            if ($is_exist) {
                $class    = new \ReflectionClass($class_name);
                $instance = $class->newInstanceArgs();
                return $instance->design();
            } else {
                var_dump("not found：" . $class_name);
            }

        }
    }

}