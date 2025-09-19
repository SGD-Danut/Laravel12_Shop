<?php

use App\Http\Controllers\Front\Content\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem rutele web pentru categorii pe partea de Client.
|
*/

Route::get('/category/{categorySlug}', [CategoryController::class, 'showCategory'])->name('show-category');