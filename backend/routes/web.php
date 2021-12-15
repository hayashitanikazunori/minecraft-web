<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSigninController;
use App\Http\Controllers\Admin\AdminSignoutController;
use App\Http\Controllers\Admin\MeController;
use App\Http\Controllers\Admin\AdminOperatePostsController;
use App\Http\Controllers\Admin\AdminOperateUsersController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserSigninController;
use App\Http\Controllers\User\UserSignoutController;
use App\Http\Controllers\User\UserMeController;
use App\Http\Controllers\User\UserController;

/*************************************************
 * TODO
 * auth:sanctumのmiddlewareを使用するとuser側の
 * Auth:checkが行われる。
 * AdminAuthのmiddlewareを作成してルート保護の棲み分けをすること。
*************************************************/

Route::post('/admin/login', [AdminSigninController::class, 'login'])->name('admin.login');
Route::get('/admin/me', [MeController::class, 'checkAuthUser']);
Route::post('/admin/logout', [AdminSignoutController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/admin/users', [AdminOperateUsersController::class, 'index']);
  Route::post('/admin/users/{id}/change-freezing-status', [AdminOperateUsersController::class, 'changeFreezingStatus']);
  Route::delete('/admin/users/{id}', [AdminOperateUsersController::class, 'destroy']);
  Route::get('/admin/posts', [AdminOperatePostsController::class, 'index']);
  Route::post('/admin/posts/{id}/change-publicing-status', [AdminOperatePostsController::class, 'changepPublicingStatus']);
  Route::delete('/admin/posts/{id}', [AdminOperatePostsController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
  Route::post('/logout', [UserSignoutController::class, 'logout']);
  Route::get('/me', [UserMeController::class, 'checkAuthUser']);
});

Route::post('/login', [UserSigninController::class, 'login'])->name('login');
/*************************************************
 * TODO
 * 一通り実装が終わったらauth.middlewareに追加すること。
*************************************************/
Route::resource('users', UserController::class)->only([
  'store', 'show', 'update', 'destroy'
]);

/*************************************************
 * TODO
 * 一通り実装が終わったらauth.middlewareに追加すること。
*************************************************/
Route::resource('posts', PostController::class)->only([
  'index', 'store', 'show', 'update', 'destroy'
]);

/*************************************************
 * TODO
 * 一通り実装が終わったらauth.middlewareに追加すること。
*************************************************/
Route::post('favorites/{id}', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

/*************************************************
 * TODO
 * 一通り実装が終わったらauth.middlewareに追加すること。
*************************************************/
Route::resource('comments', CommentController::class)->only([
  'update', 'destroy'
]);
Route::post('comments/{id}', [CommentController::class, 'store'])->name('comments.store');
