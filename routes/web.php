<?php

use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

use App\Models\StudyProgram;
use App\Models\Student;
use App\Models\Subject;

use App\Services\SystemDataService;

Route::get('/', function (SystemDataService $dataService) {
    $stats = $dataService->getDashboardStats();
    return view('pages.home', compact('stats'));
})->name('home');

Route::resource('study-programs', StudyProgramController::class);
Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);

// Search Route
use App\Http\Controllers\SearchController;
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Trash Routes
use App\Http\Controllers\TrashController;
Route::get('/trash', [TrashController::class, 'index'])->name('trash.index');
Route::post('/trash/restore/{type}/{id}', [TrashController::class, 'restore'])->name('trash.restore');
Route::delete('/trash/force-delete/{type}/{id}', [TrashController::class, 'forceDelete'])->name('trash.force-delete');

// Import & Export Routes
use App\Http\Controllers\ImportExportController;

Route::prefix('import-export')->name('import-export.')->group(function () {
    // Export
    Route::get('/export/{type}', [ImportExportController::class, 'export'])->name('export');
    
    // Import
    Route::post('/import/{type}', [ImportExportController::class, 'import'])->name('import');
    
    // Template
    Route::get('/template/{type}', [ImportExportController::class, 'template'])->name('template');
});
