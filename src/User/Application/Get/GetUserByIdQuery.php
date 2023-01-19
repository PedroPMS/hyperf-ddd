<?php

namespace Src\User\Application\Get;

use Src\Shared\Domain\Bus\Query\QueryInterface;

class GetUserByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}