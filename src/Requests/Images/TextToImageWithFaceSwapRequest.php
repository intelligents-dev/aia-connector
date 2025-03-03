<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use IntelligentsDev\AiaConnector\Requests\Images\Data\TextToImageWithFaceSwapOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class TextToImageWithFaceSwapRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $prompt,
        protected string $sourceUrl,
        protected TextToImageWithFaceSwapOptions $options,
    ) {}

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
     * The default body for the request.
     *
     * @return array
     */
    protected function defaultBody(): array
    {
        return [
            ...$this->options->toArray(),
            'prompt' => $this->prompt,
            'source_url' => $this->sourceUrl,
        ];
    }
}
