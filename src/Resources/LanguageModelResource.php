<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\AiaConnector;
use IntelligentsDev\AiaConnector\Requests\LanguageModels\GetLanguageModelsRequest;
use Saloon\Http\BaseResource;
use Saloon\PaginationPlugin\PagedPaginator;

/**
 * Class LanguageModelResource
 *
 * @property AiaConnector $connector
 */
class LanguageModelResource extends BaseResource
{
    /**
     * Create text to image.
     *
     * @return PagedPaginator
     */
    public function all(): PagedPaginator
    {
        return $this->connector->paginate(
            GetLanguageModelsRequest::make(),
        );
    }
}
