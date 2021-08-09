<?php

use Web\CompanyController;
use Web\JobCostController;
use Web\ProductResultController;
use Web\ReleaseMaterialController;
use Web\HistoryViewController;
use Web\ProductController;
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

    Route::get('/product/{product}/history', HistoryViewController::class);

    Route::resource('product', ProductController::class);
    Route::resource('user', UserController::class);
});

/**
 * Put modul 'Data Master' route on this line
 */
Route::middleware('auth')->prefix('/master')->group(function () {
    Route::resource('product-type', ProductTypeController::class);
    Route::resource('warehouse', WarehouseController::class);
    Route::resource('warehouse.racks', WarehouseRackController::class)->shallow();
    Route::resource('company', CompanyController::class);
});

/**
 * Put modul 'Manufacture' route on this line
 */
Route::middleware('auth')->prefix('/manufacture')->group(function () {
    Route::resource('release-material', ReleaseMaterialController::class);
    Route::resource('product-result', ProductResultController::class);
    Route::resource('job-cost', JobCostController::class);
});
