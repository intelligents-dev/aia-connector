<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages;

use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\AppendConversationMessageOptions;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\CreateConversationMessageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AppendConversationMessageRequest extends Request implements HasBody
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
        return sprintf('/conversation/%d/message/append', $this->conversationId);
    }

    /**
     * @param int $conversationId
     * @param array<int, AppendConversationMessageOptions $messages>
     */
    public function __construct(
        protected int $conversationId,
        protected array $messages,
    ) {}

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'messages' => collect($this->messages)->toArray(),
        ];
    }
}
