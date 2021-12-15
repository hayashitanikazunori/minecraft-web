<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserMeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class UserMeController extends Controller
{
    public function getUserMe()
    {
        try {
            $user = Auth::guard('web')->user();

            if ($user != null) {
                return new UserMeResource($user);
            }else {
                return new JsonResponse([ 'message' => 'ログインしていません。']);
            }
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログインユーザーの取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
