<?php

use Illuminate\Support\Facades\Route;

// Controller
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
Route::get('/', [ClientPagesController::class, 'landing'])->name('landing');
Route::get('/login', [ClientPagesController::class, 'loginForm'])->name('client.login');
Route::get('/register', [ClientPagesController::class, 'registerForm'])->name('client.register');
