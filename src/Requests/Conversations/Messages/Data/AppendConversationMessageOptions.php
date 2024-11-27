<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data;

use Illuminate\Contracts\Support\Arrayable;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageContentType;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageRole;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageType;
use Saloon\Traits\Makeable;

class AppendConversationMessageOptions implements Arrayable
{
    use Makeable;

    public ?string $meta = null;

    public ?ConversationMessageType $type = null;

    public ?ConversationMessageRole $role = null;

    private function __construct(
        public string $content,
    ) {}

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
            'role' => $this->role?->value,
        ];
    }

    /**
     * Set content for the message.
     *
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set meta for the message.
     *
     * @param string $meta
     * @return $this
     */
    public function setMeta(?string $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Set the type for the message.
     *
     * @param null|ConversationMessageRole $type
     * @return $this
     */
    public function setType(?ConversationMessageType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the role for the message.
     *
     * @param null|ConversationMessageRole $role
     * @return $this
     */
    public function setRole(?ConversationMessageRole $role): self
    {
        $this->role = $role;

        return $this;
    }
}
