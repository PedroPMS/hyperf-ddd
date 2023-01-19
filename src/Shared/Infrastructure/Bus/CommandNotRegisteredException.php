<?php

namespace Src\Shared\Infrastructure\Bus;

use Src\Shared\Infrastructure\InfrastructureException;
use Throwable;

final class CommandNotRegisteredException extends InfrastructureException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Command not registered" : $message;
        parent::__construct($message, $code, $previous);
    }
}