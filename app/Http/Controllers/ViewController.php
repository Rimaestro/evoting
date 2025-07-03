<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kandidat;
use App\Models\Vote;

class ViewController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboardPemilih()
    {
        $kandidat = Kandidat::all();
        return view('dashboard.pemilih', compact('kandidat'));
    }

    public function dashboardAdmin()
    {
        $totalPemilih = User::where('role', 'pemilih')->count();
        $totalKandidat = Kandidat::count();
        $sudahMemilih = User::where('role', 'pemilih')->where('has_voted', true)->count();
        $pemilih = User::where('role', 'pemilih')->get();

        return view('dashboard.admin', compact('totalPemilih', 'totalKandidat', 'sudahMemilih', 'pemilih'));
    }

    public function hasilVoting()
    {
        // Mengambil semua kandidat dan jumlah suara mereka menggunakan `withCount`
        // Ini akan menambahkan kolom `votes_count` ke setiap objek kandidat
        $kandidat = Kandidat::withCount('votes')->orderBy('votes_count', 'desc')->get();
        $totalSuaraMasuk = Vote::count();

        return view('hasil-voting', compact('kandidat', 'totalSuaraMasuk'));
    }
}
