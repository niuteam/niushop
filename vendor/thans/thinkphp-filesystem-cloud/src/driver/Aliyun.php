<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace thans\filesystem\driver;

use League\Flysystem\AdapterInterface;
use thans\filesystem\traits\Storage;
use think\filesystem\Driver;
use Xxtime\Flysystem\Aliyun\OssAdapter;

class Aliyun extends Driver
{
    use Storage;

    protected function createAdapter(): AdapterInterface
    {
        $aliyun = new OssAdapter([
            'accessId'     => $this->config['accessId'],
            'accessSecret' => $this->config['accessSecret'],
            'bucket'       => $this->config['bucket'],
            'endpoint'     => $this->config['endpoint'],
        ]);

        return $aliyun;
    }
}
