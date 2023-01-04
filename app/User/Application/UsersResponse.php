<?php

namespace App\User\Application;

use App\Shared\Domain\Bus\Query\ResponseInterface;
use App\User\Domain\User;
use App\User\Domain\Users;

final class UsersResponse implements ResponseInterface
{
    /**
     * @param array<UserResponse> $users
     */
    public function __construct(private readonly array $users)
    {
    }

    public static function fromUsers(Users $users): self
    {
        $userResponses = array_map(
            function (User $user) {
                return UserResponse::fromUser($user);
            },
            $users->all()
        );

        return new self($userResponses);
    }

    public function jsonSerialize(): array
    {
        return array_map(function (UserResponse $userResponse) {
            return $userResponse->jsonSerialize();
        }, $this->users);
    }
}