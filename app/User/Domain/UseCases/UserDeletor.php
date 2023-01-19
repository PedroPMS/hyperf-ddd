<?php

namespace App\User\Domain\UseCases;

use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\UserId;

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