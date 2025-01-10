<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'staffadmin') {
                return redirect()->route('dashboard_admin');
            } elseif ($user->role === 'kepsek') {
                return redirect()->route('dashboard_kepsek');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('users.dashboard');
            } else {
                // Jika role tidak valid, logout dan kembali ke login dengan pesan error
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role pengguna tidak valid.');
            }
        } catch (\Exception $e) {
            // Jika autentikasi gagal, redirect kembali ke login dengan pesan error
            return redirect()->route('login')->with('error', 'Email atau password salah.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
