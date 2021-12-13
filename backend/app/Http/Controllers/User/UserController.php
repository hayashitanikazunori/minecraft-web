<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use \App\Http\Requests\UserCreateRequest;
use \App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\User\PostsCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Exception;

class UserController extends Controller
{
    public function store(UserCreateRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();

            $user = new User;

            $userCheck = $user->userCreatedCheck($credentials['email']);
            if ($userCheck != 0) {
                return new JsonResponse(['message' => 'すでに登録されています。']);
            }

            $user = $user->userCreate($credentials);

            return new JsonResponse(['message' => '作成に成功しました。']);
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

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        try {
            $credentials = $request->validated();

            $user = new User;
            $user = $user->userUpdate($credentials, $id);

            return new JsonResponse(['message' => '変更に成功しました。' ]);
        } catch (Exception $e) {
            return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $user = new User;
            $user->userDelete($id);

            return new JsonResponse(['message' => 'アカウントの削除に成功しました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'アカウントの削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
