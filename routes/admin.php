<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/paket-wisata', PaketWisataController::class)->names('admin.paket-wisata')->parameter('paket-wisata', 'paketWisata');
    Route::resource('/pemesanan', PemesananController::class)->names('admin.pemesanan');
    Route::post('/admin/fasilitas', [FasilitasController::class, 'store'])->name('admin.fasilitas.store');
    Route::patch('/admin/bookings/{id}/status', [PemesananController::class, 'updateStatus'])->name('admin.booking.updateStatus');
});
