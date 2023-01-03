<?php

namespace App\User\Domain;

interface UserRepository
{
    public function getAll(): Users;

    public function create(User $user): void;
}