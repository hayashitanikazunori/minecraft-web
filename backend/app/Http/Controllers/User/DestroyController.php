<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Exception;

class DestroyController extends Controller
{
    public function destroy(Request $request) {
        try {
            $user = User::find($request->id);
            $user->delete();

            return new JsonResponse(['message' => 'アカウントの削除に成功しました。' ]);
        } catch (Exception $exception){
            return new JsonResponse([ 'message' => 'アカウントの削除に失敗しました。再度お試しください', 'errorMessage' => $exception]);
        }
    }
}
