<?php

namespace app\component\controller;

/**
 * 魔方·组件
 */
class RubikCube extends BaseDiyView
{

    /**
     * 前台输出
     */
    public function parseHtml($attr)
    {
        if (!empty($attr['diyHtml'])) {
            $attr['diyHtml'] = str_replace("&quot;", '"', $attr['diyHtml']);
        }
        $this->assign("attr", $attr);
        return $this->fetch('rubik_cube/rubik_cube.html');
    }

    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("rubik_cube/design.html");
    }
}