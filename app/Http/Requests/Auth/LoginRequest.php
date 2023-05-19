<?php

namespace App\Http\Requests\Auth;

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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'min:8']
        ];
    }
    public function messages()
    {
        return [
            'email.max' => 'Количество символов не должно превышать 255 символов',
            'email.required' => 'Данное поле обязательно',
            'email.email' => 'Введите email',
            'password.required' => 'Данное поле обязательно',
            'password.min' => 'Минимум 8 символов',
        ];
    }
}
