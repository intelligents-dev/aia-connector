<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages;

use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\UpdateConversationMessageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateConversationMessageRequest extends Request implements HasBody
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
        return sprintf('/conversation/%d/message', $this->conversationId);
    }

    /**
     * @param int $conversationId
     * @param UpdateConversationMessageOptions $options
     */
    public function __construct(
        protected int $conversationId,
        protected UpdateConversationMessageOptions $options,
    ) {}

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [$this->options->toArray()];
    }
}
