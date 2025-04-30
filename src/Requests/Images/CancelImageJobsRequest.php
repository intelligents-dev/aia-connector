<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CancelImageJobsRequest extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected array $imageIds = [],
    ) {}

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/image/cancel';
    }

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'image_ids' => $this->imageIds,
        ];
    }
}
