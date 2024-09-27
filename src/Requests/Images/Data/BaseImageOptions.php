<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

abstract class BaseImageOptions implements Arrayable
{
    use Makeable;

    public ?string $schedulerName = 'Euler';

    public ?string $modelName = 'bodies-xl-00001.safetensors';

    public string $prompt;

    /**
     * This is only needed on model: bodies-xl-00001.safetensors, when we switch to the new model that Boris is training (expected to
     * arrive on October 2nd), we can clear this. This model doesn't need a negative prompt. It also doesn't need Lora's probably
     * (contact Boris for more information on this)
     *
     * @var string|null
     */
    public ?string $negativePrompt = '(tanned)2.0, (sunbath)2.0, bokeh effect, blur background, (deformed iris, deformed pupils, ' .
        ' semi-realistic, cgi, 3d, render, sketch, cartoon, drawing, anime, mutated hands and fingers:1.4), ' .
        '(deformed, distorted, disfigured:1.3), poorly drawn, bad anatomy, wrong anatomy, extra limb, missing limb, floating limbs, ' .
        'disconnected limbs, mutation, mutated, ugly, disgusting, amputation, UnrealisticDream, white doors, necklace, earrings';

    public ?int $numInferenceSteps = 25;

    public ?float $guidanceScale = 7.5;

    public ?int $height = 1024;

    public ?int $width = 1024;

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
     * BaseImageOptions constructor.
     */
    public function __construct()
    {
        $this->webhookUrls = [
            config('aia.image_callback_url'),
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
