<?php

namespace GlobalModerators\AiaConnector\Requests\Images;

use GlobalModerators\AiaConnector\Requests\Images\Data\CreateTextToImageWithFaceSwapOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateTextToImageWithFaceSwapRequest extends Request implements HasBody
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
        return '/image/text-to-image-with-face-swap';
    }

    /**
     * @param CreateTextToImageWithFaceSwapOptions $options
     */
    public function __construct(
        protected CreateTextToImageWithFaceSwapOptions $options,
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
