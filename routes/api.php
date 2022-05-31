<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productFetchController;
use App\Http\Controllers\productController;

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

Route::post('/fetch', productFetchController::class);
Route::get('/product', 'App\Http\Controllers\productController@getProduct');
Route::get('/product_sku', 'App\Http\Controllers\productController@getProductSku');
Route::get('/product_options', 'App\Http\Controllers\productController@getProductOptions');
