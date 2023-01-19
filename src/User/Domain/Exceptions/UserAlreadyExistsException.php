<?php

namespace Src\User\Domain\Exceptions;

use Src\Shared\Domain\DomainException;
use Throwable;

final class UserAlreadyExistsException extends DomainException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        $message = '' === $message ? "User already exists" : $message;

        parent::__construct($message, $code, $previous);
    }

    public static function emailAlreadyExists(): self
    {
        return new self(
            'User with this email already exists.'
        );
    }

    public static function cpfAlreadyExists(): self
    {
        return new self(
            'User with this CPF already exists.'
        );
    }
}