<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/front/pages.php';
require __DIR__.'/front/my-account.php';
require __DIR__.'/front/content/sections.php';
require __DIR__.'/front/content/categories.php';
require __DIR__.'/admin/staff.php';
require __DIR__.'/admin/users.php';
require __DIR__.'/admin/content/sections.php';
require __DIR__.'/admin/content/categories.php';
require __DIR__.'/admin/content/brands.php';