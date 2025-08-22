<?php

use Illuminate\Support\Facades\Route;
use Modules\ApiV1\Http\Controllers\BookingController;
use Modules\ApiV1\Http\Controllers\CategoryController;
use Modules\ApiV1\Http\Controllers\PackageController;
use Modules\ApiV1\Http\Controllers\UserController;

Route::prefix('/api/v1')->group(function () {
    Route::apiResource('/categories', CategoryController::class)->only('index');

    Route::apiResource('/bookings', BookingController::class)->only('index', 'store')
        ->middleware('auth:api');

    Route::apiResource('/packages', PackageController::class)->only('index', 'show');

    Route::get('/users', [UserController::class, 'show'])
        ->middleware('auth:api');

    Route::match(['put', 'patch'], '/users', [UserController::class, 'update'])
        ->middleware('auth:api');
});
