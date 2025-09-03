<?php

namespace IntelligentsDev\AiaConnector\Requests\Jobs;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetEstimationsRequest extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected array $jobModelGroups = [],
    ) {}

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/job/estimations';
    }

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return ['job_model_groups' => $this->jobModelGroups];
    }
}
