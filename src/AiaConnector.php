<?php

namespace IntelligentsDev\AiaConnector;

use IntelligentsDev\AiaConnector\Resources\ConversationResource;
use IntelligentsDev\AiaConnector\Resources\ImageResource;
use IntelligentsDev\AiaConnector\Resources\LanguageModelResource;
use IntelligentsDev\AiaConnector\Resources\TextToSpeechResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\HttpSender\HttpSender;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

class AiaConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    public function __construct()
    {
        if (config('aia.spoof_requests')) {
            $this->withMockClient($this->makeMockClient());
        }
    }

    /**
     * The default sender for the AIA API.
     *
     * @var string
     */
    protected string $defaultSender = HttpSender::class;

    /**
     * The base URL of the AIA API.
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return config('aia.base_url');
    }

    /**
     * The default authenticator for the AIA API.
     *
     * @return TokenAuthenticator
     */
    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(config('aia.token'));
    }

    /**
     * The default configuration for the AIA API.
     *
     * @return bool[]
     */
    public function defaultConfig(): array
    {
        return [
            'verify' => ! config('aia.ignore_ssl', false),
        ];
    }

    /**
     * Paginate the response.
     *
     * @param Request $request
     * @return PagedPaginator
     */
    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected function isLastPage(Response $response): bool
            {
                return $response->json('meta.current_page') >= $response->json('meta.last_page');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('data');
            }
        };
    }

    /**
     * @return ConversationResource
     */
    public function conversations(): ConversationResource
    {
        return new ConversationResource($this);
    }

    /**
     * @return ImageResource
     */
    public function images(): ImageResource
    {
        return new ImageResource($this);
    }

    /**
     * @return LanguageModelResource
     */
    public function languageModels(): LanguageModelResource
    {
        return new LanguageModelResource($this);
    }

    /**
     * @return TextToSpeechResource
     */
    public function textToSpeech(): TextToSpeechResource
    {
        return new TextToSpeechResource($this);
    }

    private function makeMockClient(): MockClient
    {
        return new MockClient([
            Requests\Conversations\CreateConversationRequest::class => $this->getMockResponse(
                'Conversations/create',
                201,
            ),
            Requests\Conversations\DeleteConversationRequest::class => $this->getMockResponse(
                'Conversations/delete',
                204,
            ),
            Requests\Conversations\UpdateConversationRequest::class => $this->getMockResponse(
                'Conversations/update',
            ),
            Requests\Conversations\Messages\AppendConversationMessageRequest::class => $this->getMockResponse(
                'Conversations/Messages/append',
            ),
            Requests\Conversations\Messages\CreateConversationMessageRequest::class => $this->getMockResponse(
                'Conversations/Messages/create',
                201,
            ),
            Requests\Conversations\Messages\DeleteConversationMessageRequest::class => $this->getMockResponse(
                'Conversations/Messages/destroy',
                204,
            ),
            Requests\Conversations\Messages\RegenerateConversationMessageRequest::class => $this->getMockResponse(
                'Conversations/Messages/regenerate',
                201,
            ),
            Requests\Conversations\Messages\UpdateConversationMessageRequest::class => $this->getMockResponse(
                'Conversations/Messages/update',
            ),
            Requests\Images\TextToImageRequest::class => $this->getMockResponse('Images/text-to-image', 201),
            Requests\Images\TextToImageWithFaceSwapRequest::class => $this->getMockResponse(
                'Images/text-to-image-with-face-swap',
            ),
            Requests\Images\LorasRequest::class => $this->getMockResponse('Images/loras'),
            Requests\Images\ModelsRequest::class => $this->getMockResponse('Images/models'),
            Requests\Images\SchedulersRequest::class => $this->getMockResponse('Images/schedulers'),
            Requests\LanguageModels\GetLanguageModelsRequest::class => $this->getMockResponse(
                'LanguageModels/get-language-models',
            ),
            Requests\TextToSpeech\Voices\GetTextToSpeechVoicesRequest::class => $this->getMockResponse(
                'TextToSpeech/Voices/index',
            ),
            Requests\TextToSpeech\Voices\SynthesizeRequest::class => $this->getMockResponse(
                'TextToSpeech/Voices/synthesize',
            ),
        ]);
    }

    private function getMockResponse(string $name, int $status = 200): MockResponse
    {
        return MockResponse::make(
            file_get_contents(__DIR__ . "/SpoofResponses/$name-response.json"),
            $status,
        );
    }
}
