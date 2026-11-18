<?php

namespace IntelligentsDev\AiaConnector\Requests\Worker;

use IntelligentsDev\AiaConnector\Requests\Concerns\MapsModelKeyToWorkflowKey;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class WorkflowWorkerStatsRequest extends Request implements HasBody
{
    use HasJsonBody;
    use MapsModelKeyToWorkflowKey;

    protected Method $method = Method::GET;

    public function __construct(
        protected array $workflowWorkerGroups = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/workers/workflow-worker-stats';
    }

    protected function defaultBody(): array
    {
        return ['workflow_worker_groups' => $this->withWorkflowKeys($this->workflowWorkerGroups)];
    }
}
