<?php

namespace thans\filesystem;

use think\App;
use think\filesystem\Driver;
use think\helper\Arr;

class Filesystem
{
    protected $disks;

    /** @var App */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param null|string $name
     *
     * @return Driver
     */
    public function disk(string $name = null): Driver
    {
        $name = $name ?: $this->app->config->get('filesystem.default');

        if (!isset($this->disks[$name])) {
            $config = $this->app->config->get("filesystem.disks.{$name}");

            $this->disks[$name] = App::factory($config['type'], '\\thans\\filesystem\\driver\\', $config);
        }

        return $this->disks[$name];
    }

    /**
     * 获取缓存配置.
     *
     * @param null|string $name    名称
     * @param mixed       $default 默认值
     *
     * @return mixed
     */
    public function getConfig(string $name = null, $default = null)
    {
        if (!is_null($name)) {
            return $this->app->config->get('filesystem.'.$name, $default);
        }

        return $this->app->config->get('filesystem');
    }

    /**
     * 获取磁盘配置.
     *
     * @param string $disk
     * @param null   $name
     * @param null   $default
     *
     * @return array
     */
    public function getDiskConfig($disk, $name = null, $default = null)
    {
        if ($config = $this->getConfig("disks.{$disk}")) {
            return Arr::get($config, $name, $default);
        }

        throw new InvalidArgumentException("Disk [$disk] not found.");
    }

    public function __call($method, $parameters)
    {
        return $this->disk()->$method(...$parameters);
    }
}
