<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required|max:100',
            'user_id' => 'prohibited',
            'post_id' => 'prohibited',
        ];
    }

    public function messages() {
        return [
            'body.required' => 'コメントは入力必須です。',
            'body.max' => 'コメントは100文字以内で入力してください。',
            'user_id.prohibited' => 'user_idは値を含めないでください。',
            'post_id.prohibited' => 'post_idは値を含めないでください。',
        ];
    }
}
