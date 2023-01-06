<?php

namespace App\User\Domain;

use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;

interface UserRepository
{
    public function getAll(): Users;

    public function findById(UserId $id): ?User;

    public function findByEmail(UserEmail $email): ?User;

    public function findByCpf(UserCpf $cpf): ?User;

    public function create(User $user): void;
}