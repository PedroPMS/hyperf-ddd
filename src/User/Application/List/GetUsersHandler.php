<?php

namespace Src\User\Application\List;

use Src\Shared\Domain\Bus\Query\QueryHandlerInterface;
use Src\User\Application\UsersResponse;
use Src\User\Domain\UseCases\UsersList;

class GetUsersHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UsersList $usersList)
    {
    }

    public function __invoke(GetUsersQuery $query): UsersResponse
    {
        $users = $this->usersList->handle();

        return UsersResponse::fromUsers($users);
    }
}