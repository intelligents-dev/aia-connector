<?php

namespace GlobalModerators\AiaConnector\Requests\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class CreateMessageRequest extends Request
{
    /**
     * The method to send the request with.
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
        return '/conversation/message';
    }
}
