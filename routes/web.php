<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\SobOfferComponent;
use App\Http\Controllers\SobOfferController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PrivacyController;

Route::get('/', [WelcomeController::class, 'index']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
// Route::middleware(['auth'])->group(function () {

Route::get('/sob-offers', [SobOfferController::class, 'index'])->name('sob-offers.index');
Route::post('/sob-offers', [SobOfferController::class, 'store'])->name('sob-offers.store');
Route::put('/sob-offers/{id}', [SobOfferController::class, 'update'])->name('sob-offers.update');
Route::delete('/sob-offers/{id}', [SobOfferController::class, 'destroy'])->name('sob-offers.destroy');
Route::get('offers/{uuid}', [WelcomeController::class, 'show'])->name('offers.show');

Route::get('privacy-and-policy', [PrivacyController::class, 'privacyPolicy'])->name('privacy.policy');
