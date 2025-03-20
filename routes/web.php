<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\SobOfferComponent;
use App\Http\Controllers\SobOfferController;
use App\Http\Controllers\WelcomeController;


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
Route::delete('/sob-offers/{id}', [SobOfferController::class, 'destroy'])->name('sob-offers.destroy');
Route::get('offers/{uuid}', [WelcomeController::class, 'show'])->name('offers.show');
