<?php

namespace GlobalModerators\AiaConnector\Resources;

use GlobalModerators\AiaConnector\Data\CreateMessageOptions;
use Saloon\Http\BaseResource;

class MessageResource extends BaseResource
{
    public function send(string $message, int $characterId, int $userId, CreateMessageOptions $options)
    {
        //
    }
}
