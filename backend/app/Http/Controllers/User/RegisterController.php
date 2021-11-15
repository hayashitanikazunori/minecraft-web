<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use \App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Exception;

class RegisterController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse {

        try {
                $request->validated();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar_image' => $request->avatar_image,
                    'profile' => $request->profile,
                    'freezing_status' => 0,
                ]);

                $json = [
                    'data' => $user,
                    'message' => '作成に成功しました。',
                    'error' => ''
                ];

                return new JsonResponse($json);
            }catch (Exception $exception){
            return new JsonResponse([ 'message' => '登録に失敗しました。再度お試しください', 'errorMessage' => $exception]);
        }
    }
}
