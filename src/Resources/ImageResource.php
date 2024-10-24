<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Images\CreateTextToImageRequest;
use IntelligentsDev\AiaConnector\Requests\Images\CreateTextToImageWithFaceSwapRequest;
use IntelligentsDev\AiaConnector\Requests\Images\Data\CreateTextToImageOptions;
use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageOptions;
use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageWithFaceSwapOptions;
use IntelligentsDev\AiaConnector\Requests\Images\TextToImageRequest;
use IntelligentsDev\AiaConnector\Requests\Images\TextToImageWithFaceSwapRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ImageResource extends BaseResource
{
    /**
     * Create text to image.
     *
     * @param CreateTextToImageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function textToImage(
        string $prompt,
        TextToImageOptions $options = new TextToImageOptions(),
    ): Response
    {
        return $this->connector->send(
            new TextToImageRequest($prompt, $options),
        );
    }

    /**
     * Create text to image with face swap.
     *
     * @param TextToImageWithFaceSwapOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function textToImageWithFaceSwap(
        string $prompt,
        string $sourceUrl,
        TextToImageWithFaceSwapOptions $options = new TextToImageWithFaceSwapOptions(),
    ): Response
    {
        return $this->connector->send(
            new TextToImageWithFaceSwapRequest($prompt, $sourceUrl, $options),
        );
    }

}
