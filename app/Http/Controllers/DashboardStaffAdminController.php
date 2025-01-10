<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagihanPembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardStaffAdminController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data siswa berdasarkan kelas
        $kelasX = User::where('role', 'siswa')->where('kelas', 'X')->take(3)->get();
        $kelasXI = User::where('role', 'siswa')->where('kelas', 'XI')->take(3)->get();
        $kelasXIIIPA = User::where('role', 'siswa')->where('kelas', 'XII IPA')->take(3)->get();
        $kelasXIIIPS = User::where('role', 'siswa')->where('kelas', 'XII IPS')->take(3)->get();

        // Gabungkan semua data siswa
        $siswa = $kelasX->merge($kelasXI)->merge($kelasXIIIPA)->merge($kelasXIIIPS);

        // Ambil data pembayaran yang lunas dan kelompokkan berdasarkan siswa_id
        $daftar = TagihanPembayaran::with(['jenisPembayaran', 'siswa'])
            ->whereIn('siswa_id', $siswa->pluck('id'))
            ->where('status', 'lunas')
            ->get()
            ->groupBy('siswa_id')
            ->map(function ($pembayaran) {
                $item = $pembayaran->first();
                return [
                    'nama_siswa' => $item->siswa->name ?? 'Tidak diketahui',
                    'jenis_pembayaran' => $item->jenisPembayaran->nama_pembayaran ?? 'Tidak diketahui',
                    'nominal' => $item->jenisPembayaran->nominal ?? 0,
                    'verifikasi' => $item->verifikasi ?? 'Belum diverifikasi',
                    'id' => $item->id,
                ];
            });

        // Kirim data ke view
        return view('dashboard_admin', compact('user', 'siswa', 'daftar'));
    }
}
