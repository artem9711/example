<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file',
            'main_image' => 'nullable|file',
            'category_id' => '',
            'tags_ids' => 'nullable|array',
            'tags_ids.*' => 'nullable|integer|exists:tags',
        ];
    }
    public function messages()
    {
        return[
            'title.required' => 'Это поле необходимо для заполнения',
            'title.string' => 'Это поле должно иметь строчный тип',
            'content.required' => 'Это поле необходимо для заполнения',
            'content.string' => 'Это поле должно иметь строчный тип',
            'preview_image.required' => 'Необходимо загрузить изображение',
            'main_image.required' => 'Необходимо загрузить изображение',
            'tags_ids.array' => 'Необходимо выбрать тег-(и)-',
        ];
    }
}
