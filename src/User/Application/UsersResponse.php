<?php

namespace Src\User\Application;

use Src\Shared\Domain\Bus\Query\ResponseInterface;
use Src\User\Domain\User;
use Src\User\Domain\Users;

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