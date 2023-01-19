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
    \Src\Shared\Domain\UuidGeneratorInterface::class => \Src\Shared\Infrastructure\RamseyUuidGenerator::class,
    \Src\User\Domain\UserRepository::class => \Src\User\Infrastructure\Database\UserHyperfRepository::class,
    \Src\Shared\Domain\Bus\Query\QueryBusInterface::class => \Src\Shared\Application\QueryBusFactory::class,
    \Src\Shared\Domain\Bus\Command\CommandBusInterface::class => \Src\Shared\Application\CommandBusFactory::class,
];
