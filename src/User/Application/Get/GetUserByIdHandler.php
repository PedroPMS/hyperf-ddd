<?php

namespace Src\User\Application\Get;

use Src\Shared\Domain\Bus\Query\QueryHandlerInterface;
use Src\User\Application\UserResponse;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\UseCases\UserFind;
use Src\User\Domain\ValueObject\UserId;

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