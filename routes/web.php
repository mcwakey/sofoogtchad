<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

// Dynamic page rendering (exclude admin path)
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show')
    ->where('slug', '^(?!admin).*$');
