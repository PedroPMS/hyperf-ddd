<?php

namespace App\User\Application\Get;

use App\Shared\Domain\Bus\Query\QueryInterface;

class GetUserByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $id)
    {
    }
}