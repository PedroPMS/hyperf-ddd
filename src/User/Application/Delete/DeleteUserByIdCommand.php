<?php

namespace Src\User\Application\Delete;

use Src\Shared\Domain\Bus\Command\CommandInterface;

final class DeleteUserByIdCommand implements CommandInterface
{
    public function __construct(public readonly string $id)
    {
    }
}