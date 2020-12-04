<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/27
 * Time: 上午11:31.
 */

namespace Liz\Flysystem\QiNiu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\Plugins\TransCoderHelpers\AbstractTransCoderPolicy;
use Liz\Flysystem\QiNiu\Plugins\UploadTokenMakerHelpers\AbstractUploadPolicy;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;

/**
 * Class PrivateDownloadUrlMaker.
 *
 * @method string getUploadToken($pathname, $expires = 3600, array $policy = [])
 */
class UploadTokenMaker extends AbstractPlugin
{

    /**
     * @var AbstractUploadPolicy
     */
    private $uploadPolicy;

    public function setDefaultPolicy(AbstractUploadPolicy $uploadPolicy){
        $this->uploadPolicy = $uploadPolicy;
    }

    public function getMethod()
    {
        return 'getUploadToken';
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }

    /**
     * @param $pathname
     * @param int $expires
     * @param array $policy
     * @return string
     */
    public function handle($pathname, $expires = 3600, array $policy = [])
    {
        $policy = $this->generatePolicy($policy);
        return $this->getFlySystemAdapter()->getUploadToken($pathname, $expires, $policy);
    }

    private function generatePolicy(array $policy)
    {

        if (!$this->uploadPolicy){
            return $policy;
        }

        if (!isset($policy['callbackUrl'])){
            $urls = $this->uploadPolicy->getCallbackUrls();
            $urlsString = implode(";", $urls);
            $policy['callbackUrl'] = $urlsString;
        }
        if (!isset($policy['callbackBody'])){
            $policy['callbackBody'] = $this->uploadPolicy->getCallbackBody();
        }
        if (!isset($policy['callbackBodyType'])){
            $policy['callbackBodyType'] = $this->uploadPolicy->getCallbackBodyType();
        }
        if ($this->uploadPolicy->getTransCoderPolicy()){
            $transCoderPolicy = $this->uploadPolicy->getTransCoderPolicy();
            $policy['persistentOps'] = $transCoderPolicy->getUploadPersistentOps();
            $policy['persistentNotifyUrl'] = $transCoderPolicy->getNotifyUrl();
            $policy['persistentPipeline'] = $transCoderPolicy->getPipeLine();
        }

        return $policy;
    }
}
