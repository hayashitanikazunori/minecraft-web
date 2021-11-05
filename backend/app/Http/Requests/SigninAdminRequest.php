<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninAdminRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'emal' => 'required|email:strict,dns,spoof|max:100',
            'password' => 'required',
        ];
    }

    public function messages(){
        return [
            'email.email' => 'メールアドレスの書式で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
        ];
    }

}
