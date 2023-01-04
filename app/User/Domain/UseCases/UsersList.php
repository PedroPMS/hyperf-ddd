<?php

namespace App\User\Domain\UseCases;

use App\User\Domain\UserRepository;
use App\User\Domain\Users;

class UsersList
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function handle(): Users
    {
        return $this->repository->getAll();
    }
}