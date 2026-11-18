<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Images;

use IntelligentsDev\AiaConnector\Requests\Images\WorkflowsRequest;
use PHPUnit\Framework\TestCase;
use Saloon\Enums\Method;

class WorkflowsRequestTest extends TestCase
{
    public function test_it_gets_the_workflow_list(): void
    {
        $request = new WorkflowsRequest();

        $this->assertSame('/image/workflows', $request->resolveEndpoint());
        $this->assertSame(Method::GET, $request->getMethod());
    }
}
