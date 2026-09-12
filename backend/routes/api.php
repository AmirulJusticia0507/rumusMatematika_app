<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SubMateriController;
use App\Http\Controllers\AuthController;

// Auth
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
// Routes protected by Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

// Kelas & Materi
Route::apiResource('kelas', KelasController::class);
Route::apiResource('materi', MateriController::class);
Route::apiResource('submateri', SubMateriController::class);
