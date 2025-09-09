<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru categorii pe partea de Admin.
|
*/

Route::prefix('admin/content/categories')->middleware(['auth:staff'])->group(function () {
    Route::get('show-categories', [CategoryController::class, 'showCategories'])->name('show-categories');
    Route::get('new-category/{sectionId}', [CategoryController::class, 'showNewCategoryForm'])->name('new-category'); 
    Route::post('create-new-category/{sectionId}', [CategoryController::class, 'createNewCategory'])->name('create-new-category');
    Route::get('edit-category/{categoryId}', [CategoryController::class, 'showEditCategoryForm'])->name('edit-category');
    Route::put('update-category/{categoryId}', [CategoryController::class, 'updateCategory'])->name('update-category');
    Route::get('/manage-category-images-form/{categoryId}',[CategoryController::class, 'showCategoryImagesForm'])->name('manage-category-images');
});
