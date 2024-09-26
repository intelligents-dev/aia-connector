<?php

namespace GlobalModerators\AiaConnector\Requests\Images\Data;

class CreateTextToImageWithFaceSwapOptions extends BaseImageOptions
{
    public string $sourceUrl;

    public ?float $startMergeStep;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'source_url' => $this->sourceUrl,
            'start_merge_step' => $this->startMergeStep,
            ...parent::toArray(),
        ];
    }

    /**
     * Set the source URL for the image.
     *
     * @param string $sourceUrl
     * @return $this
     */
    public function setSourceUrl(string $sourceUrl): self
    {
        $this->sourceUrl = $sourceUrl;

        return $this;
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
