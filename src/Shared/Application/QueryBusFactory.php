<?php

namespace Src\Shared\Application;

use Src\Shared\Infrastructure\Bus\Messenger\MessengerQueryBus;
use Src\User\Application\List\GetUsersHandler;
use Src\User\Application\Get\GetUserByIdHandler;
use Psr\Container\ContainerInterface;

class QueryBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $queryHandlers = [
            make(GetUsersHandler::class),
            make(GetUserByIdHandler::class),
        ];

        return make(MessengerQueryBus::class, compact('queryHandlers'));
    }
}