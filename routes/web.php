<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VotingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendaftarkan semua rute aplikasi web.
|
*/

// Rute utama, mengarahkan ke login jika belum masuk, atau ke dashboard jika sudah.
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Grup rute yang memerlukan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute dashboard utama, mengarahkan berdasarkan peran pengguna
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }
        return redirect()->route('dashboard.pemilih');
    })->name('dashboard');

    // Rute spesifik untuk dashboard admin dan pemilih
    Route::get('/dashboard/admin', [ViewController::class, 'dashboardAdmin'])->name('dashboard.admin');
    Route::get('/dashboard/pemilih', [ViewController::class, 'dashboardPemilih'])->name('dashboard.pemilih');

    // Rute untuk hasil voting
    Route::get('/hasil-voting', [ViewController::class, 'hasilVoting'])->name('hasil.voting');
    
    // Rute Resource untuk Kandidat (CRUD)
    Route::resource('kandidat', KandidatController::class);

    // Rute untuk Manajemen Pemilih (Validasi & Hapus)
    Route::patch('/pemilih/{user}/validate', [PemilihController::class, 'validate'])->name('pemilih.validate');
    Route::delete('/pemilih/{user}', [PemilihController::class, 'destroy'])->name('pemilih.destroy');

    // Rute untuk proses voting
    Route::post('/vote', [VotingController::class, 'store'])->name('vote.store');
    
    // Rute profil dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk menampilkan halaman dari ViewController
// Route::get('/login', [ViewController::class, 'login'])->name('login.page'); // Dihapus, ditangani Breeze
// Route::get('/register', [ViewController::class, 'register'])->name('register.page'); // Dihapus, ditangani Breeze

Route::get('/kandidat/foto/{filename}', [KandidatController::class, 'showFoto'])->name('kandidat.foto');

require __DIR__.'/auth.php';
