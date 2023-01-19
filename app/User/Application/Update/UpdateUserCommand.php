<?php

namespace App\User\Application\Update;

use App\Shared\Domain\Bus\Command\CommandInterface;

class UpdateUserCommand implements CommandInterface
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $emal,
        public readonly string $cpf
    )
    {
    }
}