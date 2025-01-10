<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use App\Models\TagihanPembayaran;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Ambil semua tagihan pembayaran untuk siswa ini, dengan relasi jenisPembayaran
        $tagihans = TagihanPembayaran::where('siswa_id', $siswa->id)
            ->with('jenisPembayaran')
            ->get();

        // Ambil ID jenis pembayaran yang sudah lunas
        $lunasJenisPembayaranIds = $tagihans->where('status', 'lunas')->pluck('jenis_pembayaran_id')->toArray();

        // Ambil jenis pembayaran yang belum lunas
        $jenisPembayarans = JenisPembayaran::whereNotIn('id', $lunasJenisPembayaranIds)->get();

        // Filter jenis pembayaran berdasarkan agama siswa
        $filteredJenisPembayarans = $jenisPembayarans->filter(function ($jenisPembayaran) use ($siswa) {
            // Jika siswa beragama Islam, tampilkan semua pembayaran kecuali "LKS Non-Muslim"
            if ($siswa->agama == 'Islam' && $jenisPembayaran->nama_pembayaran != 'LKS Non-Muslim') {
                return true;
            }
            // Jika siswa beragama selain Islam, tampilkan semua pembayaran kecuali "LKS Muslim"
            if ($siswa->agama != 'Islam' && $jenisPembayaran->nama_pembayaran != 'LKS Muslim') {
                return true;
            }
            return false;
        });

        // Kembalikan view dengan data yang sudah difilter
        return view('users.tagihan', compact('tagihans', 'filteredJenisPembayarans'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayarans,id',
            'tanggal_pembayaran' => 'required|date',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload bukti pembayaran
        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Cek apakah tagihan untuk jenis pembayaran ini sudah ada
        $tagihan = TagihanPembayaran::where('jenis_pembayaran_id', $validated['jenis_pembayaran_id'])
            ->where('siswa_id', Auth::id())
            ->first();

        if ($tagihan) {
            // Update status jika sudah ada tagihan
            $tagihan->update([
                'status' => 'menunggu_konfirmasi',
                'tanggal_pembayaran' => $validated['tanggal_pembayaran'],
                'bukti_bayar' => $buktiBayarPath,
            ]);
        } else {
            // Buat tagihan baru
            TagihanPembayaran::create([
                'siswa_id' => Auth::id(),
                'jenis_pembayaran_id' => $validated['jenis_pembayaran_id'],
                'status' => 'menunggu_konfirmasi',
                'tanggal_pembayaran' => $validated['tanggal_pembayaran'],
                'bukti_bayar' => $buktiBayarPath,
            ]);
        }

        return redirect()->route('tagihan_pembayaran.index')->with('success', 'Pembayaran berhasil dilakukan.');
    }

    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'jenis_pembayaran_ids' => 'required|array|min:1',
            'jenis_pembayaran_ids.*' => 'exists:jenis_pembayarans,id',
            'tanggal_pembayaran' => 'required|date',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload bukti pembayaran
        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        foreach ($validated['jenis_pembayaran_ids'] as $jenisPembayaranId) {
            // Cek apakah tagihan untuk jenis pembayaran ini sudah ada
            $tagihan = TagihanPembayaran::where('jenis_pembayaran_id', $jenisPembayaranId)
                ->where('siswa_id', Auth::id())
                ->first();

            if ($tagihan) {
                // Update status jika sudah ada tagihan
                $tagihan->update([
                    'status' => 'menunggu_konfirmasi',
                    'tanggal_pembayaran' => $validated['tanggal_pembayaran'],
                    'bukti_bayar' => $buktiBayarPath,
                ]);
            } else {
                // Buat tagihan baru
                TagihanPembayaran::create([
                    'siswa_id' => Auth::id(),
                    'jenis_pembayaran_id' => $jenisPembayaranId,
                    'status' => 'menunggu_konfirmasi',
                    'tanggal_pembayaran' => $validated['tanggal_pembayaran'],
                    'bukti_bayar' => $buktiBayarPath,
                ]);
            }
        }

        return redirect()->route('tagihan_pembayaran.index')->with('success', 'Pembayaran berhasil dilakukan untuk semua tagihan yang dipilih.');
    }
}
