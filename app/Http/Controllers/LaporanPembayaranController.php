<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TagihanPembayaran;

class LaporanPembayaranController extends Controller
{
    public function index()
    {
        $kelas = User::where('role', 'siswa')->distinct()->pluck('kelas');

        return view('laporan.index', compact('kelas'));
    }

    public function generate(Request $request)
    {
        // Menangani parameter dari form
        $periode_awal = $request->input('periode_awal');
        $periode_akhir = $request->input('periode_akhir');
        $kelas = $request->input('kelas');

        // Membangun query berdasarkan periode dan siswa
        $query = TagihanPembayaran::with('jenisPembayaran', 'siswa')
            ->whereBetween('tanggal_pembayaran', [$periode_awal, $periode_akhir]);

        if ($kelas) {
            // Filter berdasarkan kelas jika ada
            $query->whereHas('siswa', function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
            });
        }

        // Ambil data berdasarkan query yang sudah difilter
        $daftar_pembayaran = TagihanPembayaran::with('siswa')->get();
        $daftar_pembayaran = $query->get();

        // Kirim data ke view laporan
        return view('laporan.result', compact('daftar_pembayaran', 'periode_awal', 'periode_akhir', 'kelas'));
    }
}
