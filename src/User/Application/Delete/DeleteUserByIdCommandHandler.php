<?php

namespace Src\User\Application\Delete;

use Src\Shared\Domain\Bus\Command\CommandHandlerInterface;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\UseCases\UserDeletor;
use Src\User\Domain\ValueObject\UserId;

final class DeleteUserByIdCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserDeletor $deletor)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(DeleteUserByIdCommand $command): void
    {
        $id = UserId::fromValue($command->id);

        $this->deletor->handle($id);
    }
}