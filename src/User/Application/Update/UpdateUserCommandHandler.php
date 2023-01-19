<?php

namespace Src\User\Application\Update;

use Src\Shared\Domain\Bus\Query\QueryHandlerInterface;
use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\UseCases\UserUpdater;
use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserName;

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