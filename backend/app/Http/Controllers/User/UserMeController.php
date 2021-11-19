<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserMeController extends Controller
{
    public function checkAuthUser(): JsonResponse
    {
        $user = Auth::guard('web')->user();

        return new JsonResponse([ $user ]);
    }
}
