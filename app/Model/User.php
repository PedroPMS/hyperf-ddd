<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $created_at
 * @property $updated_at
 */
class User extends Model
{
    public string $keyType = 'string';

    public bool $incrementing = false;

    protected array $fillable = ['id', 'name', 'email', 'created_at', 'updated_at'];
}
