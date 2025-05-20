<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use Exception;
use IntelligentsDev\AiaConnector\Enums\Pipeline;
use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The method to send the request with.
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    protected Pipeline $pipeline;

    /**
     * @param Pipeline|string $pipeline
     * @param ImageOptions $options
     * @throws Exception
     */
    public function __construct(
        Pipeline|string $pipeline,
        protected ImageOptions $options
    )
    {
        $this->pipeline = $pipeline instanceof Pipeline ? $pipeline : Pipeline::tryFrom($pipeline) ??
            throw new Exception('Unknown pipeline');
    }

    /**
     * The endpoint to send the request to.
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/image/' . $this->pipeline->value;
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
