<?php

namespace Src\Shared\Infrastructure\Bus;

use Src\Shared\Infrastructure\InfrastructureException;
use Throwable;

final class QueryNotRegisteredException extends InfrastructureException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "" === $message ? "Query not registered" : $message;
        parent::__construct($message, $code, $previous);
    }
}