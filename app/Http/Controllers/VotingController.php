<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kandidat_id' => 'required|exists:kandidat,id',
        ]);

        $user = Auth::user();

        // 1. Periksa apakah pemilih valid
        if (!$user->is_validated) {
            return redirect()->route('dashboard.pemilih')->with('error', 'Akun Anda belum divalidasi oleh admin. Silakan hubungi admin.');
        }

        // 2. Periksa apakah pemilih sudah pernah memilih
        if ($user->has_voted) {
            return redirect()->route('dashboard.pemilih')->with('error', 'Anda sudah menggunakan hak suara Anda.');
        }

        // 3. Simpan suara
        Vote::create([
            'user_id' => $user->id,
            'kandidat_id' => $request->kandidat_id,
        ]);

        // 4. Tandai bahwa pemilih sudah memilih
        $user->has_voted = true;
        $user->save();

        return redirect()->route('dashboard.pemilih')->with('success', 'Terima kasih! Suara Anda telah berhasil dicatat.');
    }
}
