<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'unique:users', 'max:50'],
            'password' => ['required', 'confirmed', 'min:8', 'max:50'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'Количество символов не должно превышать 50 символов',
            'email.max' => 'Количество символов не должно превышать 50 символов',
            'name.required' => 'Данное поле обязательно',
            'email.required' => 'Данное поле обязательно',
            'password.required' => 'Данное поле обязательно',
            'name.min' => 'Минимум 3 символа',
            'password.min' => 'Минимум 8 символов',
            'password.max' => 'Максимум 50 символов',
            'email.unique' => 'Такой email уже существует',
            'email.email' => 'Введите email',
            'password.confirmed' => 'Пароли не совпадают',
            'avatar.required' => 'Данное поле обязательно',
            'avatar.image' => 'Загрузите фото типа jpg,jpeg,png',
            'avatar.max' => 'Максимальный размер файла не должен превышать 2МБ'
        ];
    }
}
