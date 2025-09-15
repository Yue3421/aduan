<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarakatAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('masyarakat.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]{16}$/', 'unique:masyarakat'],
            'nama' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:25', 'unique:masyarakat'],
            'password' => ['required', 'string', 'max:35', 'confirmed'],
            'telp' => ['required', 'string', 'max:13', 'regex:/^[0-9]{10,13}$/'],
        ]);

        $masyarakat = Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Gunakan bcrypt
            'telp' => $request->telp,
        ]);

        return redirect('/login'); // Redirect ke login setelah register
    }

    public function showLoginForm()
    {
        return view('masyarakat.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]{16}$/'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'nik' => 'NIK atau password salah.',
        ])->onlyInput('nik');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}