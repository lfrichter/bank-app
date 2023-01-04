<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CheckController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CheckController as AdminCheckController;

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

Route::name('admin.')->prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum','auth.admin'])->group(function () {
        Route::get('getUser', [AuthController::class, 'getUser'])->name('getUser');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('checks', [AdminCheckController::class, 'index']);
        Route::get('checks/{check}', [AdminCheckController::class, 'get']);
        Route::put('checks/{check}', [AdminCheckController::class, 'update']);
    });
});




