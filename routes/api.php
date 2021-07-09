<?php

use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\RackController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', [UserController::class, 'index'])
    ->name('api.users');

Route::get('/warehouses', [WarehouseController::class, 'index'])
    ->name('api.warehouses');

Route::get('/racks', [RackController::class, 'index'])
    ->name('api.racks');

Route::get('/product-type', [ProductTypeController::class, 'index'])
    ->name('api.product.types');
