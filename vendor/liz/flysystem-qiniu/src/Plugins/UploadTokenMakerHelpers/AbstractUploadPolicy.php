<?php


namespace Liz\Flysystem\QiNiu\Plugins\UploadTokenMakerHelpers;


use Liz\Flysystem\QiNiu\Plugins\TransCoderHelpers\AbstractTransCoderPolicy;

abstract class AbstractUploadPolicy
{

    const CallbackBodyTypeForm = 'application/x-www-form-urlencoded';
    const CallbackBodyTypeJson = 'application/json';

    protected static $callbackBodyTypes = [
        'qiniu.upload_policy.callback_body_type.form' => self::CallbackBodyTypeForm,
        'qiniu.upload_policy.callback_body_type.json' => self::CallbackBodyTypeJson,
    ];

    abstract public function addCallbackUrl(string $callbackUrl);

    abstract public function getCallbackUrls();

    abstract public function setCallbackBody(string $callbackBody);

    abstract public function getCallbackBody();

    abstract public function setCallbackBodyType(string $bodyType);

    abstract public function getCallbackBodyType();

    abstract public function setTransCoderPolicy(AbstractTransCoderPolicy $transCoderPolicy=null);

    /**
     * @return AbstractTransCoderPolicy
     */
    abstract public function getTransCoderPolicy();

    /**
     * @return array
     */
    public static function getCallbackBodyTypes(): array
    {
        return self::$callbackBodyTypes;
    }

}