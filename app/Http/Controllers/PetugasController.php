<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])->get();
        $view = Auth::guard('petugas')->user()->level === 'admin' ? 'masyarakat.admin_dashboard' : 'masyarakat.petugas_dashboard';
        return view($view, compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id_pengaduan)
    {
        $request->validate([
            'status' => ['required', 'in:0,proses,selesai'],
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->update(['status' => $request->status]);

        return redirect()->route('petugas.dashboard')->with('success', 'Status aduan diperbarui.');
    }

    public function storeTanggapan(Request $request, $id_pengaduan)
    {
        $request->validate([
            'tanggapan' => ['required', 'string'],
        ]);

        Tanggapan::create([
            'id_pengaduan' => $id_pengaduan,
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
            'tanggapan' => $request->tanggapan,
            'tgl_tanggapan' => now()->toDateString(),
        ]);

        return redirect()->route('petugas.dashboard')->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function generateLaporan()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])->get();
        return view('masyarakat.laporan', compact('pengaduan'));
    }
}