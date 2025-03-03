<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SchedulersRequest extends Request
{
    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/image/schedulers';
    }
}
