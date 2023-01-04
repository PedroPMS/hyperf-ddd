<?php

namespace App\User\Domain;

use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserName;
use App\User\Domain\ValueObject\UserPassword;
use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        public readonly UserId       $id,
        public readonly UserName     $name,
        public readonly UserEmail    $email,
        public readonly UserCpf      $cpf,
        public readonly UserPassword $password,
    )
    {
    }

    public static function fromPrimitives(string $id, string $name, string $email, string $cpf, string $password): self
    {
        return new self(
            UserId::fromValue($id),
            UserName::fromValue($name),
            UserEmail::fromValue($email),
            UserCpf::fromValue($cpf),
            UserPassword::fromValue($password),
        );
    }

    public static function create(UserId $id, UserName $name, UserEmail $email, UserCpf $cpf, UserPassword $password): self
    {
        return new self($id, $name, $email, $cpf,  $password);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => $this->password,
        ];
    }
}