<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminSigninController extends Controller
{
    public function login(Request $request): JsonResponse
    {
    /*************************************************
     * TODO
     * リファクタリングをしたい。
     * 特にフォームリクエストにできるか？
    *************************************************/
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $check = Auth::guard('admin')->id();
            return new JsonResponse(['message' => 'ログインしました' ]);
        }

        throw new Exception('ログインに失敗しました。再度お試しください');
    }
}
