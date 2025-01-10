@extends('layout_admin.master')

@section('content')
    <div class="container">
        <h2>Laporan Pembayaran</h2>
        <h4>Periode: {{ $periode_awal }} - {{ $periode_akhir }}</h4>

        @if ($daftar_pembayaran->isNotEmpty() && $daftar_pembayaran->first()->siswa)
            <h4>Kelas: {{ $daftar_pembayaran->first()->siswa->kelas }}</h4>
        @else
            <h4>Kelas: Semua Kelas</h4>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Pembayaran</th>
                    <th>Nominal</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar_pembayaran as $index => $pembayaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaran->siswa->name }}</td>
                        <td>{{ $pembayaran->jenisPembayaran->nama_pembayaran }}</td>
                        <td>Rp {{ number_format($pembayaran->jenisPembayaran->nominal, 0, ',', '.') }}</td>
                        <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                        <td>
                            @if ($pembayaran->verifikasi == 1)
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-warning">Belum Terverifikasi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data periode yang anda minta</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
@endsection
