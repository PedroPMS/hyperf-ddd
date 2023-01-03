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

use App\Controller\UserController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/testes', 'App\Controller\UserController@index');
Router::addGroup('/users', function () {
//    Router::get('/{id}', [UserController::class, 'show']);
//    Router::post('', [UserController::class, 'store']);
//    Router::delete('/{id}', [UserController::class, 'delete']);
});

Router::get('/favicon.ico', function () {
    return '';
});
