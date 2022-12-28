<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CheckController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\PurchaseController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('purchase', [PurchaseController::class, 'purchase']);
    Route::get('balance', [BalanceController::class, 'balance']);
    Route::get('checks', [CheckController::class, 'checks']);
    Route::post('deposit', [CheckController::class, 'deposit']);
    Route::get('currentBalance', [BalanceController::class, 'currentBalance']);
    Route::get('expenses', [BalanceController::class, 'expenses']);
});
