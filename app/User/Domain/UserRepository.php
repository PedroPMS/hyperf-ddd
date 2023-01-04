<?php

namespace App\User\Domain;

use App\User\Domain\ValueObject\UserId;

interface UserRepository
{
    public function getAll(): Users;

    public function findById(UserId $id): ?User;

    public function create(User $user): void;
}