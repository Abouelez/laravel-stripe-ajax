<?php

use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\Auth\AuthTokenController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Middleware\LogIncomingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/test_route/{message}', [ApiProductController::class, 'section_1'])->middleware(LogIncomingRequest::class);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthTokenController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ApiProductController::class, 'index']);
    Route::post('/logout', [AuthTokenController::class, 'logout']);

});
