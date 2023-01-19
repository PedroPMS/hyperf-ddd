<?php

namespace Src\User\Domain\UseCases;

use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\User;
use Src\User\Domain\UserRepository;
use Src\User\Domain\ValueObject\UserId;

class UserFind
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(UserId $id): User
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}