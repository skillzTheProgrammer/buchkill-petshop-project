<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyTokenMiddleware;

Route::prefix('v1')->group(function () {
    //user and auth endpoints
    Route::prefix('user')->group(function () {
        Route::post('create', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password-token', [AuthController::class, 'resetPassword']);

        //protected routes
        Route::middleware([VerifyTokenMiddleware::class])->group(function () {
                Route::post('logout', [AuthController::class, 'logout']);
                Route::get('', [UserController::class, 'show']);
                Route::put('edit', [UserController::class, 'update']);
                Route::delete('', [UserController::class, 'delete']);
                Route::get('orders', [UserController::class, 'orders']);
        });
    });

      //product endpoints
    Route::middleware([VerifyTokenMiddleware::class])->group(function () {
        Route::get('products', [ProductController::class, 'allProducts']);
        Route::post('product/create', [ProductController::class, 'store']);
    });

});
