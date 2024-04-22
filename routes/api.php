<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SuscriptionsController;
use App\Http\Controllers\Api\TrainersController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'profile']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/profile', [AuthController::class, 'update']);
    Route::post('suscribe', [SuscriptionsController::class, 'store']);
    Route::delete('suscribe/{suscription}', [SuscriptionsController::class, 'destroy']);
    Route::get('/trainers', [TrainersController::class, 'index']);

    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{product}', [ProductsController::class, 'show']);

    Route::get('/orders', [OrdersController::class, 'index']);
    Route::post('/orders', [OrdersController::class, 'store']);
    Route::get('/orders/{order}', [OrdersController::class, 'show']);

    Route::get('/bookings', [BookingsController::class, 'index']);
    Route::post('/bookings', [BookingsController::class, 'store']);
    Route::get('/bookings/{booking}', [BookingsController::class, 'show']);
});
