<?php

namespace EasyIM\Kernel\Events;

use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponseCreated.
 */
class HttpResponseCreated
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    public $response;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }
}
