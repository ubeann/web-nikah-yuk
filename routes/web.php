<?php

use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\ClientPagesController;
use App\Http\Controllers\ExperimentalController;

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
        Route::post('/', [ClientAuthController::class, 'login'])->name('submit');
    });

    // Register
    Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
        Route::get('/', [ClientPagesController::class, 'registerForm'])->name('form');
        Route::post('/', [ClientAuthController::class, 'register'])->name('submit');
    });

    // Logout
    Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');

    //! DEBUG
    Route::get('/dummy', [ClientAuthController::class, 'checkLogin'])->name('dummy');
});

// User routes
Route::group(['as' => 'user.'], function () {
});

// Admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Login
    Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
        Route::get('/', [AdminAuthController::class, 'loginForm'])->name('form');
        Route::post('/', [AdminAuthController::class, 'login'])->name('submit');
    });

    // Authenticated routes
    Route::group(['middleware' => 'admin'], function () {
        // Dashboard
        Route::get('/', [AdminPagesController::class, 'dashboard'])->name('dashboard');

        // Settings
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [AdminPagesController::class, 'settings'])->name('form');
            Route::put('/', [AdminAuthController::class, 'updateUsername'])->name('update.username');
            Route::patch('/', [AdminAuthController::class, 'updatePassword'])->name('update.password');
        });
    });

    // Logout
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

//! DEBUG
Route::get('/list-user', [ExperimentalController::class, 'listUser'])->name('user.list');
Route::get('/user/{id}/edit', [ExperimentalController::class, 'editUser'])->name('user.edit');
Route::put('/user/{id}/edit', [ExperimentalController::class, 'updateUser'])->name('user.update');
Route::delete('/user/{id}/delete', [ExperimentalController::class, 'deleteUser'])->name('user.delete');
