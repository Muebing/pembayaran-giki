<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagihanPembayaran;

class VerifikasiPembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap filter dari request
        $verifikasi = $request->get('verifikasi'); // Status verifikasi
        $search = $request->get('search');        // Filter pencarian siswa
        $perPage = 10;                            // Jumlah data per halaman (bisa disesuaikan)

        // Query utama dengan relasi yang dimuat
        $daftar = TagihanPembayaran::with(['jenisPembayaran', 'siswa'])
            ->whereIn('status', ['menunggu_konfirmasi', 'lunas'])
            ->when($verifikasi !== null, function ($query) use ($verifikasi) {
                return $query->where('verifikasi', $verifikasi); // Filter berdasarkan status verifikasi
            })
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%"); // Filter berdasarkan nama siswa
                });
            })
            ->paginate($perPage) // Menambahkan pagination
            ->through(function ($item) {
                return [
                    'nama_siswa' => $item->siswa->name ?? 'Data Siswa Tidak Tersedia',
                    'jenis_pembayaran' => $item->jenisPembayaran->nama_pembayaran ?? 'Data Pembayaran Tidak Tersedia',
                    'nominal' => $item->jenisPembayaran->nominal ?? 0,
                    'tenggat_waktu' => $item->tanggal_pembayaran ?? '-',
                    'status' => ucfirst($item->status ?? 'Tidak Diketahui'),
                    'verifikasi' => $item->verifikasi,
                    'id' => $item->id,
                ];
            });


        // Jika request AJAX, kirim partial view untuk table
        if ($request->ajax()) {
            return view('siswa.partials.table_verif', compact('daftar'))->render();
        }

        // Return tampilan utama
        return view('verifikasi-pembayaran.index', compact('daftar'));
    }


    public function show($id)
    {
        $pembayaran = TagihanPembayaran::with('jenisPembayaran', 'siswa')->findOrFail($id);

        return view('verifikasi-pembayaran.show', compact('pembayaran'));
    }

    public function verify($id)
    {
        $pembayaran = TagihanPembayaran::findOrFail($id);

        if ($pembayaran && $pembayaran->verifikasi == 0) {
            // Update status menjadi lunas jika status sebelumnya adalah menunggu konfirmasi
            if ($pembayaran->status === 'menunggu_konfirmasi') {
                $pembayaran->status = 'lunas';
            }

            // Update status verifikasi menjadi 1 (terverifikasi)
            $pembayaran->verifikasi = 1;
            $pembayaran->save();

            // if ($pembayaran && $pembayaran->verifikasi == 0) {
            //     // Update status verifikasi menjadi 1 (terverifikasi)
            //     $pembayaran->verifikasi = 1;
            //     $pembayaran->save();

            // if ($pembayaran && $pembayaran->status === 'menunggu_konfirmasi') {
            //     // Update status menjadi lunas
            //     $pembayaran->status = 'lunas';
            //     $pembayaran->verifikasi = 1; // Tandai bahwa sudah diverifikasi
            //     $pembayaran->save();

            return redirect()->route('verif.pembayaran.index')->with('success', 'Verifikasi telah diterima.');
        }
        return redirect()->route('verif.pembayaran.index')->with('error', 'Gagal memverifikasi pembayaran.');
    }

    function reject(Request $request, $id)
    {
        $pembayaran = TagihanPembayaran::findOrFail($id);

        // Perbarui status pembayaran
        $pembayaran->delete();

        return redirect()->route('verif.pembayaran.index')->with('success', 'Verifikasi berhasil ditolak.');
    }
}
