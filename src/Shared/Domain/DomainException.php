<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

use Exception;

abstract class DomainException extends Exception
{
    protected $code = 400;
}