
<h1><p align="center">thinkphp-filesystem-cloud</p></h1>
<p align="center"> thinkphp6.0 的文件系统扩展包，支持上传阿里云OSS和七牛和腾讯云COS</p>

## 包含

1. php >= 7.1
2. thinkphp >=6.0.0

## 支持

1. 阿里云
2. 七牛云
3. 腾讯云

## 计划
1. 支持华为云

## 安装
第一步：
```shell
$ composer require thans/thinkphp-filesystem-cloud
```
第二步：
在config/filesystem.php中添加配置

```
'aliyun' => [
    'type'         => 'aliyun',
    'accessId'     => '******',
    'accessSecret' => '******',
    'bucket'       => 'bucket',
    'endpoint'     => 'oss-cn-hongkong.aliyuncs.com',
    'url'          => 'http://oss-cn-hongkong.aliyuncs.com',//不要斜杠结尾，此处为URL地址域名。
],
'qiniu'  => [
    'type'      => 'qiniu',
    'accessKey' => '******',
    'secretKey' => '******',
    'bucket'    => 'bucket',
    'url'       => '',//不要斜杠结尾，此处为URL地址域名。
],
'qcloud' => [
    'type'       => 'qcloud',
    'region'      => '***',
    'appId'      => '***', // 域名中数字部分
    'secretId'   => '***',
    'secretKey'  => '***',
    'bucket'          => '***',
    'timeout'         => 60,
    'connect_timeout' => 60,
    'cdn'             => '您的 CDN 域名',
    'scheme'          => 'https',
    'read_from_cdn'   => false,
]
```
## 授权

MIT

## 感谢
1. thinkphp
2. xxtime/flysystem-aliyun-oss
3. liz/flysystem-qiniu
4. league/flysystem
5. overtrue/flysystem-cos
