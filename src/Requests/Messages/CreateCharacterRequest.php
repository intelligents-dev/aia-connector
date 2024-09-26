<?php

namespace GlobalModerators\AiaConnector\Requests\Messages;

use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class CreateCharacterRequest extends Request
{
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
     * @param string $characterId
     * @param string $userId
     * @param CreateMessageOptions $options
     */
    public function __construct(
        protected string $message,
        protected string $characterId,
        protected string $userId,
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

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
}
