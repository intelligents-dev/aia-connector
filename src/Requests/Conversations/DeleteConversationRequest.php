<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteConversationRequest extends Request
{
    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/conversation/' . $this->conversationId;
    }

    public function __construct(
        protected readonly int $conversationId,
    ) {}
}
