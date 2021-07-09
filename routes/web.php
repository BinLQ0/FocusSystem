<?php

use Web\ProductTypeController;
use Web\WarehouseRackController;
use Web\WarehouseController;
use Web\UserController;
use Auth\LogoutController;
use Auth\AttemptLoginController;
use Auth\ShowLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', ShowLoginController::class)
    ->name('login');

Route::post('/login', AttemptLoginController::class)
    ->name('login.attempt');

Route::get('/logout', LogoutController::class)
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/', 'home')->name('home');

    Route::resource('user', UserController::class);
});

Route::middleware('auth')->prefix('/master')->group(function () {
    Route::resource('product-type', ProductTypeController::class);
    Route::resource('warehouse', WarehouseController::class);
    Route::resource('warehouse.racks', WarehouseRackController::class)->shallow();
});