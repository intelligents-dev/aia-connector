<?php

namespace GlobalModerators\AiaConnector\Requests\Images\Data;

class CreateTextToImageOptions extends BaseImageOptions
{
    public float $loraScale = 1;

    public string $loraWeightName = 'al-faces-2.safetensors';

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'lora_scale' => $this->loraScale,
            'lora_weight_name' => $this->loraWeightName,
            ...parent::toArray(),
        ];
    }

    /**
     * Set the LoRA scale for the image.
     *
     * @param float $loraScale
     * @return $this
     */
    public function setLoraScale(float $loraScale): self
    {
        $this->loraScale = $loraScale;

        return $this;
    }

    /**
     * Set the LoRA weight name for the image.
     *
     * @param string $loraWeightName
     * @return $this
     */
    public function setLoraWeightName(string $loraWeightName): self
    {
        $this->loraWeightName = $loraWeightName;

        return $this;
    }
}
