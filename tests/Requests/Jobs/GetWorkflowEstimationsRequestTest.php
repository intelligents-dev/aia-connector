<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Jobs;

use IntelligentsDev\AiaConnector\Requests\Jobs\GetEstimationsRequest;
use IntelligentsDev\AiaConnector\Requests\Jobs\GetWorkflowEstimationsRequest;
use PHPUnit\Framework\TestCase;

class GetWorkflowEstimationsRequestTest extends TestCase
{
    public function test_it_uses_the_estimations_endpoint_and_method(): void
    {
        $workflow = new GetWorkflowEstimationsRequest();
        $old = new GetEstimationsRequest();

        $this->assertSame($old->resolveEndpoint(), $workflow->resolveEndpoint());
        $this->assertSame($old->getMethod(), $workflow->getMethod());
    }

    public function test_old_shape_groups_are_sent_with_workflow_key(): void
    {
        $request = new GetWorkflowEstimationsRequest([['model_key' => 'a', 'count' => 2]]);

        $this->assertSame(
            ['job_workflow_groups' => [['count' => 2, 'workflow_key' => 'a']]],
            $this->sorted($request->body()->all()),
        );
    }

    public function test_new_shape_groups_are_sent_unchanged(): void
    {
        $request = new GetWorkflowEstimationsRequest([['workflow_key' => 'b', 'count' => 1]]);

        $this->assertSame(
            ['job_workflow_groups' => [['count' => 1, 'workflow_key' => 'b']]],
            $this->sorted($request->body()->all()),
        );
    }

    public function test_an_existing_workflow_key_wins_and_no_group_keeps_model_key(): void
    {
        $request = new GetWorkflowEstimationsRequest([
            ['workflow_key' => 'new', 'model_key' => 'old'],
            ['model_key' => 'only-old'],
        ]);

        $groups = $request->body()->all()['job_workflow_groups'];

        $this->assertSame('new', $groups[0]['workflow_key']);
        $this->assertSame('only-old', $groups[1]['workflow_key']);
        $this->assertArrayNotHasKey('model_key', $groups[0]);
        $this->assertArrayNotHasKey('model_key', $groups[1]);
    }

    public function test_the_old_request_still_sends_job_model_groups(): void
    {
        $request = new GetEstimationsRequest([['model_key' => 'a']]);

        $this->assertSame(['job_model_groups' => [['model_key' => 'a']]], $request->body()->all());
    }

    private function sorted(array $body): array
    {
        $body['job_workflow_groups'] = array_map(
            function (array $group): array {
                ksort($group);

                return $group;
            },
            $body['job_workflow_groups'],
        );

        return $body;
    }
}
