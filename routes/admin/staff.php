<?php

use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\StaffAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Middleware\IsManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru membrii staff.
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

// Rute pentru administratorii cu tipul de manager
Route::get('/admin/staff', [ManagerController::class, 'showStaffMembers'])->middleware(['auth:staff', IsManager::class])->name('show-staff');
Route::get('/admin/new-staff', [ManagerController::class, 'showNewStaffForm'])->middleware(['auth:staff', IsManager::class])->name('show-new-staff');
Route::post('/admin/create-staff', [ManagerController::class, 'createNewStaffMember'])->middleware(['auth:staff', IsManager::class])->name('create-new-staff');
Route::get('/admin/edit-staff/{id}', [ManagerController::class, 'editStaffMember'])->middleware(['auth:staff', IsManager::class])->name('edit-staff');
Route::put('/admin/update-staff/{id}', [ManagerController::class, 'updateStaffMember'])->middleware(['auth:staff', IsManager::class])->name('update-staff');
Route::put('/admin/update-staff-password/{id}', [ManagerController::class, 'updateStaffMemberPassword'])->middleware(['auth:staff', IsManager::class])->name('update-staff-password');
Route::delete('/admin/block-staff/{id}', [ManagerController::class, 'blockStaffMember'])->middleware(['auth:staff', IsManager::class])->name('block-staff');
Route::put('/admin/restore-staff/{id}', [ManagerController::class, 'restoreStaffMember'])->middleware(['auth:staff', IsManager::class])->name('restore-staff');
Route::put('/admin/delete-staff/{id}', [ManagerController::class, 'permanentDeleteStaffMember'])->middleware(['auth:staff', IsManager::class])->name('delete-staff');
