<?php

namespace App\Shared\Application;

use App\Shared\Infrastructure\Bus\Messenger\MessengerQueryBus;
use App\User\Application\List\GetUsersHandler;
use App\User\Application\Get\GetUserByIdHandler;
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