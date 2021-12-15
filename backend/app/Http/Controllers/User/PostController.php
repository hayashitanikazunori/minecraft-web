<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use \App\Http\Requests\PostCreateRequest;
use \App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\User\PostsCollection;
use App\Http\Resources\User\CommentsCollection;
use App\Http\Resources\User\PostsResource;
use Illuminate\Http\JsonResponse;
use Exception;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = new Post;
            $posts = $posts->getAllPosts();

            return new PostsCollection($posts);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function store(PostCreateRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();

            $post = new Post;
            $post = $post->postCreate($credentials);

            return new JsonResponse([ 'message' => '投稿に成功しました。']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '投稿に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function show($id)
    {
        try {
            $post = new Post;
            $post = $post->postFindById($id);
            $postDate = new PostsResource($post);

            $comments = new Comment;
            $comments = $comments->CommentGetsById($id);
            $commentsDate = new CommentsCollection($comments);

            $json = [
                'postDate' => $postDate,
                'commentsDate' => $commentsDate,
            ];

            return $json;
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $credentials = $request->validated();

            $post = new Post;
            $post = $post->postUpdate($credentials, $id);

            return new JsonResponse(['message' => '変更に成功しました。']);
        } catch (Exception $e) {
            return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
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
