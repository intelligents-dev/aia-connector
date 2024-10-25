<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\CreateConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\CreateConversationMessageOptions;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\UpdateConversationMessageOptions;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\UpdateConversationMessageRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ConversationMessageResource extends BaseResource
{
    /**
     * Create a conversation.
     *
     * @param CreateConversationMessageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(
        int $conversationId,
        string $content,
        CreateConversationMessageOptions $options = new CreateConversationMessageOptions(),
    ): Response {
        return $this->connector->send(
            new CreateConversationMessageRequest($conversationId, $content, $options),
        );
    }

    /**
     * Update a conversation.
     *
     * @param int $conversationId
     * @param UpdateConversationMessageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function update(
        int $conversationId,
        UpdateConversationMessageOptions $options = new UpdateConversationMessageOptions(),
    ): Response {
        return $this->connector->send(new UpdateConversationMessageRequest($conversationId, $options));
    }
}
