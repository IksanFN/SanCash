<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\LoginController as StudentLoginController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class);

// Siswa Guest
Route::get('/login', [StudentLoginController::class, 'index'])->name('login');
Route::post('/login', [StudentLoginController::class, 'authenticate'])->name('authenticate');

// Admin Guest
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name('admin.login_authenticate');

Route::middleware('auth')->group(function() {

    // Route Admin
    Route::prefix('admin/')->middleware('role:admin')->name('admin.')->group(function() {

        // Dashboard & Logout
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logoutAdmin'])->name('logout');
    
        // Kelas
        Route::prefix('kelas/')->name('kelas.')->group(function() {
            Route::get('/', [KelasController::class, 'index'])->name('index');
            Route::post('/', [KelasController::class, 'store'])->name('store');
            Route::get('edit/{kelas}', [KelasController::class, 'edit'])->name('edit');
            Route::put('edit/{kelas}', [KelasController::class, 'update'])->name('update');
            Route::delete('delete/{kelas}', [KelasController::class, 'destroy'])->name('destroy');
        });

        // Jurusan
        Route::prefix('jurusan')->name('jurusan.')->group(function() {
            Route::get('/', [JurusanController::class, 'index'])->name('index');
            Route::post('/', [JurusanController::class, 'store'])->name('store');
            Route::get('/edit/{jurusan}', [JurusanController::class, 'edit'])->name('edit');
            Route::put('/edit/{jurusan}', [JurusanController::class, 'update'])->name('update');
            Route::delete('/delete/{jurusan}', [JurusanController::class, 'destroy'])->name('destroy');
        });

        // User
        Route::prefix('user')->name('user.')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::put('/edit/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Student
        Route::prefix('student')->name('student.')->group(function() {
            Route::get('/', [StudentController::class, 'index'])->name('index');
            Route::post('/', [StudentController::class, 'store'])->name('store');
            Route::get('/detail/{student}', [StudentController::class, 'show'])->name('show');
            Route::get('/create', [StudentController::class, 'create'])->name('create');
            Route::get('/detail/{uuid}', [StudentController::class, 'show'])->name('show');
            Route::get('/edit/{uuid}', [StudentController::class, 'edit'])->name('edit');
            Route::put('/update/{uuid}', [StudentController::class, 'update'])->name('update');
            Route::delete('/delete/{uuid}', [StudentController::class, 'destroy'])->name('destroy');
        });

    });

    // Route siswa
    Route::prefix('siswa/')->middleware('role:student')->name('siswa.')->group(function() {

        // Dashboard & Logout
        Route::get('/dashboard', StudentDashboardController::class)->name('dashboard');
        Route::post('/logout', [StudentLoginController::class, 'logoutSiswa'])->name('logout');


    });

});
