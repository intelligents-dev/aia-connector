<?php

namespace GlobalModerators\AiaConnector\Resources;

use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
use Saloon\Http\BaseResource;

class ConversationResource extends BaseResource
{
    public function messages(): MessageResource
    {
        return new MessageResource($this->connector);
    }
}
