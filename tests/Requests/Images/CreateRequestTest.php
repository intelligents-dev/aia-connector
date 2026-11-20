<?php

namespace IntelligentsDev\AiaConnector\Tests\Requests\Images;

use IntelligentsDev\AiaConnector\Enums\Pipeline;
use IntelligentsDev\AiaConnector\Requests\Images\CreateRequest;
use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Connector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

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

    public function test_the_pussy_swap_pipeline_posts_to_its_own_route(): void
    {
        $request = new CreateRequest(Pipeline::PUSSY_SWAP, new ImageOptions());

        $this->assertSame('/image/pussy-swap', $request->resolveEndpoint());
    }

    public function test_data_holding_model_name_is_sent_as_workflow_name_only(): void
    {
        $mockClient = new MockClient([CreateRequest::class => MockResponse::make([], 200)]);
        $connector = new FakeAiaConnector();
        $connector->withMockClient($mockClient);
        $options = (new ImageOptions())->setData(['model_name' => 'old', 'prompt' => 'a cat']);

        $connector->send(new CreateRequest(Pipeline::TEXT_TO_IMAGE, $options));

        $mockClient->assertSent(function (Request $request): bool {
            $body = $request->body()->all();

            return $body['workflow_name'] === 'old'
                && array_key_exists('model_name', $body) === false
                && $body['prompt'] === 'a cat';
        });
    }

    public function test_the_three_existing_routes_stay_the_same(): void
    {
        $expected = [
            '/image/text-to-image' => Pipeline::TEXT_TO_IMAGE,
            '/image/text-to-image-with-face-swap' => Pipeline::TEXT_TO_IMAGE_WITH_FACE_SWAP,
            '/image/text-to-video-frames' => Pipeline::TEXT_TO_VIDEO_FRAMES,
        ];

        foreach ($expected as $endpoint => $pipeline) {
            $this->assertSame($endpoint, (new CreateRequest($pipeline, new ImageOptions()))->resolveEndpoint());
        }
    }
}

class FakeAiaConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://aia.test';
    }
}
