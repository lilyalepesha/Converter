<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:25'],
        ];
    }

    public function messages()
    {
        return [
            'email.max' => 'Количество символов не должно превышать 255 символов',
            'email.required' => 'Введите email',
            'email.email' => 'Введите корректный email',
            'password.required' => 'Введите пароль',
            'password.string' => 'Введите корректный пароль',
            'password.min' => 'Минимум 8 символов',
            'password.max' => 'Максимум 25 символов'
        ];
    }
}
