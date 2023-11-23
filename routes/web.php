<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [AuthController::class, 'index']);

Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/auth/login', 'login')->name('login');
    Route::get('/register', 'registerPage')->name('register');
    Route::post('/auth/register', 'register');
    Route::get('/auth/logout', 'logout')->name('logout');
});
