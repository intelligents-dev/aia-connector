<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

abstract class ImageOptions implements Arrayable
{
    use Makeable;

    public ?string $schedulerName = null;

    public ?string $modelName = null;

    /**
     * This is only needed on model: bodies-xl-00001.safetensors, when we switch to the new model that Boris is training (expected to
     * arrive on October 2nd), we can clear this. This model doesn't need a negative prompt. It also doesn't need Lora's probably
     * (contact Boris for more information on this)
     *
     * @var string|null
     */
    public ?string $negativePrompt = null;

    public ?int $numInferenceSteps = null;

    public ?float $guidanceScale = null;

    public ?int $height = null;

    public ?int $width = null;

    public ?string $loraWeightName = null;

    public ?float $loraScale = null;

    public ?array $webhookUrls = null;

    public ?float $shemaleStrength = null;

    public ?string $breastPrompt = null;

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
            'model_name' => $this->modelName,
            'negative_prompt' => $this->negativePrompt,
            'num_inference_steps' => $this->numInferenceSteps,
            'guidance_scale' => $this->guidanceScale,
            'height' => $this->height,
            'width' => $this->width,
            'webhook_urls' => $this->webhookUrls,
            'lora_weight_name' => $this->loraWeightName,
            'lora_scale' => $this->loraScale,
            'shemale_strength' => $this->shemaleStrength,
            'breast_prompt' => $this->breastPrompt,
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
     * Set the model name for the image.
     *
     * @param string|null $modelName
     * @return $this
     */
    public function setModelName(?string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
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
     * Set the height for the image.
     *
     * @param int|null $height
     * @return $this
     */
    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set the width for the image.
     *
     * @param int|null $width
     * @return $this
     */
    public function setWidth(?int $width): self
    {
        $this->width = $width;

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
     * Set the LoRA weight name for the image.
     *
     * @param string|null $weightName
     * @return $this
     */
    public function setLoraWeightName(?string $weightName): self
    {
        $this->loraWeightName = $weightName;

        return $this;
    }

    /**
     * Set the LoRA scale for the image.
     *
     * @param float|null $scale
     * @return $this
     */
    public function setLoraScale(?float $scale): self
    {
        $this->loraScale = $scale;

        return $this;
    }

    /**
     * Set the shemale strength for the image.
     *
     * @param float|null $shemaleStrength
     * @return $this
     */
    public function setShemaleStrength(?float $shemaleStrength): self
    {
        $this->shemaleStrength = $shemaleStrength;

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
