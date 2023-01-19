<?php

namespace Src\User\Domain;

use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;

interface UserRepository
{
    public function getAll(): Users;

    public function findById(UserId $id): ?User;

    public function findByEmail(UserEmail $email, ?UserId $excludeId = null): ?User;

    public function findByCpf(UserCpf $cpf, ?UserId $excludeId = null): ?User;

    public function create(User $user): void;

    public function delete(UserId $id): void;

    public function update(User $user): void;
}