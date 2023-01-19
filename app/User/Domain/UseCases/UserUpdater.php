<?php

namespace App\User\Domain\UseCases;

use App\User\Domain\Exceptions\UserAlreadyExistsException;
use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserName;

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