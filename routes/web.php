<?php

use App\Http\Controllers\Admin\ProSettingController;
use App\Http\Controllers\Admin\SubscriptionCouponController;
use App\Http\Controllers\Admin\SubscriptionSettingController;
use App\Http\Controllers\Admin\UserSubscriptionController;
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

    Route::get('/mitra/service-orders/{serviceOrder}/detail', [ServiceOrderController::class, 'show'])
        ->name('service-orders.show');

    Route::get('/mitra/service-orders/{serviceOrder}/download', [ServiceOrderController::class, 'downloadPdf'])
        ->name('service-orders.download');

    Route::get('/check-in/{token}', [CheckInController::class, 'show'])
        ->name('check-in.show');

    // accept / reject (bengkel)
    Route::post('/service-orders/{serviceOrder}/accept', [ServiceOrderController::class, 'accept'])
        ->name('service-orders.accept');

    Route::post('/service-orders/{serviceOrder}/reject', [ServiceOrderController::class, 'reject'])
        ->name('service-orders.reject');

    Route::post(
        '/service-orders/{serviceOrder}/no-show',
        [ServiceOrderController::class, 'noShow']
    )->name('service-orders.no-show');

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

    Route::post('/booking/{uuid}/cancel', [BookingController::class, 'cancel'])
        ->name('booking.cancel');

    Route::get('/c/bukti-servis', [BookingController::class, 'buktiServis'])->name('bukti-servis');
    Route::get('/c/bukti-servis/{serviceOrder}/download', [BookingController::class, 'downloadPdf'])->name('bukti-servis.download');

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

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get(
        '/admin/subscription-settings',
        [SubscriptionSettingController::class, 'index']
    )->name('admin.subscription.settings');

    Route::post(
        '/admin/subscription-settings',
        [SubscriptionSettingController::class, 'update']
    )->name('admin.subscription.settings.update');

    Route::get('/admin/subscription-coupons', [SubscriptionCouponController::class, 'index'])
        ->name('admin.coupons.index');

    Route::post('/admin/subscription-coupons', [SubscriptionCouponController::class, 'store'])
        ->name('admin.coupons.store');

    Route::put('/admin/subscription-coupons/{coupon}', [SubscriptionCouponController::class, 'update'])
        ->name('admin.coupons.update');

    Route::delete('/admin/subscription-coupons/{coupon}', [SubscriptionCouponController::class, 'destroy'])
        ->name('admin.coupons.destroy');

    // untuk user subscription management
    Route::get(
        '/admin/subscriptions/users',
        [UserSubscriptionController::class, 'index']
    )->name('admin.subscriptions.users.index');

    Route::get(
        '/admin/subscriptions/users/{user}/edit',
        [UserSubscriptionController::class, 'edit']
    )->name('admin.subscriptions.users.edit');

    Route::put(
        '/admin/subscriptions/users/{user}',
        [UserSubscriptionController::class, 'update']
    )->name('admin.subscriptions.users.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/subscription-plans', function () {
        return view('subscription-plans.index');
    })->name('subscription.plans');
});


Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
