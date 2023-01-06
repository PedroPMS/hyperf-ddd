<?php

namespace App\Shared\Application;

use App\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use App\User\Application\Create\CreateUserCommandHandler;
use Psr\Container\ContainerInterface;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandHandlers = [
            make(CreateUserCommandHandler::class),
        ];

        return make(MessengerCommandBus::class, compact('commandHandlers'));
    }
}