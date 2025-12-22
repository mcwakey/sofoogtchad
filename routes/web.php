<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

// Products routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductsController::class, 'category'])->name('products.category');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');

// Process page
Route::get('/process', [ProcessController::class, 'index'])->name('process.index');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Dynamic page rendering (exclude admin, products, process, blog paths)
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('slug', '^(?!admin|products|process|blog).*$');
