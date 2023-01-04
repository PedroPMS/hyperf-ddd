<?php

namespace App\User\Application\List;

use App\Shared\Domain\Bus\Query\QueryHandlerInterface;
use App\User\Application\UsersResponse;
use App\User\Domain\UseCases\UsersList;

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