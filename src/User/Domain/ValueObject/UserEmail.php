<?php

declare(strict_types=1);

namespace Src\User\Domain\ValueObject;

use Src\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

final class UserEmail extends StringValueObject
{
    public function __construct(public string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address');
        }

        parent::__construct($value);
    }
}