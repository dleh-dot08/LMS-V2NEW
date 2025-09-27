<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserImportController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProgramCategoryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassGroupController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('cek-route', function () {
    return 'Route OK';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth','role:1,2'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

Route::middleware(['auth', 'role:superadmin,admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::resource('users', UserController::class);

        // ✅ Tambahin ini untuk toggle aktif/nonaktif
        Route::patch('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('users/import', [UserImportController::class, 'showImportForm'])->name('users.import.form');
    Route::post('users/import/preview', [UserImportController::class, 'preview'])->name('users.import.preview');
    Route::delete('users/import/remove/{index}', [UserImportController::class, 'removeRow'])->name('users.import.remove');
    Route::post('users/import/commit', [UserImportController::class, 'commit'])->name('users.import.commit');
});

Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    Route::resource('files', FileController::class);
    Route::resource('schools', SchoolController::class);
    Route::resource('program_categories', ProgramCategoryController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('semesters', SemesterController::class);
    Route::resource('class-groups', ClassGroupController::class);
});     

Route::get('admin/users/import', [UserImportController::class, 'showImportForm'])
    ->name('admin.users.import.form');

Route::resource('roles', RoleController::class);

require __DIR__.'/auth.php';
