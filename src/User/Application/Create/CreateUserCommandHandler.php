<?php

namespace Src\User\Application\Create;

use Src\Shared\Domain\Bus\Query\QueryHandlerInterface;
use Src\Shared\Domain\UuidGeneratorInterface;
use Src\User\Domain\Exceptions\UserAlreadyExistsException;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\UseCases\UserCreator;
use Src\User\Domain\ValueObject\UserCpf;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserName;
use Src\User\Domain\ValueObject\UserPassword;

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