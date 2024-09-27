<?php

namespace IntelligentsDev\AiaConnector\Resources\Conversations;

use IntelligentsDev\AiaConnector\Requests\Conversations\CreateCharacterRequest;
use IntelligentsDev\AiaConnector\Requests\Conversations\Data\CreateCharacterOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class CharacterResource extends BaseResource
{
    /**
     * Create a character.
     *
     * @param CreateCharacterOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(CreateCharacterOptions $options): Response
    {
        return $this->connector->send(
            new CreateCharacterRequest($options),
        );
    }
}
