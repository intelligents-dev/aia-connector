<?php

namespace GlobalModerators\AiaConnector\Resources;

use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
use GlobalModerators\AiaConnector\Requests\Messages\CreateMessageRequest;
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
     * @param int $characterId
     * @param int $userId
     * @param CreateMessageOptions $options
     * @return Response
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function send(string $message, int $characterId, int $userId, CreateMessageOptions $options): Response
    {
        return $this->connector->send(
            new CreateMessageRequest($message, $characterId, $userId, $options)
        );
    }
}
