<?php

use App\Http\Controllers\API\CustomerAddressController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/customers', CustomerController::class);
Route::apiResource('/customer_addresses', CustomerAddressController::class);
Route::apiResource('/products', ProductController::class);
Route::apiResource('/payments', PaymentMethodController::class);
Route::apiResource('/orders', OrderController::class);
