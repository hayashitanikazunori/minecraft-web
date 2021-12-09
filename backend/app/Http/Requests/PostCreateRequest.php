<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:30',
            'thumbnail_images' => 'required',
            'description' => 'required|max:255',
            'material' => 'required|max:255',
            'recipe' => 'required|max:255',
            'publicing_status' => 'prohibited',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'タイトルは入力必須です。',
            'title.max' => 'タイトルは30文字以内で入力してください。',
            'thumbnail_images.required' => 'サムネイル画像は必須です。',
            'description.required' => '概要は入力必須です。',
            'description.max:255' => '概要は255文字以内で入力してください。',
            'material.required' => '材料は入力必須です。',
            'material.max:255' => '材料は255文字以内で入力してください。',
            'recipe.required' => '作り方は入力必須です。',
            'recipe.max:255' => '作り方は255文字以内で入力してください。',
            'publicing_status.prohibited' => '公開ステータスは値を含めないでください。',
        ];
    }
}
