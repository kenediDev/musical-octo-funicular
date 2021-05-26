<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/auth'
], function () {
    Route::post('', [AuthController::class, 'login']);
    Route::get('', [AuthController::class, 'me']);
    Route::post('reset/', [AuthController::class, 'reset']);
    Route::post('update/profile', [AuthController::class, 'update']);
    Route::post('update/avatar', [AuthController::class, 'updateProfile']);
    Route::post('update/background', [AuthController::class, 'updateBackground']);
    Route::post('update/private', [AuthController::class, 'updatePrivate']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1/product'
], function () {
    Route::post('category', [ProductController::class, 'createCategory']);
    Route::get('category', [ProductController::class, 'listCategory']);
    Route::delete('category/{id}', [ProductController::class, 'destroyCategory']);
    Route::post('category/{id}', [ProductController::class, 'updateCategory']);
    Route::post('', [ProductController::class, 'createProduct']);
    Route::get('', [ProductController::class, 'listProduct']);
    Route::delete('{id}', [ProductController::class, 'destroyProduct']);
    Route::post('{id}', [ProductController::class, 'updateProduct']);
});
