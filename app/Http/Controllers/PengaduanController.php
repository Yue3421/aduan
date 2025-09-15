<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Maks 2MB
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aduan', 'public');
        }

        Pengaduan::create([
            'tgl_pengaduan' => now()->toDateString(),
            'nik' => Auth::user()->nik,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $fotoPath,
            'status' => '0',
        ]);

        return redirect()->route('dashboard')->with('success', 'Aduan berhasil dibuat.');
    }
}