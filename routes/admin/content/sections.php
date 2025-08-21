<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Content\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Mai jos o să scriem Rutele web pentru secțiuni pe partea de Admin.
|
*/

Route::prefix('admin/content/sections')->middleware(['auth:staff'])->group(function () {
    Route::get('show-sections', [SectionController::class, 'showSections'])->name('show-sections');
    Route::get('new-section', [SectionController::class, 'showNewSectionForm'])->name('new-section');
    Route::post('create-new-section', [SectionController::class, 'createNewSection'])->name('create-new-section');
});
