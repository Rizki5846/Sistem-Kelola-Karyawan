
<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

    Route::middleware('auth')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::resource('employees', EmployeeController::class)
        ->except(['show'])
        ->middleware('role:HRD');
    });


Route::middleware('auth')->group(function () {
    // Pertahankan route dashboard dan employees yang sudah ada.

    Route::middleware('role:HRD')->group(function () {
        Route::resource('departments', DepartmentController::class)
            ->except(['show']);

        Route::resource('positions', PositionController::class)
            ->except(['show']);
    });
});

