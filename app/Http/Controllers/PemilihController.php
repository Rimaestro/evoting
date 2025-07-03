<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PemilihController extends Controller
{
    /**
     * Tandai seorang pemilih sebagai tervalidasi.
     */
    public function validate(User $user)
    {
        $user->is_validated = true;
        $user->save();

        return redirect()->route('dashboard.admin')->with('success', 'Pemilih berhasil divalidasi.');
    }

    /**
     * Hapus data pemilih.
     */
    public function destroy(User $user)
    {
        // Pastikan tidak menghapus admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        $user->delete();

        return redirect()->route('dashboard.admin')->with('success', 'Pemilih berhasil dihapus.');
    }
}
