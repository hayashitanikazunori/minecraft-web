<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SigninAdminRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Exception;

class AdminSignoutController extends Controller
{
    public function logout(Request $request): JsonResponse {
        /************************************
         * TODO
         * ここにログアウトの処理を書く
         * return view('/home');は消すこと。
         * POSTで送られているので、URLを入力してもエラーが出る。
        *************************************/
        if (Auth::logout()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(['message' => 'ログアウトしました。']);
        }

        throw new Exception('ログアウトに失敗しました。再度お試しください');

    }
}
