<?php

namespace IntelligentsDev\AiaConnector\Requests\TextToSpeech\Voices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\Traits\Body\HasJsonBody;

class SynthesizeRequest extends Request implements HasBody, Paginatable
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return sprintf('/tts/voices/%d/synthesize', $this->voiceId);
    }

    public function __construct(
        protected int $voiceId,
        protected string $text,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
