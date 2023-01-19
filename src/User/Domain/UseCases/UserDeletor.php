<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\UserRepository;
use Src\User\Domain\ValueObject\UserId;

class UserDeletor
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(UserId $id): void
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $this->repository->delete($id);
    }
}