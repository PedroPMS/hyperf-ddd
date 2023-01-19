<?php

namespace App\User\Domain\UseCases;

use App\User\Domain\Exceptions\UserAlreadyExistsException;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;

class CheckUserDataAlreadyExists
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function handle(UserEmail $email, UserCpf $cpf, ?UserId $id = null): void
    {
        if ($this->repository->findByEmail($email, $id)) {
            throw UserAlreadyExistsException::emailAlreadyExists();
        }

        if ($this->repository->findByCpf($cpf, $id)) {
            throw UserAlreadyExistsException::cpfAlreadyExists();
        }
    }
}