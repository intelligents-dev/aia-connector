<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

class TextToImageOptions extends ImageOptions
{
    /**
     * This is only needed on model: bodies-xl-00001.safetensors, when we switch to the new model that Boris is training (expected to
     * arrive on October 2nd), we can clear this. This model doesn't need a negative prompt. It also doesn't need Lora's probably
     * (contact Boris for more information on this)
     *
     * @var string|null
     */
    public ?string $negativePrompt = null;

    public function toArray(): array
    {
        return [
            'negative_prompt' => $this->negativePrompt,
        ];
    }

    /**
     * Set the negative prompt for the image.
     *
     * @param string|null $negativePrompt
     * @return $this
     */
    public function setNegativePrompt(?string $negativePrompt): self
    {
        $this->negativePrompt = $negativePrompt;

        return $this;
    }
}
