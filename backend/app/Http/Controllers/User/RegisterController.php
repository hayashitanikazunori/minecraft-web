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
    /*************************************************
     * TODO
     * $jsonの'data' => $userについては頃合いを見て削除すること。
     * リファクタリングをしたい。
     * imgaesの参照先は下記のファイルを参考にすること。
     * https://qiita.com/koru1893/items/1d2f522e20744b03e3ad
     * https://qiita.com/___yusuke49/items/9f6f64c7f800b8e77e7d
    *************************************************/
        try {
                $request->validated();

                $image_path = $request->avatar_image->store('public/avatar/');

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar_image' => basename($image_path),
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
