<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserSignoutController extends Controller
{
    public function logout(Request $request): JsonResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return new JsonResponse([ 'message' => 'ログアウトしました。']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログアウトに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
