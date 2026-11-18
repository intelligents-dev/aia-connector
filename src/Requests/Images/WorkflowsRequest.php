<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class WorkflowsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/image/workflows';
    }
}
