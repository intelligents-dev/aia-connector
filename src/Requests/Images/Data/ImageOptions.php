<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

abstract class ImageOptions implements Arrayable
{
    use Makeable;

    public ?string $schedulerName = null;

    public ?int $numInferenceSteps = null;

    public ?float $guidanceScale = null;

    public ?array $webhookUrls = null;

    public ?int $priority = null;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'scheduler_name' => $this->schedulerName,
            'num_inference_steps' => $this->numInferenceSteps,
            'guidance_scale' => $this->guidanceScale,
            'webhook_urls' => $this->webhookUrls,
            'priority' => $this->priority,
        ];
    }

    /**
     * Set the scheduler name for the image.
     *
     * @param string|null $schedulerName
     * @return $this
     */
    public function setSchedulerName(?string $schedulerName): self
    {
        $this->schedulerName = $schedulerName;

        return $this;
    }

    /**
     * Set the number of inference steps for the image.
     *
     * @param int|null $numInferenceSteps
     * @return $this
     */
    public function setNumInferenceSteps(?int $numInferenceSteps): self
    {
        $this->numInferenceSteps = $numInferenceSteps;

        return $this;
    }

    /**
     * Set the guidance scale for the image.
     *
     * @param float|null $guidanceScale
     * @return $this
     */
    public function setGuidanceScale(?float $guidanceScale): self
    {
        $this->guidanceScale = $guidanceScale;

        return $this;
    }

    /**
     * Set webhook urls for the image
     *
     * @param string|array|null $webhookUrl
     * @return $this
     */
    public function setWebhookUrl(string|array|null $webhookUrl = []): self
    {
        if (is_array($webhookUrl)) {
            $this->webhookUrls = array_merge($this->webhookUrls, $webhookUrl);
        } else {
            $this->webhookUrls[] = $webhookUrl;
        }

        return $this;
    }

    /**
     * Set the priority offset (adds or removes priority) on the image queue.
     *
     * @param int|null $priority
     * @return $this
     */
    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
