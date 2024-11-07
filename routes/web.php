<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityLogController;

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

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', HomeController::class)->name('home')->middleware(['auth']);
Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware(['auth', 'check.permission']);
Route::resource('/setting', SettingController::class)->middleware(['auth']);
Route::resource('/role', RoleController::class)->middleware(['auth', 'check.permission']);
Route::resource('/user', UserController::class)->middleware(['auth', 'check.permission']);
Route::resource('/activity_log', ActivityLogController::class)->middleware(['auth', 'check.permission']);
