<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Types\Relations\Role;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\EmployeeHistoryController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['role:stuff'])->group(function () {
    Route::get('/NormalUserDashboard', [NormalUserController::class, 'index'])->name('NormalUser.Dashboard');
    Route::get('/NormalUserCreate', [NormalUserController::class, 'create'])->name('NormalUser.create');

    Route::post('/NormalUserStore', [NormalUserController::class, 'store'])->name('NormalUser.store');
});
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard → Employees page

    //Route::get('/dashboard', function () {
    //     return redirect()->route('dashboard.index');
    // })->name('dashboard');

    Route::get('/dashboardView', [DashboardController::class, 'index'])->name('dashboardView');

    // Employee CRUD (Protected)
    Route::resource('employees', EmployeeController::class); // Full CRUD routes
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    //Route::get('employees/pending', [EmployeeController::class, 'pending']);
    Route::post('employees/{id}/approve', [EmployeeController::class, 'approve'])->name('employees.approve');
    Route::get('/employee/download-pdf/{id}', [EmployeeController::class, 'downloadPDF'])->name('employees.download-pdf');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::middleware(['auth', 'role:admin'])->group(function () {});


//use App\Http\Controllers\AdminUserController;

Route::middleware(['auth', 'verified'])->group(function () {

    // এপ্রুভড ইউজারদের জন্য সার্ভিস রাউট
    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');


        //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('employees', EmployeeController::class);
    });

    // শুধুমাত্র অ্যাডমিনদের জন্য ইউজার ম্যানেজমেন্ট
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'userIndex'])->name('users.index');
        Route::post('/users/{id}/approve', [AdminUserController::class, 'approveUser'])->name('users.approve');
        Route::post('/users/{id}/role', [AdminUserController::class, 'changeRole'])->name('users.role');
    });
});



// Employee History Routes

Route::prefix('employees/{employee}')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/histories', [EmployeeHistoryController::class, 'index'])
            ->name('employees.histories.index');

        Route::get('/histories/create', [EmployeeHistoryController::class, 'create'])
            ->name('employees.histories.create');

        Route::post('/histories', [EmployeeHistoryController::class, 'store'])
            ->name('employees.histories.store');

        Route::get('/histories/{history}/edit', [EmployeeHistoryController::class, 'edit'])
            ->name('employees.histories.edit');

        Route::put('/histories/{history}', [EmployeeHistoryController::class, 'update'])
            ->name('employees.histories.update');

        Route::delete('/histories/{history}', [EmployeeHistoryController::class, 'destroy'])
            ->name('employees.histories.destroy');
    });







/*  

/*
|--------------------------------------------------------------------------
| Breeze Auth Routes
|--------------------------------------------------------------------------
 */
require __DIR__ . '/auth.php';
