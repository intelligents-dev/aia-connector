<?php

namespace IntelligentsDev\AiaConnector\Tests\Enums;

use IntelligentsDev\AiaConnector\Enums\Pipeline;
use PHPUnit\Framework\TestCase;

class PipelineTest extends TestCase
{
    public function test_text_to_video_frames_case_has_the_expected_value(): void
    {
        $this->assertSame('text-to-video-frames', Pipeline::TEXT_TO_VIDEO_FRAMES->value);
    }

    public function test_image_to_image_with_reference_image_case_has_the_expected_value(): void
    {
        $this->assertSame('image-to-image-with-reference-image', Pipeline::IMAGE_TO_IMAGE_WITH_REFERENCE_IMAGE->value);
    }

    public function test_the_reference_image_pipeline_key_resolves_to_its_case(): void
    {
        $this->assertSame(Pipeline::IMAGE_TO_IMAGE_WITH_REFERENCE_IMAGE, Pipeline::tryFrom('image-to-image-with-reference-image'));
    }
}
