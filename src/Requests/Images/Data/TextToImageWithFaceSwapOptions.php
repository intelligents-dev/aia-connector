<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

class TextToImageWithFaceSwapOptions extends ImageOptions
{
    public ?float $startAt = null;

    public ?float $endAt = null;

    public ?float $weight = null;

    public ?int $startMergeStep = null;

    public ?string $breastPrompt = null;

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
            'start_merge_step' => $this->startMergeStep,
            'breast_prompt' => $this->breastPrompt,
            ...parent::toArray(),
        ];
    }

    /**
     * Set the start merge step for the image.
     *
     * @param float|null $startAt
     * @return $this
     */
    public function setStartAt(?float $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Set the end merge step for the image.
     *
     * @param float|null $endAt
     * @return $this
     */
    public function setEndAt(?float $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Set the weight.
     *
     * @param float|null $weight
     * @return $this
     */
    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Set the start merge step.
     *
     * @param int|null $startMergeStep
     * @return $this
     */
    public function setStartMergeStep(?int $startMergeStep): self
    {
        $this->startMergeStep = $startMergeStep;

        return $this;
    }

    /**
     * Set the breast prompt for the image.
     *
     * @param string|null $breastPrompt
     * @return $this
     */
    public function setBreastPrompt(?string $breastPrompt): self
    {
        $this->breastPrompt = $breastPrompt;

        return $this;
    }
}
