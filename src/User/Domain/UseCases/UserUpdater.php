<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\User;
use Src\User\Domain\UserRepository;
use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserName;

class UserUpdater
{
    public function __construct(
        private readonly UserRepository             $repository,
        private readonly UserFind                   $userFind,
        private readonly CheckUserDataAlreadyExists $dataAlreadyExists
    )
    {
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws UserNotFoundException
     */
    public function handle(UserId $id, UserName $name, UserEmail $email, UserCpf $cpf): User
    {
        $user = $this->userFind->handle($id);
        $this->dataAlreadyExists->handle($email, $cpf, $id);

        $user = User::create($id, $name, $email, $cpf, $user->password);
        $this->repository->update($user);

        return $user;
    }
}