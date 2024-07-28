<?php

use App\Http\Controllers\ProductsApiController;
use App\Http\Controllers\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',ProductsApiController::class);
Route::get('/latest-products', [ProductsApiController::class, 'getLatestProducts']);
Route::get('/products-hot', [ProductsApiController::class, 'getProductsHot']);

Route::apiResource('/category', CategoryApiController::class);
Route::get('/products-hot', [CategoryApiController::class, 'getProductsHot']);
