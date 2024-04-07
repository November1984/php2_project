<?php

namespace GeekBrains\MainLevel\Blog;

use InvalidArgumentException;

class UUID
{
    public static function random(): self
    {
        return new self(uuid_create(UUID_TYPE_RANDOM));
    }
    public function __construct(
        private string $uuidString
    )
    {
        if (!uuid_is_valid($uuidString))
        {
            throw new InvalidArgumentException(
                "Mailformed UUID: $this->uuidString"
            );
        }
    }
    public function __toString(): string
    {
        return $this->uuidString;
    }
}