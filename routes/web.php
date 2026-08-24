<?php

use App\Http\Controllers\Admin\AulaController as AdminAulaController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\SuratController as AdminSuratController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// halaman awal langsung diarahkan ke daftar aula (bukan welcome page bawaan Laravel)
Route::get('/', function () {
    return redirect()->route('aula.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ============ AREA PEGAWAI (login wajib) ============
Route::middleware('auth')->group(function () {
    Route::get('/aula', [AulaController::class, 'index'])->name('aula.index');
    Route::get('/aula/{aula:slug}', [AulaController::class, 'kalender'])->name('aula.kalender');
    Route::get('/aula/{aula:slug}/jadwal.json', [AulaController::class, 'jadwalJson'])->name('aula.jadwal.json');

    Route::get('/aula/{aula:slug}/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/aula/{aula:slug}/booking', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/riwayat-booking', [BookingController::class, 'history'])->name('booking.history');
    Route::patch('/booking/{booking}/batal', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// ============ AREA ADMIN (login + role admin) ============
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{booking}/approve', [AdminBookingController::class, 'approve'])->name('booking.approve');
    Route::patch('/booking/{booking}/reject', [AdminBookingController::class, 'reject'])->name('booking.reject');

    Route::get('/aula', [AdminAulaController::class, 'index'])->name('aula.index');
    Route::patch('/aula/{aula}', [AdminAulaController::class, 'update'])->name('aula.update');

    Route::get('/surat', [AdminSuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/tambah', [AdminSuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [AdminSuratController::class, 'store'])->name('surat.store');
});