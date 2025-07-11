<?php

use App\Http\Controllers\Front\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru paginile din front-end.
|
*/

Route::get('/', [PagesController::class, 'showHomePage'])->name('show-home-page');