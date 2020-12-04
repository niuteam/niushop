<?php


namespace Liz\Flysystem\QiNiu\Plugins;


use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\Plugins\VFrameHelpers\AbstractVFramePolicy;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;

class VFrameCutter extends AbstractPlugin
{

    public function getMethod()
    {
        return 'vframe';
    }

    public function handle($path, AbstractVFramePolicy $policy){
        $this->getFlySystemAdapter()->vframe($path, $policy);
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }


}