<?php

namespace GlobalModerators\AiaConnector\Resources\Images;

use GlobalModerators\AiaConnector\Requests\Conversations\CreateCharacterRequest;
use GlobalModerators\AiaConnector\Requests\Conversations\Data\CreateCharacterOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class TextToImageResource extends BaseResource
{
    /**
     * Create a text to image.
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
