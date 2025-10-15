<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenAuthController extends Controller
{
    // Tampilkan form login dosen
    public function showLoginForm()
    {
        // Kalau sudah login, langsung balik ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    // Proses login dosen
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('home')
                ->with('success', 'Berhasil login sebagai ' . Auth::user()->name);
        }

        return back()->withInput()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Proses logout dosen
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
