<?php

declare(strict_types=1);

namespace thans\filesystem\driver;

use League\Flysystem\AdapterInterface;
use Overtrue\Flysystem\Cos\CosAdapter;
use thans\filesystem\traits\Storage;
use think\filesystem\Driver;

class Qcloud extends Driver
{
    use Storage;

    protected function createAdapter(): AdapterInterface
    {
        $config = [
            'region'      => $this->config['region'],
            'credentials' => [
                'appId'      => $this->config['appId'], // 域名中数字部分
                'secretId'   => $this->config['secretId'],
                'secretKey'  => $this->config['secretKey'],
            ],
            'bucket'          => $this->config['bucket'],
            'timeout'         => $this->config['timeout'] ?? 60,
            'connect_timeout' => $this->config['connect_timeout'] ?? 60,
            'cdn'             => $this->config['cdn'],
            'scheme'          => $this->config['scheme'] ?? 'https',
            'read_from_cdn'   => $this->config['read_from_cdn'] ?? false,
        ];

        return new CosAdapter($config);
    }
}
