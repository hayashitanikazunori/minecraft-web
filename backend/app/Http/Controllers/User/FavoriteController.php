<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Exception;

class FavoriteController extends Controller
{
    public function store($id)
    {
        try {
            $favorite = new Favorite;
            $favorite->favoriteCreate($id);

            return new JsonResponse([ 'message' => 'いいねしました']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'いいねに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }

    public function destroy($id)
    {
        try {
            $favorite = new Favorite;
            $favorite->favoriteDelete($id);

            return new JsonResponse([ 'message' => 'いいねを外しました。']);
        } catch (Exception $e){
            return new JsonResponse([ 'message' => 'いいねを外すのに失敗しました。再度お試しください。', 'errorMessage' => $e]);
        }
    }
}
