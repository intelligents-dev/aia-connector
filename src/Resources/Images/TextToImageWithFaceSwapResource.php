<?php

namespace GlobalModerators\AiaConnector\Resources\Images;

use GlobalModerators\AiaConnector\Requests\Images\CreateTextToImageWithFaceSwapRequest;
use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageWithFaceSwapOptions;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class TextToImageWithFaceSwapResource extends BaseResource
{
    /**
     * Create a text to image with face swap.
     *
     * @param CreateTextToImageWithFaceSwapOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function create(CreateTextToImageWithFaceSwapOptions $options): Response
    {
        return $this->connector->send(
            new CreateTextToImageWithFaceSwapRequest($options),
        );
    }
}
