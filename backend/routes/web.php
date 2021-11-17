<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSigninController;
use App\Http\Controllers\Admin\AdminSignoutController;
use App\Http\Controllers\Admin\MeController;
use App\Http\Controllers\User\UserSigninController;
use App\Http\Controllers\User\UserSignoutController;
use App\Http\Controllers\User\UserMeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;

Route::post('/admin/login', [AdminSigninController::class, 'login']);
Route::post('/admin/logout', [AdminSignoutController::class, 'logout']);
Route::get('/admin/me', [MeController::class, 'checkAuthUser']);

Route::post('/login', [UserSigninController::class, 'login']);
Route::post('/logout', [UserSignoutController::class, 'logout']);
Route::get('/me', [UserMeController::class, 'checkAuthUser']);
Route::resource('users', UserController::class)->only([
  'store', 'show', 'update', 'destroy'
]);;
