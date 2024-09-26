<?php

namespace GlobalModerators\AiaConnector\Data\Concerns;

trait Makeable
{
    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }
}
