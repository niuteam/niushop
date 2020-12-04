<?php


namespace Liz\Flysystem\QiNiu\Plugins\VFrameHelpers;


class QiNiuVFramePolicy extends AbstractVFramePolicy
{

    protected $format;

    protected $offset;

    protected $width;

    protected $height;

    protected $rotate;

    protected $pipeline;

    protected $notifyUrl;

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param mixed $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getRotate()
    {
        return $this->rotate;
    }

    /**
     * @param mixed $rotate
     */
    public function setRotate(string $rotate)
    {
        $this->rotate = $rotate;
    }

    /**
     * @return mixed
     */
    public function getPipeline()
    {
        return $this->pipeline;
    }

    /**
     * @param mixed $pipeline
     */
    public function setPipeline(string $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param mixed $notifyUrl
     */
    public function setNotifyUrl(string $notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }


}