<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\AdminOperatePostsCollection;
use Illuminate\Http\JsonResponse;
use Exception;

class AdminOperatePostsController extends Controller
{
    public function index()
    {
        try {
            $posts = new Post;
            $posts = $posts->getAllPosts();

            return new AdminOperatePostsCollection($posts);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function changepPublicingStatus($id): JsonResponse
    {
        try {
            $post = new Post;
            $post->changepPublicingStatus($id);

            return new JsonResponse(['message' => '公開ステータスの変更に成功しました。']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '公開ステータスの変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

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
