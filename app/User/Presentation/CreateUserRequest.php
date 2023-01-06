<?php

namespace App\User\Presentation;

use Hyperf\Validation\Request\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}