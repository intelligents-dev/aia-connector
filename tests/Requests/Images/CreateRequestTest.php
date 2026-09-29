<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Images;

use IntelligentsDev\AiaConnector\Enums\Pipeline;
use IntelligentsDev\AiaConnector\Requests\Images\CreateRequest;
use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateRequestTest extends TestCase
{
    public function test_endpoint_resolves_for_each_pipeline_enum_case(): void
    {
        foreach (Pipeline::cases() as $pipeline) {
            $request = new CreateRequest($pipeline, new ImageOptions());

            $this->assertSame('/image/' . $pipeline->value, $request->resolveEndpoint());
        }
    }

    public function test_endpoint_resolves_for_an_unknown_pipeline_string(): void
    {
        $request = new CreateRequest('some-future-pipeline', new ImageOptions());

        $this->assertSame('/image/some-future-pipeline', $request->resolveEndpoint());
    }

    public function test_an_empty_pipeline_string_throws_an_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/pipeline/i');

        new CreateRequest('', new ImageOptions());
    }

    public function test_a_whitespace_only_pipeline_string_throws_an_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/pipeline/i');

        new CreateRequest('   ', new ImageOptions());
    }

    public function test_a_pipeline_instance_is_used_as_is(): void
    {
        $request = new CreateRequest(Pipeline::TEXT_TO_VIDEO_FRAMES, new ImageOptions());

        $this->assertSame('/image/text-to-video-frames', $request->resolveEndpoint());
    }

    public function test_the_reference_image_pipeline_posts_to_its_own_route(): void
    {
        $request = new CreateRequest(Pipeline::IMAGE_TO_IMAGE_WITH_REFERENCE_IMAGE, new ImageOptions());

        $this->assertSame('/image/image-to-image-with-reference-image', $request->resolveEndpoint());
    }
}
