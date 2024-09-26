<?php

namespace GlobalModerators\AiaConnector;

use GlobalModerators\AiaConnector\Resources\CharacterResource;
use GlobalModerators\AiaConnector\Resources\ConversationResource;
use Globalmoderators\AiaConnector\Resources\ImageResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

class AiaConnector extends Connector
{

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
     * @return bool[]
     */
    public function defaultConfig(): array
    {
        return [
            'verify' => !config('services.aia.ignore_ssl', false),
        ];
    }

    /**
     * @return CharacterResource
     */
    public function characters(): CharacterResource
    {
        return new CharacterResource($this);
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
