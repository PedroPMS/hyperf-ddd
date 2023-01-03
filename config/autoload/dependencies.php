<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    \App\Shared\Domain\UuidGeneratorInterface::class => \App\Shared\Infrastructure\RamseyUuidGenerator::class,
    \App\User\Domain\UserRepository::class => \App\User\Infrastructure\Database\UserHyperfRepository::class,
];
