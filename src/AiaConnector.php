<?php

namespace IntelligentsDev\AiaConnector;

use IntelligentsDev\AiaConnector\Requests\Conversations\CreateConversationRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\DeleteConversationRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\AppendConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\CreateConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\DeleteConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\RegenerateConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\UpdateConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\UpdateConversationRequest;
use IntelligentsDev\AiaConnector\Requests\Images\CheckpointsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\LorasRequest;
use IntelligentsDev\AiaConnector\Requests\Images\ModelsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\SchedulersRequest;
use IntelligentsDev\AiaConnector\Requests\Images\TextToImageRequest;
use IntelligentsDev\AiaConnector\Requests\Images\TextToImageWithFaceSwapRequest;
use IntelligentsDev\AiaConnector\Requests\LanguageModels\GetLanguageModelsRequest;
use IntelligentsDev\AiaConnector\Requests\TextToSpeech\Voices\GetTextToSpeechVoicesRequest;
use IntelligentsDev\AiaConnector\Requests\TextToSpeech\Voices\SynthesizeRequest;
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
        /**
         * Temporary solution for Facade spoofing routes.
         * Issue is that, partialMock does not call the constructor, so it never spoofs the requests.
         * This method is always called at the beginning, so it will always set the spoofed requests when desired
         */
        if (config('aia.spoof_requests')) {
            $this->withMockClient($this->makeMockClient());
        }

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
        return new class(connector: $this, request: $request) extends PagedPaginator {
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
            CreateConversationRequest::class => $this->getMockResponse('Conversations/create', 201),
            DeleteConversationRequest::class => $this->getMockResponse('Conversations/delete', 204),
            UpdateConversationRequest::class => $this->getMockResponse('Conversations/update'),
            AppendConversationMessageRequest::class => $this->getMockResponse('Conversations/Messages/append'),
            CreateConversationMessageRequest::class => $this->getMockResponse('Conversations/Messages/create', 201),
            DeleteConversationMessageRequest::class => $this->getMockResponse('Conversations/Messages/destroy', 204),
            RegenerateConversationMessageRequest::class => $this->getMockResponse('Conversations/Messages/regenerate', 201),
            UpdateConversationMessageRequest::class => $this->getMockResponse('Conversations/Messages/update'),
            TextToImageRequest::class => $this->getMockResponse('Images/text-to-image', 201),
            TextToImageWithFaceSwapRequest::class => $this->getMockResponse('Images/text-to-image-with-face-swap'),
            LorasRequest::class => $this->getMockResponse('Images/loras'),
            CheckpointsRequest::class => $this->getMockResponse('Images/checkpoints'),
            ModelsRequest::class => $this->getMockResponse('Images/models'),
            SchedulersRequest::class => $this->getMockResponse('Images/schedulers'),
            GetLanguageModelsRequest::class => $this->getMockResponse('LanguageModels/get-language-models'),
            GetTextToSpeechVoicesRequest::class => $this->getMockResponse('TextToSpeech/Voices/index'),
            SynthesizeRequest::class => $this->getMockResponse('TextToSpeech/Voices/synthesize'),
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
