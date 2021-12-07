<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use \App\Http\Requests\PostCreateRequest;
use App\Http\Resources\User\PostsCollection;
use App\Http\Resources\User\PostsResource;
use Illuminate\Http\JsonResponse;
use Exception;

class PostController extends Controller
{
    public function index()
    {
        try {
            return new PostsCollection(Post::all());
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function store(PostCreateRequest $request): JsonResponse
    {
        /*************************************************
         * TODO
         * $jsonの'data' => $userについては頃合いを見て削除すること。
        *************************************************/
        try {
                $validate = $request->validated();

                $post = new Post;
                $createPost = $post->postCreate($validate);

                $json = [
                    'data' => $createPost,
                    'message' => '投稿に成功しました。',
                ];

                return new JsonResponse($json);
            } catch (Exception $e){
            return new JsonResponse([ 'message' => '投稿に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function show($id)
    {
        try {
            $post = new Post;
            $post = $post->postFindById($id);

            return new PostsResource($post);
            } catch (Exception $e){
                return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    // public function update(UserRegisterRequest $request, $id): JsonResponse
    // {
    //     /*************************************************
    //      * TODO
    //      * リファクタリングをしたい。
    //      * DBとのやりとりはModelに移したい。
    //      * formRequestがregisterを使っているので、update用のformRequestを作ること。
    //      * imgaesの参照先は下記のファイルを参考にすること。
    //      * https://qiita.com/koru1893/items/1d2f522e20744b03e3ad
    //      * https://qiita.com/___yusuke49/items/9f6f64c7f800b8e77e7d
    //     *************************************************/
    //     try {
    //         $request->validated();
    //         $image_path = $request->avatar_image->store('public/avatar/');

    //         $user = User::find($id);
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->password = Hash::make($request->password);
    //         $user->avatar_image = basename($image_path);
    //         $user->profile = $request->profile;
    //         $user->save();

    //         $json = [
    //             'userUpdate' => $user,
    //             'message' => '変更に成功しました。',
    //         ];

    //         return new JsonResponse($json);

    //         } catch (Exception $e) {
    //         return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
    //     }
    // }

    public function destroy($id): JsonResponse
    {
        try {
            $post = new Post;
            $post->postDelete($id);

            return new JsonResponse(['message' => '投稿の削除に成功しました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '投稿の削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
