<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/27
 * Time: 上午11:31.
 */

namespace Liz\Flysystem\QiNiu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;

/**
 * Class PrivateDownloadUrlMaker.
 *
 * @method string privateDownloadUrl(获取私有文件的地址 $baseUrl, bucket是否私有 $isBucketPrivate = false, 访问超时时间 $expires = 3600)
 */
class PrivateDownloadUrlMaker extends AbstractPlugin
{
    public function getMethod()
    {
        return 'privateDownloadUrl';
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }

    /**
     * @param $baseUrl
     * @param bool $isBucketPrivate
     * @param int  $expires
     *
     * @return string
     */
    public function handle($baseUrl, $isBucketPrivate = false, $expires = 3600)
    {
        return $this->getFlySystemAdapter()->privateDownloadUrl($baseUrl, $isBucketPrivate, $expires);
    }
}
