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
}
