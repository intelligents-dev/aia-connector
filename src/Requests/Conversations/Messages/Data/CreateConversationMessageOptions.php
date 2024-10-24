<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Messages\Data;

use Illuminate\Contracts\Support\Arrayable;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageContentType;
use IntelligentsDev\AiaConnector\Enums\ConversationMessageType;
use Saloon\Traits\Makeable;

class CreateConversationMessageOptions implements Arrayable
{
    use Makeable;

    public ?string $systemPrompt = null;

    public ?string $prefixPrompt = null;

    public ?string $languageModel = null;

    public ?float $temperature = null;

    public ?int $maxTokens = null;

    public ?float $topP = null;

    public ?int $topK = null;

    public ?ConversationMessageType $type = null;

    /**
     * Return the array representation of the message options.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'system_prompt' => $this->systemPrompt,
            'prefix_prompt' => $this->prefixPrompt,
            'temperature' => $this->temperature,
            'max_tokens' => $this->maxTokens,
            'top_p' => $this->topP,
            'top_k' => $this->topK,
            'type' => $this->type?->value,
            'language_model' => $this->languageModel,
        ];
    }

    /**
     * Set the system prompt for the message.
     *
     * @param string $systemPrompt
     * @return $this
     */
    public function setSystemPrompt(?string $systemPrompt): self
    {
        $this->systemPrompt = $systemPrompt;

        return $this;
    }

    /**
     * Set the prefix prompt for the message.
     *
     * @param string $prefixPrompt
     * @return $this
     */
    public function setPrefixPrompt(?string $prefixPrompt): self
    {
        $this->prefixPrompt = $prefixPrompt;

        return $this;
    }

    /**
     * Set the language model for the message.
     *
     * @param string $languageModel
     * @return $this
     */
    public function setLanguageModel(?string $languageModel): self
    {
        $this->languageModel = $languageModel;

        return $this;
    }

    /**
     * Set the temperature for the message.
     *
     * @param float $temperature
     * @return $this
     */
    public function setTemperature(?float $temperature): self
    {
        if ($temperature < 0 || $temperature > 2) {
            throw new \InvalidArgumentException('Temperature should be between 0 and 2.');
        }

        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Set the max tokens for the message.
     *
     * @param int $maxTokens
     * @return $this
     */
    public function setMaxTokens(?int $maxTokens): self
    {
        if ($maxTokens < 0 || $maxTokens > 2048) {
            throw new \InvalidArgumentException('Temperature should be between 1 and 2048.');
        }

        $this->maxTokens = $maxTokens;

        return $this;
    }

    /**
     * Set the top p for the message.
     *
     * @param float $topP
     * @return $this
     */
    public function setTopP(?float $topP): self
    {
        if ($topP < 0 || $topP > 1) {
            throw new \InvalidArgumentException('Top P should be between 0 and 1.');
        }

        $this->topP = $topP;

        return $this;
    }

    /**
     * Set the top k for the message.
     *
     * @param int $topK
     * @return $this
     */
    public function setTopK(?int $topK): self
    {
        if ($topK < 0 || $topK > 2048) {
            throw new \InvalidArgumentException('Top K should be between 0 and 2048.');
        }

        $this->topK = $topK;

        return $this;
    }

    /**
     * Set the message type for the message.
     *
     * @param ConversationMessageType $type
     * @return $this
     */
    public function setType(?ConversationMessageType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
