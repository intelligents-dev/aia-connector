<?php

namespace IntelligentsDev\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

class ImageOptions implements Arrayable
{
    use Makeable;

    public ?string $modelName = null;

    public ?array $webhookUrls = null;

    public ?int $priority = null;

    public ?array $meta = null;

    public ?array $data = null;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'model_name' => $this->modelName,
            'webhook_urls' => $this->webhookUrls,
            'priority' => $this->priority,
            'meta' => $this->meta,
            ...$this->data,
        ];
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

    /**
     * Set the meta for the image.
     *
     * @param array|null $meta
     * @return $this
     */
    public function setMeta(?array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Set tje data for the image.
     *
     * @param array|null $data
     * @return $this
     */
    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }
}
