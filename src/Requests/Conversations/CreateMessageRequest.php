<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations;

use IntelligentsDev\AiaConnector\Requests\Conversations\Data\CreateMessageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateMessageRequest extends Request implements HasBody
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
        return '/conversation/message';
    }

    /**
     * @param string $message
     * @param int $characterId
     * @param int $userId
     * @param CreateMessageOptions $options
     */
    public function __construct(
        protected string $message,
        protected int $characterId,
        protected int $userId,
        protected CreateMessageOptions $options,
    ) {}

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'message' => $this->message,
            'character_id' => $this->characterId,
            'user_id' => $this->userId,
            ...$this->options->toArray(),
        ];
    }
}
