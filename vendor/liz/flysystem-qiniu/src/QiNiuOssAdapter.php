<?php

namespace Liz\Flysystem\QiNiu;

use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;
use Liz\Flysystem\QiNiu\Plugins\VFrameHelpers\AbstractVFramePolicy;
use Qiniu\Auth;
use function Qiniu\base64_urlSafeEncode;
use Qiniu\Http\Client;
use Qiniu\Http\Error;
use Qiniu\Processing\PersistentFop;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiNiuOssAdapter extends AbstractAdapter
{
    private $client;
    private $auth;
    private $bucket;
    private $host;

    private $bucketManager;
    private $uploadManager;
    private $fopManager;

    /**
     * @return string
     */
    protected function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * QiNiuOssAdapter constructor.
     *
     * @param string $cdnHost
     * @param string $bucket
     * @param string $accessKey
     * @param string $secretKey
     */
    public function __construct($accessKey, $secretKey, $bucket, $cdnHost)
    {
        $this->makeHost($cdnHost);
        $this->auth = new Auth($accessKey, $secretKey);
        $this->bucket = $bucket;
        $this->client = new Client();
    }

    public function getAuth(){
        return $this->auth;
    }

    public function verifyUploadCallback($contentType, $authorization, $url, $callbackBody){
        return $this->auth->verifyCallback($contentType, $authorization, $url, $callbackBody);
    }

    /**
     * @param $pathname 保存路径 path/to/filename.ext
     * @param int $expires token时限
     * @param array $policy 上传策略，关联数组 https://developer.qiniu.com/kodo/manual/1206/put-policy
     * @return string
     */
    public function getUploadToken($pathname, $expires = 3600, array $policy = []){
        if (!$policy){
            $policy = null;
        }
        $uploadToken = $this->auth->uploadToken($this->bucket, $pathname, $expires, $policy, false);
        return $uploadToken;
    }

    /**
     * @param string $path
     * @param string $contents
     * @param Config $config
     *
     * @return array|false
     *
     * @throws QiNiuOssAdapterException
     */
    public function write($path, $contents, Config $config)
    {
        $uploadToken = $this->auth->uploadToken($this->bucket);
        $response = $this->getUploadManager()->put($uploadToken, $path, $contents);
        $this->ossResponse($response);

        return $this->mapFileInfo($path, true, ['contents' => $contents]);
    }

    /**
     * @param string   $path
     * @param resource $resource
     * @param Config   $config
     *
     * @return array|false
     *
     * @throws QiNiuOssAdapterException
     */
    public function writeStream($path, $resource, Config $config)
    {
        return $this->write($path, stream_get_contents($resource), $config);
    }

    /**
     * @param string $path
     * @param string $contents
     * @param Config $config
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function update($path, $contents, Config $config)
    {
        $uploadToken = $this->auth->uploadToken($this->bucket, $path);
        $response = $this->getUploadManager()->put($uploadToken, $path, $contents);
        $this->ossResponse($response);
        return $this->mapFileInfo($path);
    }

    /**
     * @param string   $path
     * @param resource $resource
     * @param Config   $config
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function updateStream($path, $resource, Config $config)
    {
        return $this->update($path, stream_get_contents($resource), $config);
    }

    /**
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function rename($path, $newpath)
    {
        $error = $this->getBucketManager()->rename($this->bucket, $path, $newpath);
        $this->createExceptionIfError($error);
        return !$error;
    }

    /**
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function copy($path, $newpath)
    {
        $error = $this->getBucketManager()->copy($this->bucket, $path, $this->bucket, $newpath);
        $this->createExceptionIfError($error);
        return !$error;
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function delete($path)
    {
        $response = $this->getBucketManager()->delete($this->bucket, $path);
        return !$response;
    }

    /**
     * @param string $dirname
     *
     * @return bool
     */
    public function deleteDir($dirname)
    {
        return true;
    }

    /**
     * @param string $dirname
     * @param Config $config
     *
     * @return array|false
     *
     * @throws QiNiuOssAdapterException
     */
    public function createDir($dirname, Config $config)
    {
        $this->write($dirname.'/.init', 'hello world', $config);
        return $this->mapDirInfo($dirname);
    }

    /**
     * @param string $path
     * @param string $visibility
     *
     * @return array|false|void
     */
    public function setVisibility($path, $visibility)
    {
        // TODO: Implement setVisibility() method.  七牛云没有此功能，只能对整个bucket设置私有或公共
    }

    /**
     * @param string $path
     *
     * @return array|bool|null
     */
    public function has($path)
    {
        $response = $this->getBucketManager()->stat($this->bucket, $path);
        return !$response[1];
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function read($path)
    {
        $response = $this->getBucketManager()->stat($this->bucket, $path);
        $this->ossResponse($response);
        $path = $this->urlEncode($path);
        $privateUrl = $this->privateDownloadUrl($path);
        $result = $this->mapFileInfo($path, false, [
            'contents' => file_get_contents($privateUrl),
        ]);
        return $result;
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function readStream($path)
    {
        $path = $this->urlEncode($path);
        $url = $path;
        if (!stripos($path, 'token')){
            $url = $this->privateDownloadUrl($this->host.$path);
        }
        $stream = fopen($url, 'rb');
        return $this->mapFileInfo($path, false, ['stream' => $stream]);
    }

    /**
     * @param string $directory
     * @param bool   $recursive
     *
     * @return array
     *
     * @throws QiNiuOssAdapterException
     */
    public function listContents($directory = '', $recursive = false)
    {
        $directory = $recursive ? '' : $directory;
        $response = $this->getBucketManager()->listFiles($this->getBucket(), $directory);
        $this->ossResponse($response);
        $getDir = function ($path, $currentDir) {
            $tmp = strtr($path, [
                $currentDir.'/' => '',
            ]);
            return substr($tmp, 0, stripos($tmp, '/'));
        };
        $files = $response['items'] ?: [];
        $results = [];
        foreach ($files as $file) {
            $dir = $getDir($file['key'], $directory);
            if ($dir) {
                $result = $this->mapDirInfo($directory.'/'.$dir);
            } else {
                $result = $this->mapFileInfo($file['key'], false, [
                    'timestamp' => (int) ceil($file['putTime'] / 1000 / 10000),
                    'size' => $file['fsize'],
                ]);
            }
            $results[] = $result;
        }
        $results = array_unique($results, SORT_REGULAR);
        return $results;
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function getMetadata($path)
    {
        return $this->mapFileInfo($path, true);
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function getSize($path)
    {
        return $this->getMetadata($path);
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function getMimetype($path)
    {
        return $this->getMetadata($path);
    }

    /**
     * @param string $path
     *
     * @return array|false|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    public function getTimestamp($path)
    {
        return $this->getMetadata($path);
    }

    /**
     * @param string $path
     *
     * @return array|false|void
     */
    public function getVisibility($path)
    {
        // TODO: Implement getVisibility() method. 七牛云没有此功能
    }

    /**
     * @param $path 待转码文件路径
     * @param $rules 转码规则[转码规则说明](https://developer.qiniu.com/kodo/kb/5858/the-instructions-on-the-storage-space-of-transcoding-style)
     * @param null $pipeline  队列名称,若不填写使用TransCoder初始化的pipeline https://portal.qiniu.com/dora/mps/new
     * @param null $notifyUrl 处理完毕通知地址,若不填写使用TransCoder初始化的bucket
     * @param null $saveAs    保存全部路径，若不填写则为$path的名称加_trans
     * @param null $bucket    处理完成保存到bucket，若不填写则使用TransCoder初始化的bucket
     *
     * @return array|string
     *
     * @throws QiNiuOssAdapterException
     */
    public function transCoding($path, $rules, $saveAs = null, $notifyUrl = null, $pipeline = null, $toBucket = null)
    {
        $dir = '';
        $filename = $path;
        $position = strripos($path, '/');
        if (false !== $position) {
            $dir = substr($path, 0, $position + 1);
            $filename = substr(strrchr($path, '/'), 1);
        }
        if (!$saveAs) {
            list($name, $ext) = explode('.', $filename);
            $saveAs = $dir.$name.'_trans.'.$ext;
        }
        $toBucket = $toBucket ?: $this->bucket;
        $fops = $this->buildTransCodeFop($rules, $toBucket, $saveAs);

        $response = $this->getFopManager()->execute($this->bucket, $path, $fops, $pipeline, $notifyUrl);
        $this->ossResponse($response);

        return $response;
    }

    public function vframe($path, AbstractVFramePolicy $policy){
        $rules = sprintf('vframe/%s/offset/%d/w/%d/h/%d/rotate/%s',
            $policy->getFormat(),
            $policy->getOffset(),
            $policy->getWidth(),
            $policy->getHeight(),
            $policy->getRotate()
        );
        $response = $this->getFopManager()->execute($this->bucket, $path, $rules, $policy->getPipeLine(), $policy->getNotifyUrl());
        $this->ossResponse($response);

        return $response;
    }

    /**
     * @param string $baseUrl         请求url
     * @param bool   $isBucketPrivate bucket是否为私有，如果是私有m3u8文件会对相关ts文件进行授权处理(https://developer.qiniu.com/dora/api/1292/private-m3u8-pm3u8)
     * @param int    $expires
     *
     * @return string
     */
    public function privateDownloadUrl($baseUrl, $isBucketPrivate = false, $expires = 3600)
    {
        if (0 !== strpos($baseUrl, 'http')) {
            $baseUrl = $this->host.$baseUrl;
        }

        if ($isBucketPrivate && strstr($baseUrl, 'm3u8')) {
            if (strstr($baseUrl, '?')) {
                $baseUrl .= '&pm3u8/0';
            } else {
                $baseUrl .= '?pm3u8/0';
            }
        }

        return $this->auth->privateDownloadUrl($baseUrl, $expires);
    }

    public function makeBucket($bucket, $region = 'z0'){
        $response = $this->getBucketManager()->createBucket($bucket, $region);
        $this->ossResponse($response);
        return $response;
    }

    public function fetchBucket($bucket){
        $response = $this->getBucketManager()->bucketInfo($bucket);
        $this->ossResponse($response);
        return $response;
    }

    protected function buildTransCodeFop($rules, $toBucket, $saveAs){
        if (0 !== stripos($rules, 'avthumb/')){
            $rules = 'avthumb/'.$rules;
        }
        $fops = "$rules|saveas/".base64_urlSafeEncode($toBucket.":$saveAs");

        return $fops;
    }

    /**
     * @return BucketManager
     */
    protected function getBucketManager()
    {
        if (!$this->bucketManager) {
            $this->bucketManager = new BucketManager($this->auth);
        }
        return $this->bucketManager;
    }

    /**
     * @return UploadManager
     */
    protected function getUploadManager()
    {
        if (!$this->uploadManager) {
            $this->uploadManager = new UploadManager();
        }
        return $this->uploadManager;
    }

    public function getFopManager()
    {
        if (!$this->fopManager) {
            $this->fopManager = new PersistentFop($this->auth);
        }
        return $this->fopManager;
    }

    /**
     * @param Error|null $error
     */
    protected function createExceptionIfError($error = null)
    {
        if ($error instanceof Error) {
            $e = new QiNiuOssAdapterException($error->message(), $error->code());
            throw $e->setResponse($error->getResponse());
        }
    }

    /**
     * @param array $response
     *
     * @throws QiNiuOssAdapterException
     */
    protected function ossResponse(array &$response)
    {
        if ($response[1] instanceof Error) {
            $error = $response['1'];
            $this->createExceptionIfError($error);
        }
        $response = $response[0];
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function urlEncode($path)
    {
        return strtr($path, [
            ' ' => '%20',
        ]);
    }

    /**
     * @param string $path
     * @param array  $normalized
     *
     * @return array
     *
     * @throws QiNiuOssAdapterException
     */
    protected function getFileMeta($path, array $normalized)
    {
        $response = $this->getBucketManager()->stat($this->bucket, $path);
        $this->ossResponse($response);

        $normalized['mimetype'] = $response['mimeType'];
        $normalized['timestamp'] = (int) ceil($response['putTime'] / 1000 / 10000);
        $normalized['size'] = $response['fsize'];
        return $normalized;
    }

    /**
     * @param string $path
     * @param bool   $requireMeta
     * @param array  $options
     *
     * @return array|mixed
     *
     * @throws QiNiuOssAdapterException
     */
    protected function mapFileInfo($path, $requireMeta = false, $options = [])
    {
        $normalized = [
            'type' => 'file',
            'path' => $path,
        ];

        if ($requireMeta) {
            $normalized = $this->getFileMeta($path, $normalized);
        }
        $normalized = array_merge($normalized, $options);

        return $normalized;
    }

    /**
     * @param string $dirname
     *
     * @return array
     */
    protected function mapDirInfo($dirname)
    {
        return ['path' => $dirname, 'type' => 'dir'];
    }

    private function makeHost($cdnHost)
    {
        $host = strripos($cdnHost, '/') + 1 === strlen($cdnHost) ? $cdnHost : $cdnHost.'/';
        $this->host = strtolower($host);
        if (0 !== strpos($this->host, 'http')) {
            $this->host = 'http://'.$this->host;
        }
    }
}
