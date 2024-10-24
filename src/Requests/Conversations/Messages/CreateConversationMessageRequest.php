<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages;

use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\CreateConversationMessageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateConversationMessageRequest extends Request implements HasBody
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
     * @param string $content
     * @param CreateCharacterOptions $options
     */
    public function __construct(
        protected int $conversationId,
        protected string $content,
        protected CreateConversationMessageOptions $options,
    ) {}

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'content' => $this->content,
            ...$this->options->toArray(),
        ];
    }
}
