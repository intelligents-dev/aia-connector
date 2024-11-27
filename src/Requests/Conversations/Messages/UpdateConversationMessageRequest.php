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
    protected Method $method = Method::PUT;

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return vsprintf('/conversation/%d/message/%d', [$this->conversationId, $this->messageId]);
    }

    /**
     * @param int $conversationId
     * @param int $messageId
     * @param UpdateConversationMessageOptions $options
     */
    public function __construct(
        protected int $conversationId,
        protected int $messageId,
        protected UpdateConversationMessageOptions $options,
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
