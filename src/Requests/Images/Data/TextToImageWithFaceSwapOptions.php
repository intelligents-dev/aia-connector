<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

class TextToImageWithFaceSwapOptions extends ImageOptions
{
    public ?float $startMergeStep = null;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'start_merge_step' => $this->startMergeStep,
            ...parent::toArray(),
        ];
    }

    /**
     * Set the start merge step for the image.
     *
     * @param float $startMergeStep
     * @return $this
     */
    public function setStartMergeStep(float $startMergeStep): self
    {
        $this->startMergeStep = $startMergeStep;

        return $this;
    }
}
