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
    Route::get('new-product', [ProductController::class, 'showNewProductForm'])->name('new-product');
    Route::post('create-new-product', [ProductController::class, 'createNewProduct'])->name('create-new-product');
    Route::get('edit-product/{productId}', [ProductController::class, 'showEditProductForm'])->name('edit-product');
    Route::put('update-product/{productId}', [ProductController::class, 'updateProduct'])->name('update-product');
    Route::get('/manage-product-images-form/{productId}',[ProductController::class, 'showProductImagesForm'])->name('manage-product-images'); // Aceasta
});