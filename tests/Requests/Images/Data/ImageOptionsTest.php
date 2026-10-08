<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Images\Data;

use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use PHPUnit\Framework\TestCase;

class ImageOptionsTest extends TestCase
{
    public function test_to_array_works_when_data_was_never_set(): void
    {
        $this->assertSame([
            'model_name' => null,
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
        $options = (new ImageOptions())->setModelName('model')->setData(['prompt' => 'a cat']);

        $this->assertSame('model', $options->toArray()['model_name']);
        $this->assertSame('a cat', $options->toArray()['prompt']);
    }
}
