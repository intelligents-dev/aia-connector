<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

class TextToImageWithFaceSwapOptions extends ImageOptions
{
    public ?float $startAt = null;

    public ?float $endAt = null;

    public ?float $weight = null;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'start_at' => $this->startAt,
            'end_at' => $this->endAt,
            'weight' => $this->weight,
            ...parent::toArray(),
        ];
    }

    /**
     * Set the start merge step for the image.
     *
     * @param float $startAt
     * @return $this
     */
    public function setStartAt(float $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Set the end merge step for the image.
     *
     * @param float $endAt
     * @return $this
     */
    public function setEndAt(float $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Set the weight.
     *
     * @param float $weight
     * @return $this
     */
    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
