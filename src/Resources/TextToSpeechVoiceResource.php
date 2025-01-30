<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Requests\TextToSpeech\Voices\GetTextToSpeechVoicesRequest;
use IntelligentsDev\AiaConnector\Requests\TextToSpeech\Voices\SynthesizeRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

class TextToSpeechVoiceResource extends BaseResource
{
    public function all(): PagedPaginator
    {
        return $this->connector->paginate(
            GetTextToSpeechVoicesRequest::make(),
        );
    }

    public function synthesize(int $voiceId, string $text): Response
    {
        return $this->connector->send(new SynthesizeRequest($voiceId, $text));
    }
}
