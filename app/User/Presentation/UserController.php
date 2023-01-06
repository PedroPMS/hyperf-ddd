<?php declare(strict_types=1);

namespace App\User\Presentation;

use App\Controller\AbstractController;
use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\User\Application\Create\CreateUserCommand;
use App\User\Application\Get\GetUserByIdQuery;
use App\User\Application\List\GetUsersQuery;
use App\User\Infrastructure\Database\UserModel;
use Psr\Http\Message\ResponseInterface;

class UserController extends AbstractController
{
    public function __construct(private readonly QueryBusInterface $queryBus, private readonly CommandBusInterface $commandBus)
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

    public function store(CreateUserRequest $request): ResponseInterface
    {
        $command = new CreateUserCommand(
            $request->input('name'),
            $request->input('email'),
            $request->input('cpf'),
            $request->input('password'),
        );

        $this->commandBus->dispatch($command);

        return $this->response->withStatus(201);
    }

    public function delete(string $id): int
    {
        return UserModel::destroy($id);
    }
}
