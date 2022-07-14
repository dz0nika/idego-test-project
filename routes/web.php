<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'create'])
        ->name('login');

    Route::post('/', [AuthController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['otp.check'])->group(function () {
        Route::post('/logout', [AuthController::class, 'destroy'])
            ->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])
                ->name('users');
        });
    });

    Route::get('/set-password', [AuthController::class, 'loadSetPassword'])
        ->name('set-password');

    Route::post('/set-password', [AuthController::class, 'setPassword'])
        ->name('set-password');
});
