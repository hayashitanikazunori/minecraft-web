<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class MeController extends Controller
{

    public function checkAuthUser(): JsonResponse
    {
        $user = Auth::guard('admin')->user();

        return new JsonResponse([ $user ]);
    }
}
