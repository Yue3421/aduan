<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('masyarakat.petugas_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_petugas' => ['required', 'string', 'max:25'],
            'username' => ['required', 'string', 'max:25', 'unique:petugas'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
            'telp' => ['required', 'string', 'max:13', 'regex:/^[0-9]{10,13}$/'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Gunakan Bcrypt
            'telp' => $request->telp,
            'level' => $request->level,
        ]);

        return redirect('/petugas/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        return view('masyarakat.petugas_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('petugas')->attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('petugas.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/petugas/login');
    }
}