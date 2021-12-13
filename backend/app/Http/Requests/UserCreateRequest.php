<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'prohibited',
            'email' => 'required|email',
            'password' => 'required|max:20|min:8',
            'avatar_image' => 'prohibited',
            'profile' => 'prohibited',
            'freezing_status' => 'prohibited',
        ];
    }

    public function messages() {
        return [
            'name.prohibited' => 'ユーザー名は値を含めないでください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスはメールアドレスの形式で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.max' => 'パスワードは最大20文字以下で入力してください。',
            'password.min' => 'パスワードは最低8文字以上で入力してください。',
            'avatar_image.prohibited' => '画像は値を含めないでください。',
            'profile.prohibited' => 'プロフィールは値を含めないでください。',
            'freezing_status.prohibited' => '凍結ステータスは値を含めないでください。',
        ];
    }
}
