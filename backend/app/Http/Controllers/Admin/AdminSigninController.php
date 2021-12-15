<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class AdminSigninController extends Controller
{
    public function login(AdminLoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();

            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                Auth::guard('admin')->id();
                return new JsonResponse(['message' => 'ログインしました。' ]);
            }else {
                return new JsonResponse([ 'message' => 'メールアドレスかパスワードが間違っています。']);
            }
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログインに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
