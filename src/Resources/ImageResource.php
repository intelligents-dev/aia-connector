<?php

namespace IntelligentsDev\AiaConnector\Resources;

use IntelligentsDev\AiaConnector\Resources\Images\TextToImageResource;
use IntelligentsDev\AiaConnector\Resources\Images\TextToImageWithFaceSwapResource;
use Saloon\Http\BaseResource;

class ImageResource extends BaseResource
{
    public function textToImage(): TextToImageResource
    {
        return new TextToImageResource($this->connector);
    }

    public function textToImageWithFaceSwap(): TextToImageWithFaceSwapResource
    {
        return new TextToImageWithFaceSwapResource($this->connector);
    }
}
