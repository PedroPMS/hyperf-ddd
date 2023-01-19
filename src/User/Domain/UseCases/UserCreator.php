<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\User;
use Src\User\Domain\UserRepository;
use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserName;
use Src\User\Domain\ValueObject\UserPassword;

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