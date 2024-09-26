<?php

namespace GlobalModerators\AiaConnector\Data\Concerns;

trait Makeable
{
    public static function make(): static
    {
        return new static();
    }
}
