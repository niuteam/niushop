<?php


namespace Liz\Flysystem\QiNiu\Plugins\TransCoderHelpers;


abstract class AbstractTransCoderPolicy
{

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

    /**
     * @return string
     */
    abstract public function getToBucket();

    /**
     * @param string $toBucket
     */
    abstract public function setToBucket(string $toBucket);

    /**
     * @return string
     */
    abstract public function getWmImage();

    /**
     * @param mixed $wmImage
     */
    abstract public function setWmImage(string $wmImage);

    /**
     * @param string $rules
     */
    abstract public function setRules(string $rules);

    /**
     * @return string
     */
    abstract public function getRules();

    /**
     * @param string $rules
     */
    abstract public function setUploadPersistentOps(string $rules);

    /**
     * @return string
     */
    abstract public function getUploadPersistentOps();

}