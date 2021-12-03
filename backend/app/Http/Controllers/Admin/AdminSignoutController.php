<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminSignoutController extends Controller
{
    public function logout(Request $request): JsonResponse {
        /************************************
         * TODO
         * ここにログアウトの処理を書く
        *************************************/
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return new JsonResponse(['message' => 'ログアウトしました。' ]);
    }
}
