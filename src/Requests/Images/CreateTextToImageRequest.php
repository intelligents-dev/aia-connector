<?php

namespace GlobalModerators\AiaConnector\Requests\Images;

use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTextToImageRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/image/text-to-image';
    }

    /**
     * @param CreateTextToImageOptions $options
     */
    public function __construct(
        protected CreateTextToImageOptions $options,
    ) {
        //
    }

    /**
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return $this->options->toArray();
    }
}
