<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data;

use Illuminate\Contracts\Support\Arrayable;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageType;
use Saloon\Traits\Makeable;

class UpdateConversationMessageOptions implements Arrayable
{
    use Makeable;

    public ?string $content = null;

    public ?string $meta = null;

    public ?ConversationMessageType $type = null;

    /**
     * Return the array representation of the message options.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'meta' => $this->meta,
            'type' => $this->type?->value,
        ];
    }

    /**
     * Set content for message
     *
     * @param string|null $content
     * @return $this
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set meta for the message.
     *
     * @param string|null $meta
     * @return $this
     */
    public function setMeta(?string $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Set the message type for the message.
     *
     * @param ConversationMessageType|null $type
     * @return $this
     */
    public function setType(?ConversationMessageType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
