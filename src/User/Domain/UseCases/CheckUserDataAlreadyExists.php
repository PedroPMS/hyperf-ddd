<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\UserRepository;
use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;

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