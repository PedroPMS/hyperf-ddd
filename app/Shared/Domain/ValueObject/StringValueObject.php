<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use JsonSerializable;

abstract class StringValueObject implements JsonSerializable
{
    public function __construct(public string $value)
    {
    }

    public static function fromValue(string $value): static
    {
        return new static($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}