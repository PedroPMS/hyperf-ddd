<?php

namespace App\User\Application\Get;

use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\User\Application\UserResponse;
use App\User\Domain\Exceptions\UserNotFoundException;
use App\User\Domain\UseCases\UserFind;
use App\User\Domain\ValueObject\UserId;

class GetUserByIdHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserFind $userFind)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(GetUserByIdQuery $query): UserResponse
    {
        $id = UserId::fromValue($query->id);
        $user = $this->userFind->handle($id);

        return UserResponse::fromUser($user);
    }
}