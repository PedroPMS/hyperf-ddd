<?php

namespace App\User\Application\Delete;

use App\Shared\Domain\Bus\Command\CommandInterface;

final class DeleteUserByIdCommand implements CommandInterface
{
    public function __construct(public readonly string $id)
    {
    }
}