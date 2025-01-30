<?php

namespace IntelligentsDev\AiaConnector\Resources;

use Saloon\Http\BaseResource;

class TextToSpeechResource extends BaseResource
{
    public function voices(): TextToSpeechVoiceResource
    {
        return new TextToSpeechVoiceResource($this->connector);
    }
}
