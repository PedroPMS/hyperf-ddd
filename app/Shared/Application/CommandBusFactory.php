<?php

namespace App\Shared\Application;

use App\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use App\User\Application\Create\CreateUserCommandHandler;
use App\User\Application\Delete\DeleteUserByIdCommandHandler;
use App\User\Application\Update\UpdateUserCommandHandler;
use Psr\Container\ContainerInterface;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandHandlers = [
            make(CreateUserCommandHandler::class),
            make(UpdateUserCommandHandler::class),
            make(DeleteUserByIdCommandHandler::class),
        ];

        return make(MessengerCommandBus::class, compact('commandHandlers'));
    }
}