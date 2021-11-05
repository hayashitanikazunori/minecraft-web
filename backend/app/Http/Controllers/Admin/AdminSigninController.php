<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SigninAdminRequest;
use Illuminate\Support\Facades\Auth;

class AdminSigninController extends Controller
{
    public function login(SigninAdminRequest $request): JsonResponse
    {
    /*************************************************
         * TODO
         * テスト検証を行う。
    *************************************************/
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'ログインしました。']);
        }
        return back()->withErrors(['error' => 'login error',]);

        throw new Exception('ログインに失敗しました。再度お試しください');
    }
}
