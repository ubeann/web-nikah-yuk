<?php

use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientPagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client routes
Route::group(['as' => 'client.'], function () {
    // Landing
    Route::get('/', [ClientPagesController::class, 'landing'])->name('landing');

    // Login
    Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
        Route::get('/', [ClientPagesController::class, 'loginForm'])->name('form');
        Route::post('/', [AuthController::class, 'login'])->name('submit');
    });

    // Register
    Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
        Route::get('/', [ClientPagesController::class, 'registerForm'])->name('form');
        Route::post('/', [AuthController::class, 'register'])->name('submit');
    });

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    //! DEBUG
    Route::get('/dummy', [AuthController::class, 'checkLogin'])->name('dummy');
});
