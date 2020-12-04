<?php

namespace thans\filesystem\traits;

trait Storage
{
    public function getUrl(string $path)
    {
        if (strpos($path, '/') === 0) {
            return $path;
        }

        return isset($this->config['url']) && $this->config['url'] ? $this->config['url'].DIRECTORY_SEPARATOR.$path
            : $path;
    }
}
