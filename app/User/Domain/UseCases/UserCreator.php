<?php

namespace App\User\Domain\UseCases;

use App\User\Domain\Exceptions\UserAlreadyExistsException;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserName;
use App\User\Domain\ValueObject\UserPassword;

class UserCreator
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly CheckUserDataAlreadyExists $dataAlreadyExists
    )
    {
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function handle(UserId $id, UserName $name, UserEmail $email, UserCpf $cpf, UserPassword $password): User
    {
        $this->dataAlreadyExists->handle($email, $cpf);

        $user = User::create($id, $name, $email, $cpf, $password);
        $this->repository->create($user);

        return $user;
    }
}