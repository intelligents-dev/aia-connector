<?php

namespace GlobalModerators\AiaConnector\Resources;

use Saloon\Http\BaseResource;

class ConversationResource extends BaseResource
{
    public function messages(): MessageResource
    {
        return new MessageResource($this->connector);
    }
}
