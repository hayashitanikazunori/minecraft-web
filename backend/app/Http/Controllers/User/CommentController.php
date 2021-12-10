<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use \App\Http\Requests\CommentCreateRequest;
use \App\Http\Requests\CommentUpdateRequest;
use Illuminate\Http\JsonResponse;
use Exception;


class CommentController extends Controller
{
    public function store(CommentCreateRequest $request, $id)
    {
        try {
            $validate = $request->validated();

            $comment = new Comment;
            $comment = $comment->commentCreate($validate, $id);

            $json = [
                'data' => $comment,
                'message' => 'コメントに成功しました。',
            ];

            return new JsonResponse($json);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'コメントに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function update(CommentUpdateRequest $request, $id)
    {
        try {
            $validate = $request->validated();

            $comment = new Comment;
            $commentUpdate = $comment->commentUpdate($validate, $id);

            return new JsonResponse(['message' => $commentUpdate ]);
        } catch (Exception $e) {
            return new JsonResponse([ 'message' => 'コメントの変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = new Comment;
            $commentDelete = $comment->commentDelete($id);

            return new JsonResponse(['message' => $commentDelete ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'コメントの削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
