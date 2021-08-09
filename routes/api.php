<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\JobCostController;
use App\Http\Controllers\Api\JobCostReferanceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductResultController;
use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\RackController;
use App\Http\Controllers\Api\ReleaseMaterialController;
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

Route::get('/products', [ProductController::class, 'index'])
    ->name('api.products');

Route::get('/release-material', [ReleaseMaterialController::class, 'index'])
    ->name('api.release');

Route::get('/product-result', [ProductResultController::class, 'index'])
    ->name('api.result');


Route::get('/product/{product}/history', [HistoryController::class, 'index'])
    ->name('api.history');

Route::get('/product-type', [ProductTypeController::class, 'index'])
    ->name('api.product.types');

Route::get('/job-cost', [JobCostController::class, 'index'])
    ->name('api.jobcost');

Route::get('/job-cost-referance', [JobCostReferanceController::class, 'index'])
    ->name('api.job-cost-referance');

Route::get('/racks', [RackController::class, 'index'])
    ->name('api.racks');

Route::get('/users', [UserController::class, 'index'])
    ->name('api.users');

Route::get('/warehouses', [WarehouseController::class, 'index'])
    ->name('api.warehouses');

Route::get('/company', [CompanyController::class, 'index'])
    ->name('api.company');
