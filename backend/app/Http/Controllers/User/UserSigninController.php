<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use \App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class UserSigninController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                $user = new User;
                $userFreezingStatus = $user->userFreezingStatusFindByEmail($credentials['email']);

                if ($userFreezingStatus == 0) {
                    $request->session()->regenerate();

                    return new JsonResponse(['message' => 'ログインしました。' ]);
                }else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return new JsonResponse(['message' => '凍結されています。運営にお問い合わせしてください。' ]);
                }
            }else {
                return new JsonResponse([ 'message' => 'メールアドレスかパスワードが間違っています。']);
            }
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'ログインに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
