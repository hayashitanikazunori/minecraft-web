<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\AdminOperateUsersResource;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class AdminOperateUsersController extends Controller
{
    public function index()
    {
        try {
            return new AdminOperateUsersResource(User::all());
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください', 'errorMessage' => $e]);
        }
    }

    public function changeFreezingStatus($id): JsonResponse
    {
        try {
            $user = new User;
            $user->changeFreezingStatus($id);
            return new JsonResponse(['message' => '凍結ステータスの変更に成功しました。']);

        } catch (Exception $e){
            return new JsonResponse([ 'message' => '変更に失敗しました。再度お試しください', 'errorMessage' => $e]);
        }
    }
}
