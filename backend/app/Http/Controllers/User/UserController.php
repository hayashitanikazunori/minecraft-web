<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\Post;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\PostsCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    public function store(UserRegisterRequest $request): JsonResponse
    {
        /*************************************************
         * TODO
         * $jsonの'data' => $userについては頃合いを見て削除すること。
         * リファクタリングをしたい。
         * DBとのやりとりはModelに移したい。
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
                ];

                return new JsonResponse($json);
            } catch (Exception $e){
            return new JsonResponse([ 'message' => '登録に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function show($id)
    {
        try {
            $user = new User;
            $user = $user->getUserById($id);
            $userDate = new UserResource($user);

            $posts = new Post;
            $posts = $posts->getPostsWhereByUserId($user->id);
            $postsDate = new PostsCollection($posts);

            $json = [
                'userDate' => $userDate,
                'postsDate' => $postsDate,
            ];

            return $json;
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function update(UserRegisterRequest $request, $id): JsonResponse
    {
        /*************************************************
         * TODO
         * リファクタリングをしたい。
         * DBとのやりとりはModelに移したい。
         * formRequestがregisterを使っているので、update用のformRequestを作ること。
         * imgaesの参照先は下記のファイルを参考にすること。
         * https://qiita.com/koru1893/items/1d2f522e20744b03e3ad
         * https://qiita.com/___yusuke49/items/9f6f64c7f800b8e77e7d
        *************************************************/
        try {
            $request->validated();
            $image_path = $request->avatar_image->store('public/avatar/');

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->avatar_image = basename($image_path);
            $user->profile = $request->profile;
            $user->save();

            $json = [
                'userUpdate' => $user,
                'message' => '変更に成功しました。',
            ];

            return new JsonResponse($json);

            } catch (Exception $e) {
            return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $user = User::find($id);
            $user->delete();

            return new JsonResponse(['message' => 'アカウントの削除に成功しました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'アカウントの削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
