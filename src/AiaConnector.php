<?php
namespace GlobalModerators\AiaConnector;
use GlobalModerators\AiaConnector\Resources\ConversationResource;
use GlobalModerators\AiaConnector\Resources\ImageResource;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;

class AiaConnector extends Connector
{
    /**
     * The base URL of the AIA API.
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return config('services.aia.base_url');
    }

    /**
     * The default authenticator for the AIA API.
     * @return TokenAuthenticator
     */
    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(config('services.aia.token'));
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
