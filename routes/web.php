<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard → Employees page
    Route::get('/dashboard', function () {
        return redirect()->route('employees.index');
    })->name('dashboard');

    // Employee CRUD (Protected)
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    //Route::get('employees/pending', [EmployeeController::class, 'pending']);
    Route::post('employees/{id}/approve', [EmployeeController::class, 'approve'])->name('employees.approve');
    Route::get('/employee/download-pdf/{id}', [EmployeeController::class, 'downloadPDF'])->name('employees.download-pdf');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {});













/*  

/*
|--------------------------------------------------------------------------
| Breeze Auth Routes
|--------------------------------------------------------------------------
 */
require __DIR__ . '/auth.php';
