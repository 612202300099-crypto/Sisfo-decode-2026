<?php

use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

use App\Models\StudyProgram;
use App\Models\Student;
use App\Models\Subject;

Route::get('/', function () {
    $studyProgramCount = StudyProgram::count();
    $studentCount = Student::count();
    $subjectCount = Subject::count();
    
    return view('pages.home', compact('studyProgramCount', 'studentCount', 'subjectCount'));
})->name('home');

Route::resource('study-programs', StudyProgramController::class);
Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);

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
