<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\ItemController;
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
Route::post('/register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource("/invoices",     InvoiceController::class)->only(['store', 'index']);
    Route::apiResource('/items', ItemController::class)->only(['store', 'index']);
    Route::apiResource("/customers", CustomerController::class)->only(['store']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
