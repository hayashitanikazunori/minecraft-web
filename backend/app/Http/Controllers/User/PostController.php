<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use \App\Http\Requests\PostCreateRequest;
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
         * バリデーションエラーが発生している。
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

    public function update(PostCreateRequest $request, $id)
    {
        try {
            $validate = $request->validated();

            $post = new Post;
            $postUpdate = $post->postUpdate($validate, $id);

            $json = [
                'userUpdate' => $postUpdate,
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
            $post = new Post;
            $post->postDelete($id);

            return new JsonResponse(['message' => '投稿の削除に成功しました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '投稿の削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
