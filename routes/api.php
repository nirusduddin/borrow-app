<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipmentCategoryController;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\BorrowController;

Route::prefix('v1')->group(function () {

    // Auth
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('auth/me', [AuthController::class, 'me']);
        Route::post('auth/refresh', [AuthController::class, 'refresh']);
        Route::post('auth/logout', [AuthController::class, 'logout']);

        // Categories
        Route::apiResource('categories', EquipmentCategoryController::class);

        // Equipment
        Route::apiResource('equipment', EquipmentController::class);

        // Borrow / Return
        Route::post('borrows', [BorrowController::class, 'store']);
        Route::post('borrows/{borrow}/return', [BorrowController::class, 'return']);
    });
});