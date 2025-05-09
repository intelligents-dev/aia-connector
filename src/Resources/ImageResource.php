<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\Images\CancelImageJobsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\CheckpointsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageOptions;
use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageWithFaceSwapOptions;
use IntelligentsDev\AiaConnector\Requests\Images\LorasRequest;
use IntelligentsDev\AiaConnector\Requests\Images\ModelsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\SchedulersRequest;
use IntelligentsDev\AiaConnector\Requests\Images\ShowImageRequest;
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
     * @param string $prompt
     * @param TextToImageOptions $options
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function textToImage(
        string $prompt,
        TextToImageOptions $options = new TextToImageOptions(),
    ): Response {
        return $this->connector->send(
            new TextToImageRequest($prompt, $options),
        );
    }

    /**
     * Create text to image with face swap.
     *
     * @param string $prompt
     * @param string $sourceUrl
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
    ): Response {
        return $this->connector->send(
            new TextToImageWithFaceSwapRequest($prompt, $sourceUrl, $options),
        );
    }

    public function cancelImageJobs(array $imageIds): Response
    {
        return $this->connector->send(new CancelImageJobsRequest($imageIds));
    }

    /**
     * Get all Loras
     *
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function loras(
    ): Response {
        return $this->connector->send(new LorasRequest());
    }

    /**
     * Get all Checkpoints
     *
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function checkpoints(
    ): Response {
        return $this->connector->send(new CheckpointsRequest());
    }

    /**
     * Get all Models
     *
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function models(
    ): Response {
        return $this->connector->send(new ModelsRequest());
    }

    /**
     * Get all schedulers
     *
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function schedulers(
    ): Response {
        return $this->connector->send(new SchedulersRequest());
    }

    /**
     * Gets image by id
     *
     * @param int $imageId
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function show(int $imageId): Response
    {
        return $this->connector->send(new ShowImageRequest($imageId));
    }
}
