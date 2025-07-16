<?php

use App\Http\Controllers\Front\MyAccountController;
use App\Http\Controllers\Front\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru acțiunile personale realizate din My Account.
|
*/

Route::get('/my-account', [MyAccountController::class, 'showMyAccountPage'])->middleware('verified', 'auth')->name('my-account-page');
Route::get('/my-account/change-password', [MyAccountController::class, 'showMyAccountChangePasswordPage'])->middleware('verified', 'auth')->name('my-account-change-password');
Route::post('/my-account/change-password', [MyAccountController::class, 'changeUserPassword'])->middleware('verified', 'auth')->name('change-user-password');
