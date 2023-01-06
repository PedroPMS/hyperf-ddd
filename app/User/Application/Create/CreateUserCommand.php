<?php

namespace App\User\Application\Create;

use App\Shared\Domain\Bus\Command\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $emal,
        public readonly string $cpf,
        public readonly string $password,
    )
    {
    }
}