<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MitraImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $allowedFolders = ['mitra-images'];

    if (!in_array($folder, $allowedFolders)) {
        abort(403);
    }

    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::get('/mitra/register', function () {
    return view('auth.register-mitra');
})->name('register.mitra');

// PROSES REGISTER MITRA
Route::post('/mitra/register', [RegisteredUserController::class, 'registerMitra'])
    ->name('mitra.register.store');

// kelola profil mitra/bengkel
Route::get('/mitra/profil', [MitraController::class, 'mitraProfile'])->name('profile.mitra')->middleware(['auth', 'verified']);
// Route::get('/mitra/profil/edit', [MitraController::class, 'mitraProfileEdit'])->name('edit.mitra')->middleware(['auth', 'verified']);
Route::get('/mitra/profil/edit', [MitraController::class, 'mitraProfileEdit'])->name('edit.mitra');
Route::put('/mitra/profil/update/{id}', [MitraController::class, 'mitraProfileUpdate'])->name('update.mitra');


Route::post('/mitra/{mitra}/images', [MitraImageController::class, 'store'])
    ->name('mitra.images.store');

Route::delete('/mitra-images/{image}', [MitraImageController::class, 'destroy'])
    ->name('mitra.images.destroy');

Route::patch('/mitra-images/{image}/cover', [MitraImageController::class, 'setCover'])
    ->name('mitra.images.cover');


// manajemen bengkel by admin
Route::get('/mitra-manajemen', [MitraController::class, 'index'])->name('mitra.manajemen')->middleware(['auth', 'verified']);

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('c/vehicle', VehicleController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
