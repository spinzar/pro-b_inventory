<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\MaterialCategoryController;
use App\Http\Controllers\InventoryMovementConfigurationController;
use App\Http\Controllers\InventoryMovementController;

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
Route::resource('/warehouse', WarehouseController::class)->middleware(['auth', 'check.permission']);
Route::resource('/unit', UnitController::class)->middleware(['auth', 'check.permission']);
Route::resource('/brand', BrandController::class)->middleware(['auth', 'check.permission']);
Route::resource('/material_category', MaterialCategoryController::class)->middleware(['auth', 'check.permission']);
Route::resource('/business', BusinessController::class)->middleware(['auth', 'check.permission']);
Route::resource('/material', MaterialController::class)->middleware(['auth', 'check.permission']);
Route::resource('/supplier', SupplierController::class)->middleware(['auth', 'check.permission']);
Route::resource('/inventory_movement_configuration', InventoryMovementConfigurationController::class)->middleware(['auth', 'check.permission']);
Route::resource('/inventory_movement', InventoryMovementController::class)->middleware(['auth', 'check.permission']);
