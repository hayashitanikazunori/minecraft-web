<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Exception;

class FavoriteController extends Controller
{
    public function store($id)
    {
        /*************************************************
         * TODO
         * createの処理をmodelに移すこと。
         * 未検証のため、確認が必要。
        *************************************************/

        try {
                Favorite::create([
                    'post_id' => $id,
                    'user_id' => Auth::id(),
                ]);

            return new JsonResponse([ 'message' => 'いいねしました']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => '取得に失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id)
    {
        /*************************************************
         * TODO
         * createの処理をmodelに移す。
         * 未検証のため、確認が必要。
        *************************************************/

        try {
            $favorite = Favorite::where('post_id', $id)->where('user_id', Auth::id())->first();
            $favorite->delete();

        return new JsonResponse([ 'message' => 'いいねを外しました。']);
    } catch (Exception $e){
        return new JsonResponse([ 'message' => 'いいねを外すのに失敗しました。再度お試しください。', 'errorMessage' => $e]);
    }

    }
}
