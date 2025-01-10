<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use App\Models\TagihanPembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardStaffKepsekControlller extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        // Mendapatkan data bulan yang dipilih dari input
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Total nominal pembayaran yang sudah diverifikasi
        $totalPembayaran = JenisPembayaran::join('tagihan_pembayarans', 'jenis_pembayarans.id', '=', 'tagihan_pembayarans.jenis_pembayaran_id')
            ->where('tagihan_pembayarans.verifikasi', 1)
            ->sum('jenis_pembayarans.nominal');

        // Ambil semua siswa
        $siswa = User::where('role', 'siswa')->get();

        // Hitung jumlah siswa membayar dan tunggakan
        $jumlahSiswaMembayar = 0;
        $jumlahSiswaTunggakan = 0;

        // Mendapatkan semua jenis pembayaran unik
        $jenisPembayaranList = JenisPembayaran::select('nama_pembayaran')->distinct()->pluck('nama_pembayaran');

        foreach ($siswa as $s) {
            $tagihan = TagihanPembayaran::where('siswa_id', $s->id)->get();

            // Cek apakah tagihan sudah diverifikasi
            if ($tagihan->every(fn($t) => $t->verifikasi == 1)) {
                $jumlahSiswaMembayar++;
            } else {
                $jumlahSiswaTunggakan++;
            }
        }

        // Query untuk mendapatkan data pembayaran per bulan yang terverifikasi
        $totalPembayaranBulanan = DB::table('tagihan_pembayarans')
            ->join('jenis_pembayarans', 'tagihan_pembayarans.jenis_pembayaran_id', '=', 'jenis_pembayarans.id')
            ->select(
                DB::raw('MONTH(tanggal_pembayaran) as bulan'),
                DB::raw('YEAR(tanggal_pembayaran) as tahun'),
                'jenis_pembayarans.nama_pembayaran as jenis_pembayaran',
                DB::raw('COUNT(*) as jumlah_pembayaran')
            )
            ->whereNotNull('tanggal_pembayaran') // Pastikan hanya yang sudah dibayar
            ->where('verifikasi', 1) // Hanya tagihan yang terverifikasi
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tanggal_pembayaran', $bulan); // Filter berdasarkan bulan
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal_pembayaran', $tahun); // Filter berdasarkan Tahun
            })
            ->groupBy('jenis_pembayarans.nama_pembayaran', DB::raw('MONTH(tanggal_pembayaran)'), DB::raw('YEAR(tanggal_pembayaran)'))
            ->get();

        // Proses bulan, jumlah pembayaran, dan jenis pembayaran untuk dikirim ke view
        $bulanLabels = $totalPembayaranBulanan->pluck('bulan');
        $jumlahPembayaranPerBulan = $totalPembayaranBulanan->pluck('jumlah_pembayaran');
        $jenisPembayaranLabels = $totalPembayaranBulanan->pluck('jenis_pembayaran');


        return view('dashboard_kepsek', compact(
            'siswa',
            'totalPembayaran',
            'jumlahSiswaMembayar',
            'jumlahSiswaTunggakan',
            'bulanLabels',
            'jumlahPembayaranPerBulan',
            'jenisPembayaranLabels',
            'user',
            'jenisPembayaranList'
        ));
    }

    function laporanPembayaran(Request $request)
    {
        $bulan = $request->input('bulan'); // Ambil input bulan dari request

        // Total nominal pembayaran yang sudah diverifikasi
        $totalPembayaran = JenisPembayaran::join('tagihan_pembayarans', 'jenis_pembayarans.id', '=', 'tagihan_pembayarans.jenis_pembayaran_id')
            ->where('tagihan_pembayarans.verifikasi', 1)
            ->sum('jenis_pembayarans.nominal');

        // Ambil semua siswa
        $siswa = User::where('role', 'siswa')->get();

        // Hitung jumlah siswa membayar dan tunggakan
        $jumlahSiswaMembayar = 0;
        $jumlahSiswaTunggakan = 0;

        foreach ($siswa as $s) {
            $tagihan = TagihanPembayaran::where('siswa_id', $s->id)->get();

            if ($tagihan->every(fn($t) => $t->verifikasi == 1)) {
                $jumlahSiswaMembayar++;
            } else {
                $jumlahSiswaTunggakan++;
            }
        }

        // Data laporan bulanan
        $laporanBulanan = TagihanPembayaran::selectRaw('MONTH(tanggal_pembayaran) as bulan,
            SUM(jenis_pembayarans.nominal) as total_pembayaran,
            SUM(CASE WHEN verifikasi = 0 THEN jenis_pembayarans.nominal ELSE 0 END) as tunggakan,
            SUM(CASE WHEN verifikasi = 1 THEN jenis_pembayarans.nominal ELSE 0 END) as selesai')
            ->join('jenis_pembayarans', 'tagihan_pembayarans.jenis_pembayaran_id', '=', 'jenis_pembayarans.id')
            ->when($bulan, function ($query, $bulan) {
                $query->whereRaw('MONTH(tanggal_pembayaran) = ?', [$bulan]);
            })
            ->groupByRaw('MONTH(tanggal_pembayaran)')
            ->get();


        return view('staffkepsek.laporan-pembayaran', compact('totalPembayaran', 'jumlahSiswaMembayar', 'jumlahSiswaTunggakan', 'laporanBulanan', 'bulan'));
    }
}
