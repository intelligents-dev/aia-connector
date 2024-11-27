<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\AppendConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\CreateConversationMessageRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data\AppendConversationMessageOptions;
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
     * Update a conversation message.
     *
     * @param int $conversationId
     * @param int $messageId
     * @param UpdateConversationMessageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function update(
        int $conversationId,
        int $messageId,
        UpdateConversationMessageOptions $options = new UpdateConversationMessageOptions(),
    ): Response
    {
        return $this->connector->send(new UpdateConversationMessageRequest($conversationId, $messageId, $options));
    }

    /**
     * @param int $conversationId
     * @param array<int, AppendConversationMessageOptions> $messages
     * @return Response
     */
    public function append(
        int $conversationId,
        array $messages,
    ): Response {
        return $this->connector->send(new AppendConversationMessageRequest($conversationId, $messages));
    }

    /**
     * Delete a conversation message
     *
     * @param int $conversationId
     * @param int $messageId
     * @return Response
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function delete(
        int $conversationId,
        int $messageId,
    ): Response
    {
        return $this->connector->send(new DeleteConversationMessageRequest($conversationId, $messageId));
    }
}
