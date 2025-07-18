<?php

use App\Http\Controllers\Admin\StaffAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru paginile din front-end.
|
*/

Route::get('/admin/dashboard', [StaffController::class, 'showDashboardPage'])->middleware(['auth:staff'])->name('admin-dashboard');

// Rute pentru autentificare:
Route::prefix('admin')->controller(StaffAuthController::class)->group(function () {
    Route::middleware('guest:staff')->group(function () {
        Route::get('/login', 'showStaffLoginForm')->name('staff-login-form');
        Route::post('/login', 'staffLogin')->name('staff-login');
    });
});

// Ruta pentru deconectare:
Route::post('/admin/logout', [StaffAuthController::class, 'staffLogout'])->middleware(['auth:staff'])->name('staff-logout');

