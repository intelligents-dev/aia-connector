<?php

namespace GlobalModerators\AiaConnector;

use GlobalModerators\AiaConnector\Resources\ConversationResource;
use Globalmoderators\AiaConnector\Resources\ImageResource;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\HttpSender\HttpSender;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Plugins\AcceptsJson;

class AiaConnector extends Connector implements HasBody
{
    use AcceptsJson;
    use HasJsonBody;

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
        return config('services.aia.base_url');
    }

    /**
     * The default authenticator for the AIA API.
     *
     * @return TokenAuthenticator
     */
    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(config('services.aia.token'));
    }

    /**
     * The default configuration for the AIA API.
     *
     * @return bool[]
     */
    public function defaultConfig(): array
    {
        return [
            'verify' => ! config('services.aia.ignore_ssl', false),
        ];
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
}
