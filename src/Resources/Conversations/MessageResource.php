<?php

namespace IntelligentsDev\AiaConnector\Resources\Conversations;

use IntelligentsDev\AiaConnector\Requests\Conversations\CreateMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Data\CreateMessageOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class MessageResource extends BaseResource
{
    /**
     * Send a message to a character.
     *
     * @param string $message
     * @param string $characterId
     * @param int $userId
     * @param CreateMessageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function send(
        string $message,
        int $characterId,
        int $userId,
        CreateMessageOptions $options = new CreateMessageOptions(),
    ): Response {
        return $this->connector->send(
            new CreateMessageRequest($message, $characterId, $userId, $options),
        );
    }
}
