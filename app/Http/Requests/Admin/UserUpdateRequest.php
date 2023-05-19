<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
            'role' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Введите строку',
            'name.min' => 'Минимальная длина строки равна 8 симолам',
            'name.max' => 'Максимальная длина строки 255 символов',
            'name.required' => 'Данное поле обязательно',
            'email.required' => 'Данное поле обязательно',
            'email.max' => 'Максимальная длина строки 255 символов',
            'password.required' => 'Данное поле обязательно',
            'password.min' => 'Минимальная длина пароля равна 8 символам',
        ];
    }
}
