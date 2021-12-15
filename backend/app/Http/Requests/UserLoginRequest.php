<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|max:20|min:8',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスはメールアドレスの形式で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.max' => 'パスワードは最大20文字以下で入力してください。',
            'password.min' => 'パスワードは最低8文字以上で入力してください。',
        ];
    }
}
