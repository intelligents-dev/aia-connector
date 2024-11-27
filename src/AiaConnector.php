<?php

namespace IntelligentsDev\AiaConnector;

use IntelligentsDev\AiaConnector\Resources\ConversationResource;
use IntelligentsDev\AiaConnector\Resources\ImageResource;
use IntelligentsDev\AiaConnector\Resources\LanguageModelResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
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
}
