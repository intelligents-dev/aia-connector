<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Images\Data;

use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use PHPUnit\Framework\TestCase;

class ImageOptionsTest extends TestCase
{
    public function test_to_array_works_when_data_was_never_set(): void
    {
        $this->assertSame([
            'workflow_name' => null,
            'webhook_urls' => null,
            'priority' => null,
            'meta' => null,
        ], (new ImageOptions())->toArray());
    }

    public function test_to_array_works_when_data_was_set_to_null(): void
    {
        $options = (new ImageOptions())->setData(null);

        $this->assertArrayNotHasKey('prompt', $options->toArray());
    }

    public function test_to_array_merges_the_data_into_the_body(): void
    {
        $options = (new ImageOptions())->setWorkflowName('workflow')->setData(['prompt' => 'a cat']);

        $this->assertSame('workflow', $options->toArray()['workflow_name']);
        $this->assertSame('a cat', $options->toArray()['prompt']);
    }

    public function test_set_workflow_name_sends_workflow_name_only(): void
    {
        $body = (new ImageOptions())->setWorkflowName('flux')->toArray();

        $this->assertSame('flux', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }

    public function test_set_model_name_is_sent_as_workflow_name(): void
    {
        $options = (new ImageOptions())->setModelName('flux');
        $body = $options->toArray();

        $this->assertSame('flux', $options->workflowName);
        $this->assertSame('flux', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }

    public function test_data_with_model_name_only_is_sent_as_workflow_name(): void
    {
        $body = (new ImageOptions())->setData(['model_name' => 'old', 'prompt' => 'x'])->toArray();

        $this->assertSame('old', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
        $this->assertSame('x', $body['prompt']);
    }

    public function test_data_with_workflow_name_only_is_sent_as_is(): void
    {
        $body = (new ImageOptions())->setData(['workflow_name' => 'new'])->toArray();

        $this->assertSame('new', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }

    public function test_data_with_both_names_sends_workflow_name_and_no_model_name(): void
    {
        $body = (new ImageOptions())
            ->setData(['workflow_name' => 'new', 'model_name' => 'old'])
            ->toArray();

        $this->assertSame('new', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }

    public function test_a_directly_assigned_model_name_property_is_sent_as_workflow_name(): void
    {
        $options = new ImageOptions();
        $options->modelName = 'x';
        $body = $options->toArray();

        $this->assertSame('x', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }

    public function test_explicit_name_wins_over_data_names(): void
    {
        $body = (new ImageOptions())
            ->setWorkflowName('explicit')
            ->setData(['workflow_name' => 'new', 'model_name' => 'old'])
            ->toArray();

        $this->assertSame('explicit', $body['workflow_name']);
        $this->assertArrayNotHasKey('model_name', $body);
    }
}
