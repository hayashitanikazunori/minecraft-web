<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSigninController;
use App\Http\Controllers\Admin\AdminSignoutController;
use App\Http\Controllers\Admin\MeController;
use App\Http\Controllers\Admin\AdminOperateUsersController;
use App\Http\Controllers\User\UserSigninController;
use App\Http\Controllers\User\UserSignoutController;
use App\Http\Controllers\User\UserMeController;
use App\Http\Controllers\User\UserController;

Route::post('/admin/login', [AdminSigninController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminSignoutController::class, 'logout']);
Route::get('/admin/me', [MeController::class, 'checkAuthUser']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/admin/users', [AdminOperateUsersController::class, 'index']);
  Route::post('/admin/users/{id}/change-freezing-status', [AdminOperateUsersController::class, 'changeFreezingStatus']);
});

Route::post('/login', [UserSigninController::class, 'login'])->name('login');
Route::post('/logout', [UserSignoutController::class, 'logout']);
Route::get('/me', [UserMeController::class, 'checkAuthUser']);
Route::resource('users', UserController::class)->only([
  'store', 'show', 'update', 'destroy'
]);
