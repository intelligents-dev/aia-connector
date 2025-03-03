<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class TextToImageRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * @param string $prompt
     * @param TextToImageOptions $options
     */
    public function __construct(
        protected string $prompt,
        protected TextToImageOptions $options,
    ) {}

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
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            'prompt' => $this->prompt,
            ...$this->options->toArray(),
        ];
    }
}
