<?php declare(strict_types=1);

namespace App\User\Presentation;

use App\Controller\AbstractController;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\User\Application\Get\GetUserByIdQuery;
use App\User\Application\List\GetUsersQuery;
use App\User\Infrastructure\Database\UserModel;
use Hyperf\Database\Model\Model;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends AbstractController
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
        parent::__construct();
    }

    public function index(): ResponseInterface
    {
        $usersResponse = $this->queryBus->ask(new GetUsersQuery());

        return $this->response->json($usersResponse->jsonSerialize());
    }

    public function show(string $id): ResponseInterface
    {
        $userResponse = $this->queryBus->ask(new GetUserByIdQuery($id));

        return $this->response->json($userResponse->jsonSerialize());
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
