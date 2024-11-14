<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/sessions/history', [App\Http\Controllers\SessionController::class, 'history']);
