<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Database;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $cpf
 * @property $password
 * @property $created_at
 * @property $updated_at
 */
class UserModel extends Model
{
    protected ?string $table = 'users';
    public string $keyType = 'string';

    public bool $incrementing = false;

    protected array $fillable = ['id', 'name', 'email', 'cpf', 'password', 'created_at', 'updated_at'];
}
