<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/users-travels', [UserController::class, 'store']); 
Route::get('/users-travels', [UserController::class, 'index']);  
Route::get('/users-travels/{id}', [UserController::class, 'show']);  
Route::put('/users-travels/{id}', [UserController::class, 'update']);  
Route::delete('/users-travels/{id}', [UserController::class, 'destroy']);  

Route::post('/tickets', [TiketController::class, 'store']); 
Route::get('/tickets', [TiketController::class, 'index']);  
Route::get('/tickets/{id}', [TiketController::class, 'show']);  
Route::put('/tickets/{id}', [TiketController::class, 'update']);  
Route::delete('/tickets/{id}', [TiketController::class, 'destroy']);  

Route::post('/orders', [OrderController::class, 'store']);  
Route::get('/orders', [OrderController::class, 'index']);  
Route::get('/orders/{id}', [OrderController::class, 'show']); 
Route::put('/orders/{id}', [OrderController::class, 'update']);  
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);  
