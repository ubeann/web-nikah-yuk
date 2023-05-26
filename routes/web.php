<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;

// Client Controller
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\PagesController as ClientPagesController;

//! Experimental Controller
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

    // Authenticated routes
    Route::group(['middleware' => 'client'], function () {
        // Profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', [ClientPagesController::class, 'profile'])->name('form');
            Route::put('/edit', [ClientAuthController::class, 'updateProfile'])->name('update.profile');
            Route::patch('/edit', [ClientAuthController::class, 'updatePassword'])->name('update.password');
        });
    });

    // Logout
    Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');
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

        // Clients
        Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
            Route::get('/', [AdminClientController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [AdminClientController::class, 'edit'])->name('edit');
            Route::put('/{id}/edit', [AdminClientController::class, 'updateProfile'])->name('update.profile');
            Route::patch('/{id}/edit', [AdminClientController::class, 'updatePassword'])->name('update.password');
            Route::delete('/{id}/delete', [AdminClientController::class, 'delete'])->name('delete');
        });

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
