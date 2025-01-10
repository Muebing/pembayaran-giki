<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nisn' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:50'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'no_telp' => ['required', 'string', 'max:15'],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses penyimpanan file foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan file ke storage/public/foto
            $fotoPath = $request->file('foto')->store('foto', 'public');
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'foto' => $fotoPath, // Menyimpan path file foto ke database
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('users.dashboard');
    }
}
