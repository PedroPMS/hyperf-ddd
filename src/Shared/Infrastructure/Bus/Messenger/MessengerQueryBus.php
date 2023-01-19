<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Bus\Messenger;

use Src\Shared\Domain\Bus\Query\QueryInterface;
use Src\Shared\Domain\Bus\Query\QueryBusInterface;
use Src\Shared\Domain\Bus\Query\ResponseInterface;
use Src\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Src\Shared\Infrastructure\Bus\QueryNotRegisteredException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

final class MessengerQueryBus implements QueryBusInterface
{
    private MessageBus $bus;

    public function __construct(iterable $queryHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(CallableFirstParameterExtractor::forCallables($queryHandlers))
                ),
            ]
        );
    }

    /**
     * @throws Throwable
     * @throws QueryNotRegisteredException
     */
    public function ask(QueryInterface $query): ?ResponseInterface
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException) {
            throw new QueryNotRegisteredException("Query " . get_class($query) . " not registered.");
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious() ?? $error;
        }
    }
}