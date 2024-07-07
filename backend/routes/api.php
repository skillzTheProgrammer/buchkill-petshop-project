<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {
    //user and auth endpoints
    Route::prefix('user')->group(function () {
        Route::post('create', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
});
