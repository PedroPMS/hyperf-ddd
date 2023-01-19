<?php

declare(strict_types=1);

use Src\User\Presentation\UserController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::addGroup('/users', function () {
    Router::get('', [UserController::class, 'index']);
    Router::get('/{id}', [UserController::class, 'show']);
    Router::post('', [UserController::class, 'store']);
    Router::delete('/{id}', [UserController::class, 'delete']);
    Router::put('/{id}', [UserController::class, 'update']);
});

Router::get('/favicon.ico', function () {
    return '';
});
