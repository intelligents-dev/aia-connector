<?php

namespace IntelligentsDev\AiaConnector\Requests\Worker;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ModelWorkerStatsRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected array $modelWorkerGroups = [],
    ) {}

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/workers/model-worker-stats';
    }

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'model_worker_groups' => $this->modelWorkerGroups,
        ];
    }
}
