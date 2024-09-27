<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Resources\Conversations\CharacterResource;
use IntelligentsDev\AiaConnector\Resources\Conversations\MessageResource;
use Saloon\Http\BaseResource;

class ConversationResource extends BaseResource
{
    public function messages(): MessageResource
    {
        return new MessageResource($this->connector);
    }

    public function characters(): CharacterResource
    {
        return new CharacterResource($this->connector);
    }
}
