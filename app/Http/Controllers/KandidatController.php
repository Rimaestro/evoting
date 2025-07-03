<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandidat = Kandidat::all();
        return view('kandidat.index', compact('kandidat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kandidat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:kandidat',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(storage_path('app/public/foto_kandidat'), $imageName);

        Kandidat::create([
            'nama_ketua' => $request->nama_ketua,
            'nama_wakil' => $request->nama_wakil,
            'nomor_urut' => $request->nomor_urut,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'foto' => $imageName,
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Kandidat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kandidat $kandidat)
    {
        return view('kandidat.show', compact('kandidat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kandidat $kandidat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kandidat $kandidat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kandidat = Kandidat::findOrFail($id);

        // Hapus foto dari storage
        if ($kandidat->foto) {
            Storage::delete('public/foto_kandidat/' . $kandidat->foto);
        }

        $kandidat->delete();

        return redirect()->route('kandidat.index')->with('success', 'Kandidat berhasil dihapus.');
    }

    public function showFoto($filename)
    {
        $path = storage_path('app/public/foto_kandidat/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
