<?php

namespace GlobalModerators\AiaConnector\Data;

use GlobalModerators\AiaConnector\Data\Concerns\Makeable;
use Illuminate\Contracts\Support\Arrayable;

class CreateMessageOptions implements Arrayable
{
    use Makeable;

    public function __construct(
        public ?string $systemPrompt = null,
        public ?int $temperature = null,
        public ?int $maxTokens = null,
        public ?int $topP = null,
        public ?int $topK = 0,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'system_prompt' => $this->systemPrompt,
            'temperature' => $this->temperature,
            'max_tokens' => $this->maxTokens,
            'top_p' => $this->topP,
            'top_k' => $this->topK,
        ];
    }

    /**
     * Set the system prompt for the message.
     *
     * @param string $systemPrompt
     * @return $this
     */
    public function setSystemPrompt(string $systemPrompt): self
    {
        $this->systemPrompt = $systemPrompt;

        return $this;
    }

    /**
     * Set the temperature for the message.
     *
     * @param int $temperature
     * @return $this
     */
    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Set the max tokens for the message.
     *
     * @param int $maxTokens
     * @return $this
     */
    public function setMaxTokens(int $maxTokens): self
    {
        $this->maxTokens = $maxTokens;

        return $this;
    }

    /**
     * Set the top p for the message.
     *
     * @param int $topP
     * @return $this
     */
    public function setTopP(int $topP): self
    {
        $this->topP = $topP;

        return $this;
    }

    /**
     * Set the top k for the message.
     *
     * @param int $topK
     * @return $this
     */
    public function setTopK(int $topK): self
    {
        $this->topK = $topK;

        return $this;
    }
}
