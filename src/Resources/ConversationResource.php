<?php

namespace GlobalModerators\AiaConnector\Resources;

use GlobalModerators\AiaConnector\Resources\Conversations\CharacterResource;
use GlobalModerators\AiaConnector\Resources\Conversations\MessageResource;
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
