<?php

namespace GlobalModerators\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

abstract class BaseImageOptions implements Arrayable
{
    use Makeable;

    public ?string $schedulerName = null;

    public ?string $modelName = null;

    public string $prompt;

    public ?string $negativePrompt = null;

    public ?int $numInferenceSteps = null;

    public ?float $guidanceScale = null;

    public ?int $height = null;

    public ?int $width = null;

    public ?array $webhookUrls = null;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'scheduler_name' => $this->schedulerName,
            'model_name' => $this->modelName,
            'prompt' => $this->prompt,
            'negative_prompt' => $this->negativePrompt,
            'num_inference_steps' => $this->numInferenceSteps,
            'guidance_scale' => $this->guidanceScale,
            'height' => $this->height,
            'width' => $this->width,
            'webhook_urls' => $this->webhookUrls,
        ];
    }

    /**
     * Set the scheduler name for the image.
     *
     * @param string $schedulerName
     * @return $this
     */
    public function setSchedulerName(string $schedulerName): self
    {
        $this->schedulerName = $schedulerName;

        return $this;
    }

    /**
     * Set the model name for the image.
     *
     * @param string $modelName
     * @return $this
     */
    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    /**
     * Set the prompt for the image.
     *
     * @param string $prompt
     * @return $this
     */
    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * Set the negative prompt for the image.
     *
     * @param string $negativePrompt
     * @return $this
     */
    public function setNegativePrompt(string $negativePrompt): self
    {
        $this->negativePrompt = $negativePrompt;

        return $this;
    }

    /**
     * Set the number of inference steps for the image.
     *
     * @param int $numInferenceSteps
     * @return $this
     */
    public function setNumInferenceSteps(int $numInferenceSteps): self
    {
        $this->numInferenceSteps = $numInferenceSteps;

        return $this;
    }

    /**
     * Set the guidance scale for the image.
     *
     * @param float $guidanceScale
     * @return $this
     */
    public function setGuidanceScale(float $guidanceScale): self
    {
        $this->guidanceScale = $guidanceScale;

        return $this;
    }

    /**
     * Set the height for the image.
     *
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set the width for the image.
     *
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set webhook urls for the image
     *
     * @param string|array $webhookUrl
     * @return $this
     */
    public function setWebhookUrl(string|array $webhookUrl = []): self
    {
        if (is_array($webhookUrl)) {
            $this->webhookUrls = array_merge($this->webhookUrls, $webhookUrl);
        } else {
            $this->webhookUrls[] = $webhookUrl;
        }

        return $this;
    }
}
