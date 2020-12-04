## QiNiu OSS(七牛云对象存储) Adapter For Flysystem.
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Flysystem 适配器： [七牛云](https://www.qiniu.com/)

## Installation
composer require liz/flysystem-qiniu

## Usage
```php

require 'vendor/autoload.php';


use League\Flysystem\Filesystem;
use Liz\Flysystem\QiNiu\Plugins\PrivateDownloadUrlMaker;
use Liz\Flysystem\QiNiu\Plugins\TransCoder;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;
use Liz\Flysystem\QiNiu\QiNiuOssAdapterException;

# cdn [外链默认域名须英文](https://developer.qiniu.com/kodo/kb/5158/how-to-transition-from-test-domain-name-to-a-custom-domain-name)
$cdnHost = 'cdn.host.com';
# bucket [七牛对象存储空间列表](https://portal.qiniu.com/bucket)
$bucket = 'bucket';
# $accessKey [用户密钥](https://portal.qiniu.com/user/key)
$accessKey = 'access-key';
$secretKey = 'secret-key';

$flysystem = new Filesystem(new QiNiuOssAdapter($accessKey, $secretKey, $bucket, $cdnHost));
try {

// 创建文件夹
    $result = $flysystem->createDir('path/dir');
var_dump($result);
// 删除文件夹
    $result = $flysystem->deleteDir('path/dir');
var_dump($result);
// has file
    $isExist = $flysystem->has('path/file.txt');
// write file
    if (!$isExist){
        $result = $flysystem->write('path/file.txt', 'contents');
        var_dump($result);
    }

// write stream
    if (!$flysystem->has('path/filename.txt')){
        $stream = fopen('.gitignore', 'r+');
        $result = $flysystem->writeStream('path/file name.txt', $stream);
        var_dump($result);
        $result = $flysystem->read('path/file name.txt');
        var_dump($result);
    }

// update file
    $result = $flysystem->update('path/file.txt', 'new contents');
var_dump($result);
// read file
    $result = $flysystem->read('path/file.txt');
var_dump($result);
// rename files
    if(!$flysystem->has('path/newname.txt')){
        $result = $flysystem->rename('path/file name.txt', 'path/newname.txt');
        var_dump($result);
    }

// copy files
    if (!$flysystem->has('path/file_copy.txt')){
        $result = $flysystem->copy('path/file.txt', 'path/file_copy.txt');
    }

// list the contents
    $result = $flysystem->listContents('path', false);
    var_dump($result);
// delete file
    $result = $flysystem->delete('path/file.txt');
var_dump($result);
// 转码
    /**
     * @var $flysystem Filesystem|QiNiuOssAdapter
     */
    $flysystem = new Filesystem(new QiNiuOssAdapter($accessKey, $secretKey, $bucket, $cdnHost));

    /**
     * TransCoder constructor.
     * @param null $notifyUrl 处理完毕默认通知地址
     * @param null $pipeLine 默认队列名称 https://portal.qiniu.com/dora/mps/new
     * @param null $toBucket 处理完成默认保存到的bucket
     * @param null $wmImage 水印图片地址
     */
    $flysystem->addPlugin(new TransCoder('notify_url', 'pipeline', 'toBucket', 'wmImage')); //设置转码默认选项

    // 转码样式说明 https://developer.qiniu.com/kodo/kb/5858/the-instructions-on-the-storage-space-of-transcoding-style
    $rules = 'm3u8/segtime/10/ab/128k/ar/44100/acodec/libfaac/r/30/vb/640k/vcodec/libx264/stripmeta/0/noDomain/1';

    /**
     * @param $path 待转码文件路径
     * @param $rules 转码规则[转码规则说明](https://developer.qiniu.com/kodo/kb/5858/the-instructions-on-the-storage-space-of-transcoding-style)
     * @param null $pipeline 队列名称,若不填写使用TransCoder初始化的pipeline https://portal.qiniu.com/dora/mps/new
     * @param null $notifyUrl 处理完毕通知地址,若不填写使用TransCoder初始化的bucket
     * @param null $saveAs 保存全部路径，若不填写则为$path的名称加_trans
     * @param null $bucket 处理完成保存到bucket，若不填写则使用TransCoder初始化的bucket
     *
     * @return array
     *
     * @throws QiNiuOssAdapterException
     */
    $result = $flysystem->transCoding('xxw-community/a.mp4', $rules,  'xxw-community/a.m3u8', 'notify_url', 'first', 'to_bucket');
    var_dump($result);

//获取私有下载地址
    $flysystem->addPlugin(new PrivateDownloadUrlMaker());
    /**
     * @param string $baseUrl 请求url
     * @param bool $isBucketPrivate bucket是否为私有，如果是私有m3u8文件会对相关ts文件进行授权处理(https://developer.qiniu.com/dora/api/1292/private-m3u8-pm3u8)
     * @param int $expires
     * @return string
     */
    $url = $flysystem->privateDownloadUrl('xxw-community/a.m3u8', true);
    var_dump($url);

//获取上传token
    $flysystem->addPlugin(new UploadTokenMaker());
    $token = $flysystem->getUploadToken('upload/token/file.txt');
    var_dump($token);

}catch (Exception $exception){
    echo "<pre>";
    var_dump($exception);
}
```

## Notice
`getVisibility()`,`setVisibility()`七牛云没有提供相关操作，只能对整个bucket进行私有或公共访问的操作