<?php

namespace App\User\Application\Create;

use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\Shared\Domain\UuidGeneratorInterface;
use App\User\Domain\Exceptions\UserAlreadyExistsException;
use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\UseCases\UserCreator;
use App\User\Domain\ValueObject\UserCpf;
use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserName;
use App\User\Domain\ValueObject\UserPassword;

class CreateUserCommandHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserCreator $userCreator, private readonly UuidGeneratorInterface $uuidGenerator)
    {
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function __invoke(CreateUserCommand $query): void
    {
        $id = UserId::fromValue($this->uuidGenerator->generate());
        $name = UserName::fromValue($query->name);
        $email = UserEmail::fromValue($query->emal);
        $cpf = UserCpf::fromValue($query->cpf);
        $password = UserPassword::fromValue($query->password);
        $this->userCreator->handle($id, $name, $email, $cpf, $password);
    }
}