<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Content\BrandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru brand-uri pe partea de Client.
|
*/

Route::get('/brands', [BrandController::class, 'showAllBrands'])->name('show-all-brands');
Route::get('/brand/{brandSlug}', [BrandController::class, 'showBrand'])->name('show-brand');