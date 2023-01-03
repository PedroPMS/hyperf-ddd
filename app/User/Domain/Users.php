<?php

declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\AbstractCollection;

final class Users extends AbstractCollection
{
    protected function type(): string
    {
        return User::class;
    }
}