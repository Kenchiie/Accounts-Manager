<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/users');

Route::resource('users', UserController::class);

// Accounts
Route::resource('users.accounts', AccountController::class)->except('index', 'show');
Route::get('users/{user}/accounts/export', [AccountController::class, 'export'])->name('users.accounts.export');
