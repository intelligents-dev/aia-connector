<?php

namespace IntelligentsDev\AiaConnector\Resources;


use IntelligentsDev\AiaConnector\Requests\Conversations\CreateConversationRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Data\CreateConversationOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ConversationResource extends BaseResource
{
    public function messages(): ConversationMessageResource
    {
        return new ConversationMessageResource($this->connector);
    }

    /**
     * Create a conversation.
     *
     * @param CreateConversationOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(

        CreateConversationOptions $options = new CreateConversationOptions(),
    ): Response
    {
        return $this->connector->send(
            new CreateConversationRequest($options),
        );
    }
}
