<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\IsManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru utilizatori.
|
*/

Route::get('admin/users', [UserController::class, 'showUsers'])->middleware(['auth:staff', IsManager::class])->name('show-users');