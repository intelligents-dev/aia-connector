<?php

namespace IntelligentsDev\AiaConnector\Requests\Jobs;

use IntelligentsDev\AiaConnector\Requests\Concerns\MapsModelKeyToWorkflowKey;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetWorkflowEstimationsRequest extends Request implements HasBody
{
    use HasJsonBody;
    use MapsModelKeyToWorkflowKey;

    protected Method $method = Method::GET;

    public function __construct(
        protected array $jobWorkflowGroups = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/job/estimations';
    }

    protected function defaultBody(): array
    {
        return ['job_workflow_groups' => $this->withWorkflowKeys($this->jobWorkflowGroups)];
    }
}
