<?php declare(strict_types=1);

namespace App\User\Presentation;

use App\Controller\AbstractController;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\Database\UserModel;
use Hyperf\Database\Model\Model;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

class UserController extends AbstractController
{
    public function index(UserRepository $repository, ResponseInterface $response): Psr7ResponseInterface
    {
        return $response->json($repository->getAll()->all());
    }

    public function show(string $id): UserModel
    {
        return UserModel::find($id);
    }

    public function store(RequestInterface $request): UserModel|Model
    {
        return UserModel::create($request->all());
    }

    public function delete(string $id): int
    {
        return UserModel::destroy($id);
    }
}
