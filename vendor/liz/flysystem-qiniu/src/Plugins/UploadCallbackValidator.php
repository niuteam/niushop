<?php


namespace Liz\Flysystem\QiNiu\Plugins;


use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;

class UploadCallbackValidator extends AbstractPlugin
{
    public function getMethod()
    {
        return 'verifyUploadCallback';
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }

    /**
     * @param $contentType
     * @param $authorization
     * @param $url
     * @param $callbackBody
     * @return bool
     */
    public function handle($contentType, $authorization, $url, $callbackBody)
    {
        return $this->getFlySystemAdapter()->verifyUploadCallback($contentType, $authorization, $url, $callbackBody);
    }

}