<?php

namespace App\User\Infrastructure\Database;

use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\Users;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use Exception;

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
        $this->model->newQuery()->create($user->jsonSerialize());
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

    public function findByEmail(UserEmail $email, ?UserId $excludeId = null): ?User
    {
        /** @var UserModel $userModel */
        $userModel = $this->model
            ->newQuery()
            ->where('email', $email->value())
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId->value()))
            ->first();

        if (!$userModel) {
            return null;
        }

        return $this->toDomain($userModel);
    }

    public function findByCpf(UserCpf $cpf, ?UserId $excludeId = null): ?User
    {
        /** @var UserModel $userModel */
        $userModel = $this->model
            ->newQuery()
            ->where('cpf', $cpf->value())
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId->value()))
            ->first();

        if (!$userModel) {
            return null;
        }

        return $this->toDomain($userModel);
    }

    public function update(User $user): void
    {
        $userModel = $this->model->newQuery()->find($user->id->value());
        $userModel->update($user->jsonSerialize());
    }

    /**
     * @throws Exception
     */
    public function delete(UserId $id): void
    {
        $userModel = $this->model->newQuery()->find($id->value());
        $userModel->delete();
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