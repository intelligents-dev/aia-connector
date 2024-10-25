<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

class UpdateConversationOptions implements Arrayable
{
    use Makeable;

    public ?string $languageModel = null;

    public ?string $systemPrompt = null;

    public ?string $prefixPrompt = null;

    /**
     * Return the array representation of the conversation options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'language_model' => $this->languageModel,
            'system_prompt' => $this->systemPrompt,
            'prefix_prompt' => $this->prefixPrompt,
        ];
    }

    /**
     * Set the language model for the conversation.
     *
     * @param string|null $languageModel
     * @return $this
     */
    public function setLanguageModel(?string $languageModel): self
    {
        $this->languageModel = $languageModel;

        return $this;
    }

    /**
     * Set the system prompt for the conversation.
     *
     * @param string|null $systemPrompt
     * @return $this
     */
    public function setSystemPrompt(?string $systemPrompt): self
    {
        $this->systemPrompt = $systemPrompt;

        return $this;
    }

    /**
     * Set the prefix prompt for the conversation.
     *
     * @param string|null $prefixPrompt
     * @return $this
     */
    public function setPrefixPrompt(?string $prefixPrompt): self
    {
        $this->prefixPrompt = $prefixPrompt;

        return $this;
    }
}
