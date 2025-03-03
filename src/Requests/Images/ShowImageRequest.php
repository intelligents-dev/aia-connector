<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ShowImageRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $imageId) {}

    public function resolveEndpoint(): string
    {
        return sprintf('/image/%d', $this->imageId);
    }
}
