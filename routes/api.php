<?php

use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\GetProductController;
use App\Http\Controllers\Product\UpdateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('products')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('', CreateProductController::class)->name('products.create');
            Route::put('{product}', UpdateProductController::class)->name('products.update');
            Route::delete('{product}', DeleteProductController::class)->name('products.delete');
        });
        Route::get('{product}', GetProductController::class)->name('products.get');
    });
});
require __DIR__.'/auth.php';
