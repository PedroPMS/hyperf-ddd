<?php

namespace App\User\Infrastructure\Database;

use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\Users;

final class UserHyperfRepository implements UserRepository
{
    private UserModel $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function getAll(): Users
    {
        $users = $this->model->newQuery()->get();

        $users = $users->map(
            function (UserModel $userModel) {
                return $this->toDomain($userModel);
            }
        )->toArray();

        return new Users($users);
    }

    public function create(User $user): void
    {
        // TODO: Implement create() method.
    }

    private function toDomain(UserModel $userModel): User
    {
        return User::fromPrimitives(
            $userModel->id,
            $userModel->name,
            $userModel->email,
            $userModel->cpf,
            $userModel->password,
        );
    }
}