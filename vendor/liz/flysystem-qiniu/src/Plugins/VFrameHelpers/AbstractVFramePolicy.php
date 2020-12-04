<?php


namespace Liz\Flysystem\QiNiu\Plugins\VFrameHelpers;


abstract class AbstractVFramePolicy
{

    const FormatJPG = 'jpg';
    const FormatPNG = 'png';

    const Rotate90 = '90';
    const Rotate180 = '180';
    const Rotate270 = '270';
    const RotateAuto = 'auto';


    protected static $formats = [
        'qiniu.vframe.format_jpg' => self::FormatJPG,
        'qiniu.vframe.format_png' => self::FormatPNG,
    ];

    protected static $rotates = [
        'qiniu.vframe.rotate.90' => self::Rotate90,
        'qiniu.vframe.rotate.180' => self::Rotate180,
        'qiniu.vframe.rotate.270' => self::Rotate270,
        'qiniu.vframe.rotate.auto' => self::RotateAuto,
    ];

    /**
     * @return array
     */
    public static function getFormats(): array
    {
        return self::$formats;
    }

    /**
     * @return array
     */
    public static function getRotates(): array
    {
        return self::$rotates;
    }

    /**
     * @return string
     */
    abstract public function getFormat();

    /**
     * @param string $format
     */
    abstract public function setFormat(string $format);

    /**
     * @return int
     */
    abstract public function getWidth();

    /**
     * @param int $width
     */
    abstract public function setWidth(int $width);

    /**
     * @return int
     */
    abstract public function getHeight();

    /**
     * @param int $height
     */
    abstract public function setHeight(int $height);

    /**
     * @return int
     */
    abstract public function getOffset();

    /**
     * @param int $offset
     */
    abstract public function setOffset(int $offset);

    /**
     * @return string
     */
    abstract public function getRotate();

    /**
     * @param string $rotate
     */
    abstract public function setRotate(string $rotate);

    /**
     * @return string
     */
    abstract public function getNotifyUrl();

    /**
     * @param string $notifyUrl
     */
    abstract public function setNotifyUrl(string $notifyUrl);

    /**
     * @return string
     */
    abstract public function getPipeLine();

    /**
     * @param string $pipeLine
     */
    abstract public function setPipeLine(string $pipeLine);

}