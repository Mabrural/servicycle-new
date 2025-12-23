<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BengkelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanBengkelController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MitraImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScanQrController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WelcomeController;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/booking-success/{uuid}', [BookingController::class, 'success'])
    ->name('booking.success');

Route::get('/ajax/vehicle/{id}', function ($id) {
    $vehicle = \App\Models\Vehicle::findOrFail($id);

    return response()->json([
        'brand' => $vehicle->brand,
        'model' => $vehicle->model,
        'type' => $vehicle->vehicle_type, // ✅ FIX DI SINI
        'plate' => $vehicle->plate_number,
    ]);
})->middleware('auth');


Route::get('/bengkel/{slug}', [BengkelController::class, 'show'])
    ->name('bengkel.show');

Route::get('/bengkel/{slug}/booking-servis', [BookingController::class, 'create'])
    ->name('booking.create')
    ->middleware('auth');

Route::post('/bengkel/{slug}/booking-servis', [BookingController::class, 'store'])
    ->name('booking.store')
    ->middleware('auth');



Route::get('/mitra/register', function () {
    return view('auth.register-mitra');
})->name('register.mitra');

// PROSES REGISTER MITRA
Route::post('/mitra/register', [RegisteredUserController::class, 'registerMitra'])
    ->name('mitra.register.store');


// mitra route group
Route::middleware(['auth', 'verified', 'mitra'])->group(function () {

    Route::get('/mitra/service-orders', [ServiceOrderController::class, 'index'])
        ->middleware('auth')
        ->name('service-orders.index');
    Route::get('/mitra/service-orders/walk-in/create', [ServiceOrderController::class, 'createWalkIn'])
        ->middleware('auth')
        ->name('service-orders.walk_in.create');
    Route::post('/mitra/service-orders/walk-in', [ServiceOrderController::class, 'storeWalkIn'])
        ->middleware('auth')
        ->name('service-orders.walk_in.store');

    Route::get('/mitra/profil', [MitraController::class, 'mitraProfile'])->name('profile.mitra');
    Route::get('/mitra/profil/edit', [MitraController::class, 'mitraProfileEdit'])->name('edit.mitra');
    Route::put('/mitra/profil/update/{id}', [MitraController::class, 'mitraProfileUpdate'])->name('update.mitra');


    Route::post('/mitra/{mitra}/images', [MitraImageController::class, 'store'])
        ->name('mitra.images.store');

    Route::delete('/mitra-images/{image}', [MitraImageController::class, 'destroy'])
        ->name('mitra.images.destroy');

    Route::patch('/mitra-images/{image}/cover', [MitraImageController::class, 'setCover'])
        ->name('mitra.images.cover');

    Route::get('/scan-qr-customer', [ScanQrController::class, 'index'])
        ->name('scan.qr.customer');

    Route::post('/scan-qr-customer', [ScanQrController::class, 'process'])
        ->name('scan.qr.process');

    Route::post('/service-orders/{order}/check-in', [ServiceOrderController::class, 'checkIn'])
        ->middleware(['auth'])
        ->name('service-orders.check-in');
    Route::post(
        '/mitra/service-orders/{order}/enqueue',
        [ServiceOrderController::class, 'enqueue']
    )->name('service-orders.enqueue');

    // service flow
    Route::post('/service-orders/{serviceOrder}/start', [ServiceOrderController::class, 'start'])
        ->middleware('auth')
        ->name('service-orders.start');

    Route::post('/service-orders/{serviceOrder}/finish', [ServiceOrderController::class, 'finish'])
        ->middleware('auth')
        ->name('service-orders.finish');

    Route::post('/service-orders/{serviceOrder}/pick-up', [ServiceOrderController::class, 'pickUp'])
        ->middleware('auth')
        ->name('service-orders.pick-up');

    Route::get('/mitra/service-orders/{serviceOrder}/detail', [ServiceOrderController::class, 'show'])
        ->middleware('auth')
        ->name('service-orders.show');

    Route::get('/mitra/service-orders/{serviceOrder}/download', [ServiceOrderController::class, 'downloadPdf'])
        ->middleware('auth')
        ->name('service-orders.download');

    Route::get('/check-in/{token}', [CheckInController::class, 'show'])
        ->name('check-in.show');

    // accept / reject (bengkel)
    Route::post('/service-orders/{serviceOrder}/accept', [ServiceOrderController::class, 'accept'])
        ->middleware('auth')
        ->name('service-orders.accept');

    Route::post('/service-orders/{serviceOrder}/reject', [ServiceOrderController::class, 'reject'])
        ->middleware('auth')
        ->name('service-orders.reject');

    Route::get('/laporan-bengkel', [LaporanBengkelController::class, 'index'])
        ->name('laporan.bengkel');

    Route::get('/laporan-bengkel/pdf', [LaporanBengkelController::class, 'pdf'])
        ->name('laporan.bengkel.pdf');

});


// customer route group
Route::middleware(['auth', 'verified', 'customer'])->group(function () {
    Route::resource('c/vehicle', VehicleController::class);

    Route::get('/c/servis-saya', [BookingController::class, 'myOrders'])
        ->name('booking.my');

    Route::get('/c/servis-saya/{uuid}', [BookingController::class, 'track'])
        ->name('booking.track');

});

// admin route group
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // manajemen pengguna by admin
    Route::get('/admin/manajemen-pengguna/', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/manajemen-pengguna/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::put('/admin/manajemen-pengguna/{user}', [UserController::class, 'update'])
        ->name('users.update');
    Route::delete('/manajemen-pengguna/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    // manajemen bengkel by admin
    Route::get('/admin/mitra-manajemen', [MitraController::class, 'index'])->name('mitra.manajemen');
    Route::get('/admin/mitra-manajemen/{slug}', [MitraController::class, 'show'])
        ->name('mitra.show');

    Route::post('/admin/mitra-manajemen/{mitra}/verify', [MitraController::class, 'verify'])
        ->name('mitra.verify');
    Route::post('/admin/mitra/{mitra}/deactivate', [MitraController::class, 'deactivate'])
        ->name('mitra.deactivate');

});

// create order (online & walk-in)
Route::post('/service-orders', [ServiceOrderController::class, 'store'])
    ->middleware('auth')
    ->name('service-orders.store');




Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
