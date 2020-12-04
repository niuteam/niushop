<?php


namespace Liz\Flysystem\QiNiu\Plugins;


use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;

class AuthGetter extends AbstractPlugin
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
     * @return \Qiniu\Processing\PersistentFop
     */
    public function handle()
    {
        return $this->getFlySystemAdapter()->getFopManager();
    }

}