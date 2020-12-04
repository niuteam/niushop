## Aliyun OSS Adapter For Flysystem.


[![Latest Stable Version](https://poser.pugx.org/xxtime/flysystem-aliyun-oss/v/stable)](https://packagist.org/packages/xxtime/flysystem-aliyun-oss)
[![Build Status](https://travis-ci.org/xxtime/flysystem-aliyun-oss.svg?branch=master)](https://travis-ci.org/xxtime/flysystem-aliyun-oss)
[![Total Downloads](https://poser.pugx.org/xxtime/flysystem-aliyun-oss/downloads)](https://packagist.org/packages/xxtime/flysystem-aliyun-oss)
[![License](https://poser.pugx.org/xxtime/flysystem-aliyun-oss/license)](https://packagist.org/packages/xxtime/flysystem-aliyun-oss)
[![Author](http://img.shields.io/badge/author-Joe-blue.svg?style=flat-square)](https://www.xxtime.com)
[![Code Climate](https://codeclimate.com/github/xxtime/flysystem-aliyun-oss/badges/gpa.svg)](https://codeclimate.com/github/xxtime/flysystem-aliyun-oss)


AliYun OSS Storage adapter for flysystem - a PHP filesystem abstraction. 

## Installation
composer require xxtime/flysystem-aliyun-oss

## Logs
##### 1.3.0 
 1. some args name changed  
 2. default region oss-cn-hangzhou  


## Usage

```php
use League\Flysystem\Filesystem;
use Xxtime\Flysystem\Aliyun\OssAdapter;

$aliyun = new OssAdapter([
    'accessId'       => '<aliyun access id>',
    'accessSecret'   => '<aliyun access secret>',
    'bucket'         => '<bucket name>',
    'endpoint'       => '<endpoint address>',
    // 'timeout'        => 3600,
    // 'connectTimeout' => 10,
    // 'isCName'        => false,
    // 'token'          => '',
]);
$filesystem = new Filesystem($aliyun);


// Write Files
$filesystem->write('path/to/file.txt', 'contents');
// get RAW data from aliYun OSS
$raw = $aliyun->supports->getFlashData();

// Write Use writeStream
$stream = fopen('local/path/to/file.txt', 'r+');
$result = $filesystem->writeStream('path/to/file.txt', $stream);
if (is_resource($stream)) {
    fclose($stream);
}

// Update Files
$filesystem->update('path/to/file.txt', 'new contents');

// Check if a file exists
$exists = $filesystem->has('path/to/file.txt');

// Read Files
$contents = $filesystem->read('path/to/file.txt');

// Delete Files
$filesystem->delete('path/to/file.txt');

// Rename Files
$filesystem->rename('filename.txt', 'newname.txt');

// Copy Files
$filesystem->copy('filename.txt', 'duplicate.txt');


// list the contents (not support recursive now)
$filesystem->listContents('path', false);
```
```php
// 说明：此方法返回从阿里云接口返回的原生数据，仅可调用一次
// DESC: this function return AliYun RAW data
$raw = $aliyun->supports->getFlashData();
```

## Document
 1. [Region And Endpoint Table](https://help.aliyun.com/document_detail/31837.html)  
 2. [Aliyun OSS PHP SDK Document](https://help.aliyun.com/document_detail/85580.html)  


## Reference
[http://flysystem.thephpleague.com/api/](http://flysystem.thephpleague.com/api/)  
[https://github.com/thephpleague/flysystem](https://github.com/thephpleague/flysystem)  
  

