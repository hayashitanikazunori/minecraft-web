<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSigninController;
use App\Http\Controllers\Admin\AdminSignoutController;
use App\Http\Controllers\Admin\MeController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\DestroyController;
use Illuminate\Support\Facades\Auth;

Route::post('/admin/login', [AdminSigninController::class, 'login']);
Route::post('/admin/logout', [AdminSignoutController::class, 'logout']);
Route::get('/admin/me', [MeController::class, 'checkAuthUser']);

Route::post('/register', [RegisterController::class, 'register']);
Route::delete('/users/{id}', [DestroyController::class, 'destroy']);
