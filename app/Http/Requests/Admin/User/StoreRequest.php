<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string',
        'role' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
        'name.required' => 'Это поле является обязательным',
        'name.string' => 'Запрещены цифры, символы, только текст',
        'email.required' => 'Это поле является обязательным',
        'email.email' => 'Введи корректный email',
        'email.unique:users' => 'Такое имя пользователя уже существует',
        ];
    }
}
