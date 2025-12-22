<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

// Products routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductsController::class, 'category'])->name('products.category');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');

// Dynamic page rendering (exclude admin and products paths)
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('slug', '^(?!admin|products).*$');
