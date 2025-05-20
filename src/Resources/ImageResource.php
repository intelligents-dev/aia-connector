<?php

namespace IntelligentsDev\AiaConnector\Resources;

use Exception;
use IntelligentsDev\AiaConnector\Enums\Pipeline;
use IntelligentsDev\AiaConnector\Requests\Images\CreateRequest;
use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use IntelligentsDev\AiaConnector\Requests\Images\ModelsRequest;
use IntelligentsDev\AiaConnector\Requests\Images\ShowImageRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ImageResource extends BaseResource
{
    /**
     * Create new image
     *
     * @param Pipeline|string $pipeline
     * @param ImageOptions $options
     * @return Response
     * @throws FatalRequestException
     * @throws RequestException
     * @throws Exception
     */
    public function create(
        Pipeline|string $pipeline,
        ImageOptions $options
    ): Response
    {
        return $this->connector->send(
            new CreateRequest($pipeline, $options)
        );
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

    /**
     * Get all models
     *
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function models(): Response
    {
        return $this->connector->send(new ModelsRequest());
    }
}
