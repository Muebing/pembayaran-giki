<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    // Menampilkan daftar jenis pembayaran
    public function index()
    {
        $jenisPembayaran = JenisPembayaran::all();
        return view('jenis-pembayaran.index', compact('jenisPembayaran'));
    }

    // Menampilkan form untuk menambah jenis pembayaran
    public function create()
    {
        return view('jenis-pembayaran.create');
    }

    // Menyimpan jenis pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembayaran' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:255',
            'virtual_account' => 'nullable|numeric|digits_between:8,20',
            'bank_transfer' => 'nullable|required_if:metode_pembayaran,Bank Transfer|string|max:255',
        ]);

        JenisPembayaran::create([
            'nama_pembayaran' => $request->nama_pembayaran,
            'nominal' => $request->nominal,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bank_transfer' => $request->bank_transfer,
            'virtual_account' => $request->virtual_account,
        ]);

        return redirect()->route('jenis-pembayaran.index')
            ->with('success', 'Jenis pembayaran berhasil ditambahkan.');
    }



    // Menampilkan form untuk mengedit jenis pembayaran
    public function edit(JenisPembayaran $jenisPembayaran)
    {
        return view('jenis-pembayaran.edit', compact('jenisPembayaran'));
    }

    // Mengupdate jenis pembayaran
    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        $request->validate([
            'nama_pembayaran' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:255',
            'virtual_account' => 'required|numeric|digits_between:8,20',
        ]);

        $jenisPembayaran->update($request->all());

        return redirect()->route('jenis-pembayaran.index')
            ->with('success', 'Jenis pembayaran berhasil diperbarui.');
    }

    // Menghapus jenis pembayaran
    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        $jenisPembayaran->delete();

        return redirect()->route('jenis-pembayaran.index')
            ->with('success', 'Jenis pembayaran berhasil dihapus.');
    }
}
