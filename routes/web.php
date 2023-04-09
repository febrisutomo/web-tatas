<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth route 
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'attemptLogin'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Must login 
Route::group(['prefix' => '', 'middleware' => 'login'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
