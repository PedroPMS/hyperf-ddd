<?php

namespace App\User\Application;

use App\Shared\Domain\Bus\Query\ResponseInterface;
use App\User\Domain\User;

final class UserResponse implements ResponseInterface
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $cpf,
    ) {
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id->value(),
            $user->name->value(),
            $user->email->value(),
            $user->cpf->value()
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
        ];
    }
}