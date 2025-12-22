<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\AboutController;

// Homepage with dynamic content
Route::get('/', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Products routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/category/{slug}', [ProductsController::class, 'category'])->name('products.category');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');

// Process page
Route::get('/process', [ProcessController::class, 'index'])->name('process.index');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Partners routes
Route::get('/partners', [PartnersController::class, 'index'])->name('partners.index');
Route::get('/partners/become-distributor', [PartnersController::class, 'showDistributorForm'])->name('partners.become-distributor');
Route::post('/partners/become-distributor', [PartnersController::class, 'submitDistributorRequest'])->name('partners.distributor-request');
Route::get('/become-distributor', [PartnersController::class, 'showDistributorForm'])->name('distributor.request');

// Dynamic page rendering (exclude admin, products, process, blog, partners paths)
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('slug', '^(?!admin|products|process|blog|partners|pages|become-distributor|about).*$');
