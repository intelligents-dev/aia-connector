<?php

namespace IntelligentsDev\AiaConnector\Requests\Jobs;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ProcessingCapacityRequest extends Request implements HasBody
{
    use HasJsonBody;
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
        return '/job/capacity';
    }
}
