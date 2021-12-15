<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\AdminOperateUsersCollection;
use Illuminate\Http\JsonResponse;
use Exception;

class AdminOperateUsersController extends Controller
{
    public function index()
    {
        try {
            $users = new User;
            $users = $users->getAllUsers();

            return new AdminOperateUsersCollection($users);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function changeFreezingStatus($id): JsonResponse
    {
        try {
            $user = new User;
            $user->changeFreezingStatus($id);

            return new JsonResponse(['message' => '凍結ステータスの変更に成功しました。']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $user = new User;
            $user->userFindById($id);

            return new JsonResponse(['message' => 'アカウントの削除に成功しました。' ]);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'アカウントの削除に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
