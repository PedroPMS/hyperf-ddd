<?php

namespace App\User\Application\Delete;

use App\Shared\Domain\Bus\Command\CommandHandlerInterface;
use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\UseCases\UserDeletor;
use App\User\Domain\ValueObject\UserId;

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