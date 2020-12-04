<?php

namespace app\component\controller;

/**
 * 图片广告·组件
 */
class ImageAds extends BaseDiyView
{
    /**
     * 后台编辑界面
     */
    public function design()
    {
        return $this->fetch("image_ads/design.html");
    }
}