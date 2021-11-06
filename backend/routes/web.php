<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSigninController;
use App\Http\Controllers\Admin\AdminSignoutController;
use Illuminate\Support\Facades\Auth;

// Auth::routes();

Route::post('/admin/login', [AdminSigninController::class, 'login']);
Route::post('/admin/logout', [AdminSignoutController::class, 'logout']);
