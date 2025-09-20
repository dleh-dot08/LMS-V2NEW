<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ✅ Users (superadmin)
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('permissions', App\Http\Controllers\PermissionController::class);

// ✅ Admin
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('leaves', App\Http\Controllers\LeaveController::class);

// ✅ Mentor
Route::resource('classes', App\Http\Controllers\ClassController::class);
Route::resource('journals', App\Http\Controllers\JournalController::class);

// ✅ Learner
Route::resource('krs', App\Http\Controllers\KrsController::class);
Route::resource('grades', App\Http\Controllers\GradeController::class);
Route::get('/absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');

// ✅ Partner
Route::get('/partner/attendance', [App\Http\Controllers\PartnerController::class, 'attendance'])->name('partner.attendance');
Route::get('/partner/grades', [App\Http\Controllers\PartnerController::class, 'grades'])->name('partner.grades');

// ✅ PIC
Route::resource('students', App\Http\Controllers\StudentController::class);
Route::get('/pic/attendance', [App\Http\Controllers\PicController::class, 'attendance'])->name('pic.attendance');


require __DIR__.'/auth.php';
