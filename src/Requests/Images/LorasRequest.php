<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class LorasRequest extends Request
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
        return '/image/loras';
    }
}
