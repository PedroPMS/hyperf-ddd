<?php

namespace App\User\Infrastructure\Database;

use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\Users;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;

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

    public function findById(UserId $id): ?User
    {
        /** @var UserModel $userModel */
        $userModel = $this->model->newQuery()->find($id->value());

        if (!$userModel) {
            return null;
        }

        return $this->toDomain($userModel);
    }

    public function create(User $user): void
    {
        $this->model->newQuery()->create($user->jsonSerialize());
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

    public function findByEmail(UserEmail $email): ?User
    {
        /** @var UserModel $userModel */
        $userModel = $this->model->newQuery()->where('email', $email->value())->first();

        if (!$userModel) {
            return null;
        }

        return $this->toDomain($userModel);
    }

    public function findByCpf(UserCpf $cpf): ?User
    {
        /** @var UserModel $userModel */
        $userModel = $this->model->newQuery()->where('cpf', $cpf->value())->first();

        if (!$userModel) {
            return null;
        }

        return $this->toDomain($userModel);
    }
}