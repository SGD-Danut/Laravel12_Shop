<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Content\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru secțiuni pe partea de Client.
|
*/

Route::get('/section/{sectionSlug}', [SectionController::class, 'showSection'])->name('show-section');