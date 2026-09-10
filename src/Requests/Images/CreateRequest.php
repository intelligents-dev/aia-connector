<?php

namespace IntelligentsDev\AiaConnector\Requests\Images;

use IntelligentsDev\AiaConnector\Enums\Pipeline;
use IntelligentsDev\AiaConnector\Requests\Images\Data\ImageOptions;
use InvalidArgumentException;
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

    protected Pipeline|string $pipeline;

    public function __construct(
        Pipeline|string $pipeline,
        protected ImageOptions $options,
    ) {
        $this->pipeline = $this->resolvePipeline($pipeline);
    }

    public function resolveEndpoint(): string
    {
        $pipeline = $this->pipeline instanceof Pipeline ? $this->pipeline->value : $this->pipeline;

        return '/image/' . $pipeline;
    }

    private function resolvePipeline(Pipeline|string $pipeline): Pipeline|string
    {
        if ($pipeline instanceof Pipeline) {
            return $pipeline;
        }

        if ($pipeline === '') {
            throw new InvalidArgumentException('pipeline must not be empty');
        }

        return Pipeline::tryFrom($pipeline) ?? $pipeline;
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
