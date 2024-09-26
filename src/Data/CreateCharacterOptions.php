<?php

namespace GlobalModerators\AiaConnector\Data;

use GlobalModerators\AiaConnector\Data\Concerns\Makeable;
use Illuminate\Contracts\Support\Arrayable;

class CreateCharacterOptions implements Arrayable
{
    use Makeable;

    public function __construct(
        public string $name,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * Set the name for the character.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
