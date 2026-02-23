<?php

use App\Http\Controllers\Admin\Content\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru produse pe partea de Admin.
|
*/

Route::prefix('admin/content/products')->middleware(['auth:staff'])->group(function () {
    Route::get('show-products', [ProductController::class, 'showProducts'])->name('show-products');
});