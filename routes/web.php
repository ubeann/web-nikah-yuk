<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;

// Client Controller
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\EventController as ClientEventController;
use App\Http\Controllers\Client\GuestController as ClientGuestController;
use App\Http\Controllers\Client\PagesController as ClientPagesController;

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

        // Events
        Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
            Route::get('/', [ClientEventController::class, 'index'])->name('index');
            Route::get('/create', [ClientEventController::class, 'createForm'])->name('create.form');
            Route::post('/create', [ClientEventController::class, 'create'])->name('create.submit');
            Route::get('/{id}/detail', [ClientEventController::class, 'detail'])->name('detail');
            Route::get('/{id}/edit', [ClientEventController::class, 'editForm'])->name('edit.form');
            Route::put('/{id}/edit', [ClientEventController::class, 'edit'])->name('edit.submit');
            Route::delete('/{id}/delete', [ClientEventController::class, 'delete'])->name('delete');
        });
    });

    // Guest
    Route::group(['prefix' => 'event', 'as' => 'guest.'], function () {
        Route::get('/{id}/guest', [ClientGuestController::class, 'form'])->name('form');
        Route::post('/{id}/guest', [ClientGuestController::class, 'submit'])->name('submit');
        Route::get('/{id}/greet', [ClientGuestController::class, 'greet'])->name('greet');
    });

    // Logout
    Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Login
    // Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
    //     Route::get('/', [AdminAuthController::class, 'loginForm'])->name('form');
    //     Route::post('/', [AdminAuthController::class, 'login'])->name('submit');
    // });

    // Authenticated routes
    Route::group(['middleware' => 'admin'], function () {
        // Dashboard
        Route::get('/', [AdminPagesController::class, 'dashboard'])->name('dashboard');

        // Clients
        Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
            Route::get('/', [AdminClientController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [AdminClientController::class, 'detail'])->name('detail');
            Route::get('/{id}/edit', [AdminClientController::class, 'edit'])->name('edit');
            Route::put('/{id}/edit', [AdminClientController::class, 'updateProfile'])->name('update.profile');
            Route::patch('/{id}/edit', [AdminClientController::class, 'updatePassword'])->name('update.password');
            Route::delete('/{id}/delete', [AdminClientController::class, 'delete'])->name('delete');
        });

        // Events
        Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
            Route::get('/', [AdminEventController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [AdminEventController::class, 'detail'])->name('detail');
            Route::get('/{id}/edit', [AdminEventController::class, 'editForm'])->name('edit.form');
            Route::put('/{id}/edit', [AdminEventController::class, 'edit'])->name('edit.submit');
            Route::patch('/{id}/confirmed', [AdminEventController::class, 'confirmed'])->name('confirmed');
            Route::patch('/{id}/rejected', [AdminEventController::class, 'rejected'])->name('rejected');
            Route::delete('/{id}/delete', [AdminEventController::class, 'delete'])->name('delete');
        });

        // Guests
        Route::group(['prefix' => 'guest', 'as' => 'guest.'], function () {
            Route::get('/', [AdminGuestController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [AdminGuestController::class, 'detail'])->name('detail');
            Route::get('/{id}/edit', [AdminGuestController::class, 'editForm'])->name('edit.form');
            Route::put('/{id}/edit', [AdminGuestController::class, 'edit'])->name('edit.submit');
            Route::delete('/{id}/delete', [AdminGuestController::class, 'delete'])->name('delete');
        });

        // Photos
        Route::group(['prefix' => 'photo', 'as' => 'photo.'], function () {
            Route::get('/', [AdminPhotoController::class, 'index'])->name('index');
            Route::post('/', [AdminPhotoController::class, 'upload'])->name('upload');
            Route::delete('/{id}/delete', [AdminPhotoController::class, 'delete'])->name('delete');
        });

        // Settings
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', [AdminPagesController::class, 'settings'])->name('form');
            Route::put('/', [AdminAuthController::class, 'updateUsername'])->name('update.username');
            Route::patch('/', [AdminAuthController::class, 'updatePassword'])->name('update.password');
        });
    });

    // Logout
    // Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
