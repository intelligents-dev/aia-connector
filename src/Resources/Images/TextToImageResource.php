<?php

namespace GlobalModerators\AiaConnector\Resources\Images;

use GlobalModerators\AiaConnector\Requests\Images\CreateTextToImageRequest;
use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class TextToImageResource extends BaseResource
{
    /**
     * Create a text to image.
     *
     * @param CreateTextToImageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(CreateTextToImageOptions $options): Response
    {
        return $this->connector->send(
            new CreateTextToImageRequest($options),
        );
    }
}
