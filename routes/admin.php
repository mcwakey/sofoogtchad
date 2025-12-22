<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
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
});
