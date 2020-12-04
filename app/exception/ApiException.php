<?php
declare (strict_types=1);

namespace app\exception;

class ApiException extends BaseException
{
    protected $code = -1;
    protected $message = '';

    public function __construct($code, $message)
    {
        $this->code    = $code;
        $this->message = $message;
    }

    public function getErrorCode()
    {
        return $this->code;
    }

    public function getErrorMessage()
    {
        return $this->message;
    }
}

?>