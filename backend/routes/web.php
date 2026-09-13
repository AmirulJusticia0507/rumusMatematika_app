<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RumusController;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth (web)
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login'])->name('login.store');

    Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [WebAuthController::class, 'register'])->name('register.store');

    Route::get('/forgot-password', [WebAuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [WebAuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('/reset-password/{token}', [WebAuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [WebAuthController::class, 'resetPassword'])->name('password.store');
});

Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

Route::get('/rumus', [RumusController::class, 'index'])->name('rumus.index');
Route::get('/rumus/{rumus:slug}', [RumusController::class, 'show'])->name('rumus.show');

// Rangkuman (PDF / cetak)
Route::get('/rangkuman', [RumusController::class, 'rangkuman'])->name('rangkuman');

// Kalkulator rumus
Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator.index');

// Kuis
Route::controller(QuizController::class)->group(function () {
    Route::get('/kuis', 'index')->name('kuis.index');
    Route::get('/kuis/{jenis}', 'show')->name('kuis.show');
    Route::post('/kuis/{jenis}', 'submit')->name('kuis.submit');
});

// Flashcard
Route::get('/flashcard', [FlashcardController::class, 'index'])->name('flashcard.index');

// Area autentikasi
Route::middleware('auth')->group(function () {
    Route::post('/rumus/{rumus:slug}/bookmark', [BookmarkController::class, 'toggle'])->name('rumus.bookmark');
    Route::get('/favorit', [BookmarkController::class, 'index'])->name('favorit.index');

    Route::post('/flashcard/progress', [FlashcardController::class, 'progress'])->name('flashcard.progress');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'password'])->name('profil.password');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('rumus', \App\Http\Controllers\Admin\RumusController::class)->except('show')->parameters(['rumus' => 'rumus']);
});
