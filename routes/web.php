<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mitra/register', function () {
    return view('auth.register-mitra');
})->name('register.mitra');

// PROSES REGISTER MITRA
Route::post('/mitra/register', [RegisteredUserController::class, 'registerMitra'])
    ->name('mitra.register.store');

// kelola profil mitra/bengkel
Route::get('/mitra/profil', [MitraController::class, 'index'])->name('profile.mitra')->middleware(['auth', 'verified']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('c/vehicle', VehicleController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
