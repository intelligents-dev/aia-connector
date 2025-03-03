<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteConversationMessageRequest extends Request
{
    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * @param int $conversationId
     * @param int $messageId
     */
    public function __construct(
        protected int $conversationId,
        protected int $messageId,
    ) {}

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return vsprintf('/conversation/%d/message/%d', [$this->conversationId, $this->messageId]);
    }
}
