<?php declare(strict_types=1);

namespace App\User\Presentation;

use App\Controller\AbstractController;
use App\Model\User;
use Hyperf\Database\Model\Model;
use Hyperf\HttpServer\Contract\RequestInterface;

class UserController extends AbstractController
{
    public function index()
    {

        User::create(['id' => uniqid(), 'name' => 'pedro', 'email' => 'email@gmail.com']);
        return User::get();
    }

    public function show(string $id): User
    {
        return User::find($id);
    }

    public function store(RequestInterface $request): User|Model
    {
        return User::create($request->all());
    }

    public function delete(string $id): int
    {
        return User::destroy($id);
    }
}
