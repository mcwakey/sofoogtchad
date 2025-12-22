<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProcessStepController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\DistributorRequestController;
use App\Http\Controllers\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for the admin panel. All routes are prefixed with /admin
| and protected by the admin middleware.
|
*/

// Guest admin routes (login)
Route::middleware('guest')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Authenticated admin routes
Route::middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Logout
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // User management (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        Route::resource('roles', RoleController::class)->names([
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]);
    });

    // Page management (admin and editor)
    Route::resource('pages', PageController::class)->names([
        'index' => 'admin.pages.index',
        'create' => 'admin.pages.create',
        'store' => 'admin.pages.store',
        'show' => 'admin.pages.show',
        'edit' => 'admin.pages.edit',
        'update' => 'admin.pages.update',
        'destroy' => 'admin.pages.destroy',
    ]);

    // Page sections management
    Route::post('pages/{page}/sections', [PageSectionController::class, 'store'])
        ->name('admin.pages.sections.store');
    Route::put('pages/{page}/sections/{section}', [PageSectionController::class, 'update'])
        ->name('admin.pages.sections.update');
    Route::delete('pages/{page}/sections/{section}', [PageSectionController::class, 'destroy'])
        ->name('admin.pages.sections.destroy');
    Route::post('pages/{page}/sections/reorder', [PageSectionController::class, 'reorder'])
        ->name('admin.pages.sections.reorder');

    // Category management
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // Product management
    Route::resource('products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Product images
    Route::post('products/{product}/images', [ProductController::class, 'addImage'])
        ->name('admin.products.images.store');
    Route::delete('products/{product}/images/{image}', [ProductController::class, 'deleteImage'])
        ->name('admin.products.images.destroy');

    // Product sizes
    Route::post('products/{product}/sizes', [ProductController::class, 'addSize'])
        ->name('admin.products.sizes.store');
    Route::delete('products/{product}/sizes/{size}', [ProductController::class, 'deleteSize'])
        ->name('admin.products.sizes.destroy');

    // Process steps management
    Route::resource('process-steps', ProcessStepController::class)->names([
        'index' => 'admin.process-steps.index',
        'create' => 'admin.process-steps.create',
        'store' => 'admin.process-steps.store',
        'edit' => 'admin.process-steps.edit',
        'update' => 'admin.process-steps.update',
        'destroy' => 'admin.process-steps.destroy',
    ]);

    // Posts management
    Route::resource('posts', PostController::class)->names([
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);

    // Post images
    Route::post('posts/{post}/images', [PostController::class, 'addImage'])
        ->name('admin.posts.images.store');
    Route::delete('posts/{post}/images/{image}', [PostController::class, 'deleteImage'])
        ->name('admin.posts.images.destroy');

    // Partners management
    Route::resource('partners', PartnerController::class)->names([
        'index' => 'admin.partners.index',
        'create' => 'admin.partners.create',
        'store' => 'admin.partners.store',
        'edit' => 'admin.partners.edit',
        'update' => 'admin.partners.update',
        'destroy' => 'admin.partners.destroy',
    ]);

    // Distributor requests management
    Route::resource('distributor-requests', DistributorRequestController::class)->names([
        'index' => 'admin.distributor-requests.index',
        'show' => 'admin.distributor-requests.show',
        'update' => 'admin.distributor-requests.update',
        'destroy' => 'admin.distributor-requests.destroy',
    ])->except(['create', 'store', 'edit']);
});
