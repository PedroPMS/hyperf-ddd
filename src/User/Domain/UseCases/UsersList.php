<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\UserRepository;
use Src\User\Domain\Users;

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