<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use App\Exception;

class ValidationExceptionHandler extends \Hyperf\Validation\ValidationExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();
        $result = $throwable->validator->errors();
        return $response->withStatus($throwable->status)
            ->withAddedHeader('content-type', 'application/json')
            ->withBody(new SwooleStream(json_encode($result, JSON_UNESCAPED_UNICODE)));
    }

}