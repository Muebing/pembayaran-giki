<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TagihanPembayaran;
use Illuminate\Support\Facades\Auth;

class RiwayatPembayaranController extends Controller
{
    function index()
    {

        // Ambil semua data pembayaran berdasarkan siswa yang sedang login
        $tagihans = TagihanPembayaran::where('siswa_id', Auth::id())
            ->where('status', 'lunas')
            ->get();

        return view('users.riwayat', compact('tagihans'));
    }

    function unduhPDFPerTransaksi($tagihanId)
    {
        $siswa = Auth::user();

        // Ambil data tagihan berdasarkan ID
        $tagihan = TagihanPembayaran::with('jenisPembayaran')
            ->where('siswa_id', $siswa->id)
            ->where('id', $tagihanId)
            ->first();

        if (!$tagihan) {
            // Jika tagihan tidak ditemukan, tampilkan pesan error atau redirect
            return redirect()->route('riwayat-pembayaran.index')->with('error', 'Tagihan tidak ditemukan!');
        }

        // Buat file PDF dari view Blade untuk transaksi tertentu
        $pdf = Pdf::loadView('pdf.riwayat_pembayaran_transaksi', compact('siswa', 'tagihan'));

        // Unduh PDF dengan nama file yang sesuai
        return $pdf->download('tagihan_' . $tagihan->jenisPembayaran->nama_pembayaran . '_' . $siswa->name . '.pdf');
    }
    function unduhPDF()
    {
        $siswa = Auth::user();

        // Ambil data tagihan terkait siswa
        $tagihans = TagihanPembayaran::with('jenisPembayaran')
            ->where('siswa_id', $siswa->id)
            ->where('status', 'lunas')
            ->get();

        // Buat file PDF dari view Blade
        $pdf = Pdf::loadView('pdf.riwayat_pembayaran', compact('siswa', 'tagihans'));

        // Unduh PDF dengan nama file yang sesuai
        return $pdf->download('riwayat_pembayaran_' . $siswa->name . '.pdf');
    }
}
