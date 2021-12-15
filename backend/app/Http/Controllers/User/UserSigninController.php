<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use \App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class UserSigninController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        /*************************************************
         * TODO
         * リファクタリングをしたい。
         * バリデーションをフォームリクエストに移したい。
        *************************************************/
        try {
            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return new JsonResponse(['message' => 'ログインしました。' ]);
            }else {
                return new JsonResponse([ 'message' => 'メールアドレスかパスワードが間違っています。']);
            }
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログインに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
