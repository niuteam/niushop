<?php

namespace Liz\Flysystem\QiNiu;

use Qiniu\Http\Response;

class QiNiuOssAdapterException extends \Exception
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $response
     *
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }
}
