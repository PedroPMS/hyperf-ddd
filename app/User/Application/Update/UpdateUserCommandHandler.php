<?php

namespace App\User\Application\Update;

use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\User\Domain\Exceptions\UserAlreadyExistsException;
use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\UseCases\UserUpdater;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserName;

class UpdateUserCommandHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserUpdater $userUpdater)
    {
    }

    /**
     * @throws UserAlreadyExistsException|UserNotFoundException
     */
    public function __invoke(UpdateUserCommand $query): void
    {
        $id = UserId::fromValue($query->id);
        $name = UserName::fromValue($query->name);
        $email = UserEmail::fromValue($query->emal);
        $cpf = UserCpf::fromValue($query->cpf);


        $this->userUpdater->handle($id, $name, $email, $cpf);
    }
}