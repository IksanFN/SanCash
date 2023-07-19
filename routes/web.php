<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MonthBillController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WeekBillController;
use App\Http\Controllers\Admin\YearController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\LoginController as StudentLoginController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
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

        // Month
        Route::prefix('month-bill')->name('month_bill.')->group(function() {
            Route::get('/', [MonthBillController::class, 'index'])->name('index');
            Route::post('/', [MonthBillController::class, 'store'])->name('store');
            Route::get('/edit/{monthBill}', [MonthBillController::class, 'edit'])->name('edit');
            Route::put('/update/{monthBill}', [MonthBillController::class, 'update'])->name('update');
            Route::delete('/delete/{monthBill}', [MonthBillController::class, 'destroy'])->name('destroy');
        });

        // Year
        Route::prefix('year')->name('year.')->group(function() {
            Route::get('/', [YearController::class, 'index'])->name('index');
            Route::post('/', [YearController::class, 'store'])->name('store');
            Route::get('/edit/{year}', [YearController::class, 'edit'])->name('edit');
            Route::put('/update/{year}', [YearController::class, 'update'])->name('update');
            Route::delete('/delete/{year}', [YearController::class, 'destroy'])->name('destroy');
        });

        // Week
        Route::prefix('week')->name('week.')->group(function() {
            Route::get('/', [WeekBillController::class, 'index'])->name('index');    
            Route::post('/', [WeekBillController::class, 'store'])->name('store');    
            Route::get('/edit/{week}', [WeekBillController::class, 'edit'])->name('edit');    
            Route::put('/update/{week}', [WeekBillController::class, 'update'])->name('update');    
            Route::delete('/delete/{week}', [WeekBillController::class, 'destroy'])->name('destroy');    
        });

        // Bill
        Route::prefix('bill')->name('bill.')->group(function() {
            Route::get('/', [BillController::class, 'index'])->name('index');
            Route::get('/create', [BillController::class, 'create'])->name('create');
            Route::post('/store', [BillController::class, 'storeByClass'])->name('store');
            Route::get('/edit/{bill}', [BillController::class, 'edit'])->name('edit');
            Route::put('/update/{bill}', [BillController::class, 'update'])->name('update');
            Route::delete('/delete/{bill}', [BillController::class, 'destroy'])->name('destroy');

            // List Bill
            Route::get('/list-tagihan/{bill}', [BillController::class, 'listBill'])->name('list_bill');
            Route::get('/invoice/{transaction}', [BillController::class, 'invoice'])->name('invoice');
        });

        // Transaction
        Route::prefix('transaction')->name('transaction.')->group(function() {
            Route::get('/checkout/{uuid}', [BillController::class, 'checkout'])->name('checkout');
            Route::post('/payment/{transaction}', [TransactionController::class, 'payment'])->name('payment');
            Route::get('/download-invoice/{transaction}', [TransactionController::class, 'createPDF'])->name('download_invoice');
            Route::get('/export-excel/{id}', [TransactionController::class, 'export'])->name('export');
        });

    });

    // Route siswa
    Route::prefix('siswa/')->middleware('role:student')->name('siswa.')->group(function() {

        // Dashboard & Logout
        Route::get('/dashboard', StudentDashboardController::class)->name('dashboard');
        Route::post('/logout', [StudentLoginController::class, 'logoutSiswa'])->name('logout');


    });

});
