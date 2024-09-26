<?php

namespace GlobalModerators\AiaConnector\Requests\Images\Data;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Traits\Makeable;

class CreateTextToImageOptions implements Arrayable
{
    use Makeable;

    public string $systemPrompt;

    /**
     * Return the array representation of the character options.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'system_prompt' => $this->systemPrompt,
        ];
    }

    /**
     * Set the system prompt for the character.
     *
     * @param string $systemPrompt
     * @return $this
     */
    public function setSystemPrompt(string $systemPrompt): self
    {
        $this->systemPrompt = $systemPrompt;

        return $this;
    }
}
