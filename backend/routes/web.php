<?php

use App\Http\Controllers\RumusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rumus', [RumusController::class, 'index'])->name('rumus.index');
Route::get('/rumus/{jenis}', [RumusController::class, 'show'])->name('rumus.show');
