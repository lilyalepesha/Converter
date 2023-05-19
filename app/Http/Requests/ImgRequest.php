<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImgRequest extends FormRequest
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
            'image' => ['required', 'array', 'max:1000'],
            'image.*' => ['required', 'image', 'mimes:jpeg,png,jpg,bmp', 'max:5120'],
            'width' => ['nullable', 'numeric', 'min:20', 'max:5001'],
            'height' => ['nullable', 'numeric', 'min:20', 'max:5001'],
            'extension' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Добавьте изображения',
            'image.*.max' => 'Размер файла не должен превышать 5МБ',
            'image.array' => 'Передайте массив изображений',
            'image.*.required' => 'Добавьте изображения',
            'image.*.image' => 'Поддерживаются типы jpeg, png, bmp или jpg',
            'width.numeric' => 'Введите числовое значение',
            'width.min' => 'Минимальное разрешение 20px',
            'width.max' => 'Максимальное разрещшение 5000px',
            'height.numeric' => 'Введите числовое значение',
            'height.min' => 'Минимальное разрешение 20px',
            'height.max' => 'Максимальное разрешение 5000px',
            'image.max' => 'Максимальное количество файлов 1000',
        ];
    }
}
