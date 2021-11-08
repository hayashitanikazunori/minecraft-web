<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{

    public function checkAuthUser(): JsonResponse
    {
        $user = Auth::guard('admin')->user();

        return new JsonResponse([ $user ]);
    }
}
