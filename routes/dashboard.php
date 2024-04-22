<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/dashboard')->as('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');

    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])
        ->name('categories.restore');

    Route::delete('/categories/{category}/forceDelete', [CategoriesController::class, 'forceDelete'])
        ->name('categories.forceDelete');

    Route::resource('/categories', CategoriesController::class);

    Route::get('/products/trash', [ProductsController::class, 'trash'])
        ->name('products.trash');

    Route::put('/products/{product}/restore', [ProductsController::class, 'restore'])
        ->name('products.restore');

    Route::delete('/products/{product}/forceDelete', [ProductsController::class, 'forceDelete'])
        ->name('products.forceDelete');

    Route::resource('/products', ProductsController::class);
});
