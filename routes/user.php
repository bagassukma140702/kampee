<?php

use App\Http\Controllers\User\PemesananController;
use App\Http\Controllers\User\PaketWisataController;
use Illuminate\Support\Facades\Route;

Route::resource('/paket-wisata', PaketWisataController::class)->names('user.paket-wisata')->parameter('paket-wisata', 'paketWisata');
Route::middleware('auth')->get('/pemesanan/{id}/eticket', [PemesananController::class, 'downloadEticket'])
    ->name('pemesanan.eticket');

// Group untuk user
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/pemesanan/form/{paket}', [PemesananController::class, 'form'])->name('user.pemesanan.form');

    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('user.pemesanan.store');

    Route::get('/pemesanan/{id}/eticket', [PemesananController::class, 'downloadEticket'])->name('user.pemesanan.eticket');

    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('user.pemesanan.index');

    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('user.pemesanan.show');
});
