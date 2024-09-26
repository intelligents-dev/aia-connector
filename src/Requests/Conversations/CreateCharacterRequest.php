<?php

namespace GlobalModerators\AiaConnector\Requests\Conversations;

use GlobalModerators\AiaConnector\Requests\Conversations\Data\CreateCharacterOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateCharacterRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/conversation/character';
    }

    /**
     * @param CreateCharacterOptions $options
     */
    public function __construct(
        protected CreateCharacterOptions $options,
    ) {
        //
    }

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return $this->options->toArray();
    }
}
