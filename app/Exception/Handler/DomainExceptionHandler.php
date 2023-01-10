<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Exception;
use App\Shared\Domain\DomainException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class DomainExceptionHandler extends \Hyperf\Validation\ValidationExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();
        $result = ['message' => $throwable->getMessage()];
        return $response->withStatus($throwable->getCode())
            ->withAddedHeader('content-type', 'application/json')
            ->withBody(new SwooleStream(json_encode($result, JSON_UNESCAPED_UNICODE)));
    }

    public function isValid(Throwable $throwable): bool
    {
        return ($throwable instanceof DomainException);
    }
}