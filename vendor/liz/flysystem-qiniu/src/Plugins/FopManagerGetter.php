<?php


namespace Liz\Flysystem\QiNiu\Plugins;


use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;
use Qiniu\Auth;

class FopManagerGetter extends AbstractPlugin
{
    public function getMethod()
    {
        return 'getAuth';
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }

    /**
     * @return Auth
     */
    public function handle()
    {
        return $this->getFlySystemAdapter()->getAuth();
    }

}