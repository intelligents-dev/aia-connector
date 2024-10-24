<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations;

use IntelligentsDev\AiaConnector\Requests\Conversations\Data\CreateConversationOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateConversationRequest extends Request implements HasBody
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
        return '/conversation';
    }

    /**
     * @param CreateConversationOptions $options
     */
    public function __construct(
        protected CreateConversationOptions $options,
    ) {}

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
