<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class AdminSignoutController extends Controller
{
    public function logout(Request $request): JsonResponse {
        try {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return new JsonResponse(['message' => 'ログアウトしました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログアウトに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
