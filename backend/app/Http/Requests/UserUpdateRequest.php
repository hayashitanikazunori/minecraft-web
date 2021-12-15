<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'required|max:20|min:8',
            'avatar_image' => 'image',
            'profile' => 'required|max:100',
            'freezing_status' => 'prohibited',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'ユーザー名は必須です。',
            'name.max' => 'ユーザー名は30文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスはメールアドレスの形式で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.max' => 'パスワードは最大20文字以下で入力してください。',
            'password.min' => 'パスワードは最低8文字以上で入力してください。',
            'avatar_image.image' => '画像ファイルで入力してください。',
            'profile.required' => 'プロフィールは必須です。',
            'profile.max' => 'プロフィールは最1000文字以下で入力してください。',
            'freezing_status.prohibited' => '凍結ステータスは値を含めないでください。',
        ];
    }
}
