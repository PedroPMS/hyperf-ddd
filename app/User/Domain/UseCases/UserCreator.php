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
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function handle(UserId $id, UserName $name, UserEmail $email, UserCpf $cpf, UserPassword $password): User
    {
        $userEmail = $this->repository->findByEmail($email);
        if ($userEmail) {
            throw UserAlreadyExistsException::emailAlreadyExists();
        }

        $userByCpf = $this->repository->findByCpf($cpf);
        if ($userByCpf) {
            throw UserAlreadyExistsException::cpfAlreadyExists();
        }

        $user = User::create($id, $name, $email, $cpf, $password);
        $this->repository->create($user);

        return $user;
    }
}