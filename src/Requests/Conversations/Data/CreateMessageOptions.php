<?php

namespace IntelligentsDev\AiaConnector\Requests\Conversations\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

class CreateMessageOptions implements Arrayable
{
    use Makeable;

    public ?string $systemPrompt = null;

    public ?float $temperature = 0;

    public ?int $maxTokens = 200;

    public ?float $topP = 1;

    public ?float $topK = 1;

    /**
     * Return the array representation of the message options.
     *
     * @return array
     */
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
     * @param float $temperature
     * @return $this
     */
    public function setTemperature(float $temperature): self
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
    public function setMaxTokens(int $maxTokens): self
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
    public function setTopP(float $topP): self
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
     * @param float $topK
     * @return $this
     */
    public function setTopK(float $topK): self
    {
        if ($topK < 0 || $topK > 2048) {
            throw new \InvalidArgumentException('Top K should be between 0 and 2048.');
        }

        $this->topK = $topK;

        return $this;
    }
}
