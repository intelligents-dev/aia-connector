<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Worker;

use IntelligentsDev\AiaConnector\Requests\Worker\ModelWorkerStatsRequest;
use IntelligentsDev\AiaConnector\Requests\Worker\WorkflowWorkerStatsRequest;
use PHPUnit\Framework\TestCase;
use Saloon\Enums\Method;

class WorkflowWorkerStatsRequestTest extends TestCase
{
    public function test_it_gets_the_workflow_worker_stats_endpoint(): void
    {
        $request = new WorkflowWorkerStatsRequest();

        $this->assertSame('/workers/workflow-worker-stats', $request->resolveEndpoint());
        $this->assertSame(Method::GET, $request->getMethod());
    }

    public function test_old_shape_groups_are_sent_with_workflow_key(): void
    {
        $request = new WorkflowWorkerStatsRequest([['model_key' => 'a']]);

        $this->assertSame(
            ['workflow_worker_groups' => [['workflow_key' => 'a']]],
            $request->body()->all(),
        );
    }

    public function test_an_existing_workflow_key_wins_and_no_group_keeps_model_key(): void
    {
        $request = new WorkflowWorkerStatsRequest([['workflow_key' => 'new', 'model_key' => 'old']]);

        $this->assertSame(
            ['workflow_worker_groups' => [['workflow_key' => 'new']]],
            $request->body()->all(),
        );
    }

    public function test_extra_group_fields_are_kept(): void
    {
        $request = new WorkflowWorkerStatsRequest([['model_key' => 'a', 'worker_id' => 7]]);

        $this->assertEquals(
            ['workflow_worker_groups' => [['workflow_key' => 'a', 'worker_id' => 7]]],
            $request->body()->all(),
        );
    }

    public function test_the_old_request_is_unchanged(): void
    {
        $request = new ModelWorkerStatsRequest([['model_key' => 'a']]);

        $this->assertSame('/workers/model-worker-stats', $request->resolveEndpoint());
        $this->assertSame(['model_worker_groups' => [['model_key' => 'a']]], $request->body()->all());
    }
}
