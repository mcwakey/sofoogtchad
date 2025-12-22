<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProcessController;

Route::get('/', function () {
    return view('welcome');
});

// Products routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductsController::class, 'category'])->name('products.category');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');

// Process page
Route::get('/process', [ProcessController::class, 'index'])->name('process.index');

// Dynamic page rendering (exclude admin, products, process paths)
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('slug', '^(?!admin|products|process).*$');
