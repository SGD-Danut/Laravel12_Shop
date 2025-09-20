<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\BrandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru brand-uri pe partea de Admin.
|
*/

Route::prefix('admin/content/brands')->middleware(['auth:staff'])->group(function () {
    Route::get('show-brands', [BrandController::class, 'showBrands'])->name('show-brands');
    Route::get('new-brand', [BrandController::class, 'showNewBrandForm'])->name('new-brand');
    Route::post('create-new-brand', [BrandController::class, 'createNewBrand'])->name('create-new-brand');
});